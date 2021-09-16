<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\PointsOfSale;
use Authorization\IdentityInterface;

/**
 * PointsOfSale policy
 */
class PointsOfSalePolicy extends Policy
{
    /**
     * Check if $user can add PointsOfSale
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\PointsOfSale $pointsOfSale
     * @return bool
     */
    public function canAdd(IdentityInterface $user, PointsOfSale $pointsOfSale)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit PointsOfSale
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\PointsOfSale $pointsOfSale
     * @return bool
     */
    public function canEdit(IdentityInterface $user, PointsOfSale $pointsOfSale)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete PointsOfSale
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\PointsOfSale $pointsOfSale
     * @return bool
     */
    public function canDelete(IdentityInterface $user, PointsOfSale $pointsOfSale)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view PointsOfSale
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\PointsOfSale $pointsOfSale
     * @return bool
     */
    public function canView(IdentityInterface $user, PointsOfSale $pointsOfSale)
    {
        return $this->isAdmin($user);
    }
}
