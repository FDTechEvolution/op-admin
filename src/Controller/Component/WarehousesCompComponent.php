<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * WarehousesComp component
 */
class WarehousesCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Warehouses = null;

    public function WHList(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Warehouses = TableRegistry::get('Warehouses');
        $query = $this->Warehouses->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }
}
