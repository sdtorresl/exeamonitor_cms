<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\RulesTable;
use Authorization\IdentityInterface;

/**
 * Rules policy
 */
class RulesTablePolicy extends Policy
{
    public function canIndex($user, $query)
    {
        return $this->isAdmin($user);
    }
}
