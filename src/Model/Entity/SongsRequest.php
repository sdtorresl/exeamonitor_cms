<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SongsRequest Entity
 *
 * @property int $id
 * @property string $title
 * @property int $song_id
 * @property int $pos_id
 * @property bool $played
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\PointsOfSale $points_of_sale
 */
class SongsRequest extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'title' => true,
        'song_id' => true,
        'pos_id' => true,
        'played' => true,
        'created' => true,
        'modified' => true,
        'points_of_sale' => true,
    ];
}
