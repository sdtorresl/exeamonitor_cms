<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;

/**
 * Users policy
 */
class UsersTablePolicy extends Policy
{

    public function canIndex($user, $query)
    {
        return $this->isAdmin($user);
    }
}
