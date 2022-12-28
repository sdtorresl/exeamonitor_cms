<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Playbook;
use Authorization\IdentityInterface;

/**
 * Playbook policy
 */
class PlaybookPolicy extends Policy
{
    /**
     * Check if $user can add Playbook
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Playbook $playbook
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Playbook $playbook)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Playbook
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Playbook $playbook
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Playbook $playbook)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Playbook
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Playbook $playbook
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Playbook $playbook)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Playbook
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Playbook $playbook
     * @return bool
     */
    public function canView(IdentityInterface $user, Playbook $playbook)
    {
        return $this->isAdmin($user);
    }
}
