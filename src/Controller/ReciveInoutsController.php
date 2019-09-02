<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ReciveInout Controller
 *
 *
 * @method \App\Model\Entity\ReciveInout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReciveInoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $reciveInouts = TableRegistry::get('shipment_inouts');
        $reciveInout = $reciveInouts->find()
        ->contain(['Orgs', 'FromWarehouses', 'ToWarehouses', 'Users', 'Bpartners']);
        //$this->paginate = [
        //    'contain' => ['Orgs', 'FromWarehouses', 'ToWarehouses', 'Users', 'Bpartners']
        //];
        $shipmentInouts = $this->paginate($this->reciveInout);
        $this->set(compact('shipmentInouts'));

        $this->loadComponent('WarehousesComp');
        $warehouses = $this->WarehousesComp->WHList();
        $this->set(compact('shipmentInouts', 'warehouses'));

        $this->loadComponent('BpartnersComp');
        $bpartners = $this->BpartnersComp->bpartnerList();
        $this->set(compact('shipmentInouts', 'bpartners'));

        $this->loadComponent('UsersComp');
        $users = $this->UsersComp->UsersList();
        $this->set(compact('shipmentInouts', 'users'));
    }

    /**
     * View method
     *
     * @param string|null $id Recive Inout id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reciveInout = $this->ReciveInout->get($id, [
            'contain' => []
        ]);

        $this->set('reciveInout', $reciveInout);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reciveInout = $this->ReciveInout->newEntity();
        if ($this->request->is('post')) {
            $reciveInout = $this->ReciveInout->patchEntity($reciveInout, $this->request->getData());
            if ($this->ReciveInout->save($reciveInout)) {
                $this->Flash->success(__('The recive inout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The recive inout could not be saved. Please, try again.'));
        }
        $this->set(compact('reciveInout'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Recive Inout id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reciveInout = $this->ReciveInout->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reciveInout = $this->ReciveInout->patchEntity($reciveInout, $this->request->getData());
            if ($this->ReciveInout->save($reciveInout)) {
                $this->Flash->success(__('The recive inout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The recive inout could not be saved. Please, try again.'));
        }
        $this->set(compact('reciveInout'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Recive Inout id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reciveInout = $this->ReciveInout->get($id);
        if ($this->ReciveInout->delete($reciveInout)) {
            $this->Flash->success(__('The recive inout has been deleted.'));
        } else {
            $this->Flash->error(__('The recive inout could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
