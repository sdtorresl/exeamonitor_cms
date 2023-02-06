<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\PlaybooksTable;
use Authorization\IdentityInterface;

/**
 * Playbooks policy
 */
class PlaybooksTablePolicy extends Policy
{
    public function canIndex($user, $query)
    {
        return $this->isAdmin($user);
    }
}
