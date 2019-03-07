<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServiceOrgs Controller
 *
 *
 * @method \App\Model\Entity\ServiceOrg[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiceOrgsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $serviceOrgs = $this->paginate($this->ServiceOrgs);

        $this->set(compact('serviceOrgs'));
    }

    /**
     * View method
     *
     * @param string|null $id Service Org id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serviceOrg = $this->ServiceOrgs->get($id, [
            'contain' => []
        ]);

        $this->set('serviceOrg', $serviceOrg);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serviceOrg = $this->ServiceOrgs->newEntity();
        if ($this->request->is('post')) {
            $serviceOrg = $this->ServiceOrgs->patchEntity($serviceOrg, $this->request->getData());
            if ($this->ServiceOrgs->save($serviceOrg)) {
                $this->Flash->success(__('The service org has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service org could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceOrg'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service Org id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serviceOrg = $this->ServiceOrgs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $serviceOrg = $this->ServiceOrgs->patchEntity($serviceOrg, $this->request->getData());
            if ($this->ServiceOrgs->save($serviceOrg)) {
                $this->Flash->success(__('The service org has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service org could not be saved. Please, try again.'));
        }
        $this->set(compact('serviceOrg'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Service Org id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $serviceOrg = $this->ServiceOrgs->get($id);
        if ($this->ServiceOrgs->delete($serviceOrg)) {
            $this->Flash->success(__('The service org has been deleted.'));
        } else {
            $this->Flash->error(__('The service org could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
