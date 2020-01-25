<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PointsOfSale Entity
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property string $contact
 * @property string $address
 * @property \Cake\I18n\FrozenTime $last_access
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $customer_id
 * @property int|null $user_id
 *
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
        'last_access' => true,
        'created' => true,
        'modified' => true,
        'customer_id' => true,
        'user_id' => true,
        'customer' => true,
    ];
}
