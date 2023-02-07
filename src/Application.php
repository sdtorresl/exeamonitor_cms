<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App;

use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Authorization\AuthorizationService;
use Authorization\AuthorizationServiceInterface;
use Authorization\AuthorizationServiceProviderInterface;
use Authorization\Middleware\AuthorizationMiddleware;
use Authorization\Policy\OrmResolver;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface, AuthorizationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        $this->addPlugin('Josegonzalez/Upload');

        $this->addPlugin('ExeaTheme');

        $this->addPlugin('Authorization');

        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin('DebugKit');
        }
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))
            ->add(new AuthenticationMiddleware($this))
            ->add(new AuthorizationMiddleware($this))
            // ->add(new CsrfProtectionMiddleware([
            //     'httponly' => true
            // ]))
            ->add(new BodyParserMiddleware());

        $csrf = new CsrfProtectionMiddleware();
        $csrf->skipCheckCallback(function ($request) {
            if ($request->getParam('prefix') === 'Api') {
                return true;
            }

            return false;
        });

        $middlewareQueue->add($csrf);

        $middlewareQueue->add(function ($request, $handler) {
            if ($request->getParam('prefix') == 'Api' || preg_match("/api/i", $request->getParam('_matchedRoute'))) {
                $request->getAttribute('authorization')->skipAuthorization();
            }
            return $handler->handle($request);
        });

        if (Configure::read('debug')) {
            // Add CORS for development environments.
            $middlewareQueue
                ->add(function ($request, $handler) {
                    $response = $handler->handle($request)
                        ->withHeader('Access-Control-Allow-Origin', '*')
                        ->withHeader('Access-Control-Allow-Methods', '*')
                        ->withHeader('Access-Control-Allow-Credentials', 'true')
                        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With')
                        ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
                        ->withHeader('Access-Control-Allow-Type', 'application/json');

                    return $response;
                });
        }
        return $middlewareQueue;
    }

    /**
     * Bootrapping for CLI application.
     *
     * That is when running commands.
     *
     * @return void
     */
    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        if ($request->getParam("prefix") === "Api") {
            $authenticationService = new AuthenticationService();

            $authenticationService->loadIdentifier('Authentication.JwtSubject');
            $authenticationService->loadAuthenticator('Authentication.Jwt', [
                'algorithm' => 'HS256',
                'returnPayload' => false
            ]);
            $authenticationService->loadAuthenticator('Authentication.Session');

        } else {
            $authenticationService = new AuthenticationService([
                'unauthenticatedRedirect' => Router::url('/', false),
                'queryParam' => 'redirect',
            ]);

            // Load the authenticators, you want session first
            $authenticationService->loadAuthenticator('Authentication.Session');
        }

        // Load identifiers, ensure we check email and password fields
        $authenticationService->loadIdentifier('Authentication.Password', [
            'fields' => [
                'username' => 'username',
                'password' => 'password',
            ]
        ]);

        // Configure form data check to pick email and password
        $authenticationService->loadAuthenticator('Authentication.Form', [
            'fields' => [
                'username' => 'username',
                'password' => 'password',
            ],
        ]);

        return $authenticationService;
    }

    /**
     * Authorization service
     * 
     * @return AuthorizationService
     */
    public function getAuthorizationService(ServerRequestInterface $request): AuthorizationServiceInterface
    {
        $resolver = new OrmResolver();

        return new AuthorizationService($resolver);
    }
}
