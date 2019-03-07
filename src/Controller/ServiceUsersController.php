<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServiceUsers Controller
 *
 *
 * @method \App\Model\Entity\ServiceUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiceUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $serviceUsers = $this->paginate($this->ServiceUsers);

        $this->set(compact('serviceUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Service User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serviceUser = $this->ServiceUsers->get($id, [
            'contain' => []
        ]);

        $this->set('serviceUser', $serviceUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serviceUser = $this->ServiceUsers->newEntity();
        if ($this->request->is('post')) {
            $serviceUser = $this->ServiceUsers->patchEntity($serviceUser, $this->request->getData());
            if ($this->ServiceUsers->save($serviceUser)) {
                $this->Flash->success(__('The service user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service user could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serviceUser = $this->ServiceUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $serviceUser = $this->ServiceUsers->patchEntity($serviceUser, $this->request->getData());
            if ($this->ServiceUsers->save($serviceUser)) {
                $this->Flash->success(__('The service user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service user could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Service User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $serviceUser = $this->ServiceUsers->get($id);
        if ($this->ServiceUsers->delete($serviceUser)) {
            $this->Flash->success(__('The service user has been deleted.'));
        } else {
            $this->Flash->error(__('The service user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
