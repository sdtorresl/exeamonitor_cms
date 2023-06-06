<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SongsHistory Entity
 *
 * @property int $id
 * @property string $title
 * @property string $author
 * @property int $song_id
 * @property int $pos_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\PointsOfSale $points_of_sale
 */
class SongsHistory extends Entity
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
        'author' => true,
        'song_id' => true,
        'pos_id' => true,
        'created' => true,
        'points_of_sale' => true
    ];
}
