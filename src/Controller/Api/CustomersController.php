<?php

declare(strict_types=1);


namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['metadata']);
    }

    /**
     * Metadata method
     *
     * @param string $stream Stream URL
     * @return \Cake\Http\Response
     */
    public function metadata()
    {
        $stream_url = $this->request->getQuery('stream');
        $header = $this->getMp3StreamTitle($stream_url, 19200);
        $data = explode(" - ", $header);

        if (count($data) > 1) {
            $metadata = [
                'artist' => $data[0],
                'title' => $data[1]
            ];
        } else {
            $metadata = [
                'title' => $data[0]
            ];
        }


        $this->set(compact('metadata'));
        $this->viewBuilder()->setOption('serialize', ['metadata']);
    }

    private function getMp3StreamTitle($streamingUrl, $interval = 19200, $offset = 0, $headers = true)
    {
        $needle = 'StreamTitle=';
        $ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';

        $opts = array('http' => array(
            'method' => 'GET',
            'header' => 'Icy-MetaData: 1',
            'user_agent' => $ua
        ));

        if (($headers = get_headers($streamingUrl)))
            foreach ($headers as $h) {
                $currentSection = explode(':', $h);
                if (strpos(strtolower($h), 'icy-metaint') !== false && ($interval = $currentSection[1]))
                    break;
            }

        $context = stream_context_create($opts);

        if ($stream = fopen($streamingUrl, 'r', false, $context)) {
            $buffer = stream_get_contents($stream, $interval, $offset);
            fclose($stream);

            if (strpos($buffer, $needle) !== false) {
                $currentSectionTwo = explode($needle, $buffer);
                $title = $currentSectionTwo[1];
                return substr($title, 1, strpos($title, ';') - 2);
            } else
                return $this->getMp3StreamTitle($streamingUrl, $interval, $offset + $interval, false);
        } else
            throw new \Exception("Unable to open stream [{$streamingUrl}]");
    }
}
