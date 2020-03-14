<?php

namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type\BaseType;
use Cake\Database\DriverInterface;

class FileType extends BaseType
{
    /**
     * Marshalls flat data into PHP objects.
     *
     * Most useful for converting request data into PHP objects
     * that make sense for the rest of the ORM/Database layers.
     *
     * @param mixed $value The value to convert.
     * @return mixed Converted value.
     */
    public function marshal($value)
    {
        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function toDatabase($value, DriverInterface $driver)
    {
        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function toPHP($value, DriverInterface $driver)
    {
        return $value;
    }
}