<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rule Entity
 *
 * @property int $id
 * @property string $tag
 * @property string $logic
 * @property int $playbook_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $hour
 *
 * @property \App\Model\Entity\Playbook $playbook
 */
class Rule extends Entity
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
        'tag' => true,
        'logic' => true,
        'playbook_id' => true,
        'created' => true,
        'modified' => true,
        'start_hour' => true,
        'final_hour' => true,
        'days' => true,
        'once' => true,
        'playbook' => true,
    ];
}
