<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property string $id
 * @property string $org_id
 * @property string $product_category_id
 * @property string $name
 * @property string $code
 * @property float|null $cost
 * @property float|null $price
 * @property string $brand_id
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $createdby
 * @property string|null $modifiedby
 *
 * @property \App\Model\Entity\Org $org
 * @property \App\Model\Entity\PeoductCategory $peoduct_category
 * @property \App\Model\Entity\Brand $brand
 */
class Product extends Entity
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
        'org_id' => true,
        'product_category_id' => true,
        'name' => true,
        'code' => true,
        'cost' => true,
        'price' => true,
        'brand_id' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'createdby' => true,
        'modifiedby' => true,
        'org' => true,
        'peoduct_category' => true,
        'brand' => true
    ];
}
