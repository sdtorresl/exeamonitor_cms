<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $role
 * @property bool $enabled
 * @property \Cake\I18n\FrozenTime $last_access
 * @property int|null $point_of_sale_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\PointOfSale $point_of_sale
 * @property \App\Model\Entity\PasswordsReset[] $passwords_resets
 */
class User extends Entity
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
        'username' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'role' => true,
        'enabled' => true,
        'last_access' => true,
        'point_of_sale_id' => true,
        'created' => true,
        'modified' => true,
        'point_of_sale' => true,
        'passwords_resets' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
