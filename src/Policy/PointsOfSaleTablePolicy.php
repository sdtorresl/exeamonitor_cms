<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\PointsOfSaleTable;
use Authorization\IdentityInterface;

/**
 * PointsOfSale policy
 */
class PointsOfSaleTablePolicy extends Policy
{
    public function canIndex($user, $query)
    {
        return $this->isAdmin($user);
    }
}
