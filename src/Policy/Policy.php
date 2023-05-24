<?php

namespace App\Policy;

class Policy {
    protected function isAdmin($user) : bool {
        return $user->getOriginalData()->role == 'admin' || 'customers_manager';
    }

    protected function isAdminOrCustomer($user) : bool {
        return $user->getOriginalData()->role == 'admin' || $user->getOriginalData()->role == 'user';
    }

    protected function isCustomer($user) : bool {
        return $user->getOriginalData()->role == 'user';
    }
}
