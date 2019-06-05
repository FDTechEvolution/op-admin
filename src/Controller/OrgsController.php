<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Orgs Controller
 *
 * @property \App\Model\Table\OrgsTable $Orgs
 *
 * @method \App\Model\Entity\Org[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrgsController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->getRequest()->getSession()->write('Core.golbal.org_id',NULL);
        $orgs = $this->Orgs->find()
                ->where(['Orgs.id !='=>'0'])
                ->toArray();

        $ORG_ID = NULL;
        $this->set(compact('ORG_ID'));
        $this->set(compact('orgs'));
    }
    
    public function dashboard($orgId = null){
        $this->getRequest()->getSession()->write('Core.golbal.org_id',$orgId);
        $ORG_ID = $orgId;
        $this->set(compact('ORG_ID'));
    }

    /**
     * View method
     *
     * @param string|null $id Org id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $org = $this->Orgs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('org', $org);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $org = $this->Orgs->newEntity();
        
        if($this->request->is(['post'])){
            $this->loadComponent('OrgsComp');
            $dataPost = $this->request->getData();
            //$this->log($dataPost,'debug');
            
            if($this->OrgsComp->create($org,$dataPost)){
                return $this->redirect(['action'=>'index']);
            }
            
        }
        
        $this->set(compact('org'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Org id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $org = $this->Orgs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $org = $this->Orgs->patchEntity($org, $this->request->getData());
            if ($this->Orgs->save($org)) {
                $this->Flash->success(__('The org has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The org could not be saved. Please, try again.'));
        }
        $this->set(compact('org'));
    }

    public function setStat(){
        $postData = $this->request->getData();
        $id = $postData['orgID'];
        $getStat = $postData['isactive'];
        $org = $this->Orgs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $org = $this->Orgs->patchEntity($org, $postData);
            if ($this->Orgs->save($org)) {
                $userTable = TableRegistry::get('Users');
                $users = $userTable->find()->where(['org_id'=>$org->id])->toArray();
               
                foreach($users as $user){
                    $user->isactive = $getStat;
                    $userTable->save($user);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The org could not be saved. Please, try again.'));
        }
        $this->set(compact('org'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Org id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $org = $this->Orgs->get($id);
        if ($this->Orgs->delete($org)) {
            $userTable = TableRegistry::get('Users');
            $users = $userTable->find()->where(['org_id'=>$org->id])->toArray();

            foreach($users as $user){
                $user->org_id = $org->id;
                $userTable->delete($user);
            }

        } else {
            $this->Flash->error(__('The org could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
