<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * UsersComp component
 */
class UsersCompComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public $Users = null;

    public function create($user, $data){
        $this->Users = TableRegistry::get('Users'); // ชี้เป้าไปที่ DB table Users
        //$this->log($data,'debug');
        $user = $this->Users->patchEntity($user, $data); // ทำการแมทช์แต่ละฟิลด์กับข้อมูลที่รับเข้ามา

        if($this->Users->save($user)){ // ทำการบันทึก
            return true;
        }else{
            return false;
        }
    }

    public function UsersList(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');

        $this->Users = TableRegistry::get('Users');
        $query = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['org_id' => $ORG_ID]);
        return $data = $query->toArray();
    }
}
