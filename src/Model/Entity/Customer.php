<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $contact_person
 * @property string|null $contact_phone
 * @property string|null $logo
 * @property string|null $logo_dir
 * @property string|null $logo_type
 * @property string|null $background
 * @property string|null $background_dir
 * @property string|null $background_type
 * @property string $stream_name
 * @property string $stream_url
 * @property string|null $backup_url
 * @property string|null $primary_color
 * @property string|null $secondary_color
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\PointsOfSale[] $points_of_sale
 */
class Customer extends Entity
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
        'description' => true,
        'contact_person' => true,
        'contact_phone' => true,
        'logo' => true,
        'logo_dir' => true,
        'logo_type' => true,
        'background' => true,
        'background_dir' => true,
        'background_type' => true,
        'stream_name' => true,
        'stream_url' => true,
        'backup_url' => true,
        'primary_color' => true,
        'secondary_color' => true,
        'created' => true,
        'modified' => true,
        'points_of_sale' => true,
    ];
}
