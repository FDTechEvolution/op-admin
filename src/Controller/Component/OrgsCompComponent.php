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
    
    public function create($orgDataArr = []){
        
        $this->Orgs = TableRegistry::get('Orgs');
        $org = $this->Orgs->newEntity();
        $org = $this->Orgs->patchEntity($org, $orgDataArr);
        
        $resultOfCheckDup = $this->checkDuplicate($orgDataArr['name'],$orgDataArr['code']);
        if($resultOfCheckDup['result']){
            if($this->Orgs->save($org)){
                return ['result'=>true,'msg'=>'success'];
            }else{
                return ['result'=>false,'msg'=>$org->getErrors()];
            }
        }else{
            return $resultOfCheckDup;
        }
        
    }

    public function update($orgId = null,$orgDataArr = []){
        $this->Orgs = TableRegistry::get('Orgs');
        $org = $this->Orgs->find()->where(['id'=>$orgId])->first();

        if(is_null($org)){

        }else{
            $resultOfCheckDup = $this->checkDuplicate($orgDataArr['name'],$orgDataArr['code'],$orgId);
            
            if($resultOfCheckDup['result']){
                $org = $this->Orgs->patchEntity($org, $orgDataArr);
                if($this->Orgs->save($org)){
                    return ['result'=>true,'msg'=>'success'];
                }else{
                    return ['result'=>false,'msg'=>$org->getErrors()];
                }
            }else{
                return $resultOfCheckDup;
            }
        }
    }

    public function orgList(){
        $this->Orgs = TableRegistry::get('Orgs');

        $query = $this->Orgs->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        return $data = $query->toArray();
    }
    
    public function checkDuplicate($name = '',$code = '',$orgId = null){
        $this->Orgs = TableRegistry::get('Orgs');
        $msg = '';
        $result = true;

        if(is_null($orgId)){
            $org = $this->Orgs->find()->where(['name'=>$name])->first();
            if(!is_null($org)){
                $msg = "Name of Organization can't be duplicate,";
                $result = false;
            }
            $org = $this->Orgs->find()->where(['code'=>$code])->first();
            if(!is_null($org)){
                $msg .= "Code of Organization can't be duplicate.";
                $result = false;
            }

        }else{
            $org = $this->Orgs->find()->where(['name'=>$name,'id !='=>$orgId])->first();
            if(!is_null($org)){
                $msg = "Name of Organization can't be duplicate,";
                $result = false;
            }
            $org = $this->Orgs->find()->where(['code'=>$code,'id !='=>$orgId])->first();
            if(!is_null($org)){
                $msg .= "Code of Organization can't be duplicate.";
                $result = false;
            }
        }

        return ['result'=>$result,'msg'=>$msg];
    }

}
