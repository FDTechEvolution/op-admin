<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * AddressesComp component
 */
class AddressesCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Addresses = null;

    public function addressList(){
        $this->Addrs = TableRegistry::get('Addresses');
        $query = $this->Addrs->find();

        return $data = $query->toArray();
    }
}
