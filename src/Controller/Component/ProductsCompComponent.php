<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * ProductsComp component
 */
class ProductsCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $product = null;

    public function productsList(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Products = TableRegistry::get('Products');
        $query = $this->Products->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }

    public function productsListAll(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Product = TableRegistry::get('Products');
        $query = $this->Product->find()
        ->select([
            'Products.id',
            'Products.name',
            'Products.price'
        ])
        ->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }
}
