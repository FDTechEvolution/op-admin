<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * BpartnersComp component
 */
class BpartnersCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $bpartners = null;

    public function bpartnerList(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Bpartners = TableRegistry::get('Bpartners');
        $query = $this->Bpartners->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }
}
