<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * ProductCategoriesComp component
 */
class ProductCategoriesCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $ProductCategories = null;

    public function proCateList(){
        $this->ProductCategories = TableRegistry::get('Product_Categories');

        $query = $this->ProductCategories->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        return $data = $query->toArray();
    }
}
