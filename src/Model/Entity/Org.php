<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Org Entity
 *
 * @property string $id
 * @property string $name
 * @property string|null $code
 * @property string|null $isactive
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 *
 * @property \App\Model\Entity\User[] $users
 */
class Org extends Entity
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
        'code' => true,
        'isactive' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'users' => true
    ];
}
