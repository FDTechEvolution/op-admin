<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * OrgsCommp component
 */
class OrgsCompComponent extends Component {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Orgs = null;
    
    public function create($org,$data){
        
        $this->Orgs = TableRegistry::get('Orgs');
        
        
        //$this->log($data,'debug');
        
        $org = $this->Orgs->patchEntity($org, $data);
        
        //$org->name = $data['name'].'hello';
        
        
        if($this->Orgs->save($org)){
            return true;
        }else{
            return false;
        }
    }
    
    public function update(){
        
    }

}
