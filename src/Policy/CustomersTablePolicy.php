<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\CustomersTable;
use Authorization\IdentityInterface;

/**
 * Customers policy
 */
class CustomersTablePolicy extends Policy
{
    public function canIndex($user, $query)
    {
        return $this->isAdmin($user);
    }
}
