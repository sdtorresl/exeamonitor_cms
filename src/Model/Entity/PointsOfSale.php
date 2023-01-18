<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PointsOfSale Entity
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $contact
 * @property string $address
 * @property int $country_id
 * @property int $city_id
 * @property \Cake\I18n\FrozenTime $last_access
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $customer_id
 *
 * @property \App\Model\Entity\Country $country
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Customer $customer
 */
class PointsOfSale extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'phone' => true,
        'contact' => true,
        'address' => true,
        'country_id' => true,
        'city_id' => true,
        'last_access' => true,
        'created' => true,
        'modified' => true,
        'customer_id' => true,
        'playbook_id' => true,
        'country' => true,
        'city' => true,
        'customer' => true,
    ];
}
