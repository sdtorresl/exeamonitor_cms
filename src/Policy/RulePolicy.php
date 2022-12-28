<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Rule;
use Authorization\IdentityInterface;

/**
 * Rule policy
 */
class RulePolicy extends Policy
{
    /**
     * Check if $user can add Rule
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Rule $rule
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Rule $rule)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Rule
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Rule $rule
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Rule $rule)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Rule
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Rule $rule
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Rule $rule)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Rule
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Rule $rule
     * @return bool
     */
    public function canView(IdentityInterface $user, Rule $rule)
    {
        return $this->isAdmin($user);
    }
}
