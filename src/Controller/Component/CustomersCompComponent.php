<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * CustomersComp component
 */
class CustomersCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Customers = null;

    public function customerList(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Customers = TableRegistry::get('Customers');
        $query = $this->Customers->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }
}
