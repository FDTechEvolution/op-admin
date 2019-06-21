<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * BrandsComp component
 */
class BrandsCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Brands = null;

    public function brandList(){
        $this->Brands = TableRegistry::get('Brands');

        $query = $this->Brands->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        return $data = $query->toArray();
    }
}
