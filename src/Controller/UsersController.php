<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //show all user
        $this->paginate = [
            'contain' => ['Orgs'],
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));

        $this->loadComponent('OrgsComp');
        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('user', 'orgs'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Orgs'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $this->loadComponent('UsersComp');
        $this->loadComponent('OrgsComp');
        if ($this->request->is('post')) {
            $dataPost = $this->request->getData();

            if ($this->UsersComp->create($user, $dataPost)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('user', 'orgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $postData =$this->request->getData();
        $id = $postData['userID'];
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $postData);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $orgs = $this->Users->Orgs->find('list', ['limit' => 200]);
        $this->set(compact('user', 'orgs'));
    }

    public function setStat(){
        $postData = $this->request->getData();
        $id = $postData['orgID'];
        $stat = $postData['isactive'];

        if ($this->request->is(['patch', 'post', 'put'])) {
            $userTable = $this->Users->find('orgID', $id);
            $userTable->isactive = $stat;
            if ($this->Users->save($org)) {
                $this->Flash->success(__('The org has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The org could not be saved. Please, try again.'));
        }
        $this->set(compact('user','org'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
