<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RawOrders Controller
 *
 * @property \App\Model\Table\RawOrdersTable $RawOrders
 *
 * @method \App\Model\Entity\RawOrder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RawOrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orgs']
        ];
        $rawOrders = $this->paginate($this->RawOrders);

        $this->set(compact('rawOrders'));
    }

    /**
     * View method
     *
     * @param string|null $id Raw Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rawOrder = $this->RawOrders->get($id, [
            'contain' => ['Orgs']
        ]);

        $this->set('rawOrder', $rawOrder);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rawOrder = $this->RawOrders->newEntity();
        if ($this->request->is('post')) {
            $rawOrder = $this->RawOrders->patchEntity($rawOrder, $this->request->getData());
            if ($this->RawOrders->save($rawOrder)) {
                $this->Flash->success(__('The raw order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw order could not be saved. Please, try again.'));
        }
        $orgs = $this->RawOrders->Orgs->find('list', ['limit' => 200]);
        $this->set(compact('rawOrder', 'orgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Raw Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rawOrder = $this->RawOrders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rawOrder = $this->RawOrders->patchEntity($rawOrder, $this->request->getData());
            if ($this->RawOrders->save($rawOrder)) {
                $this->Flash->success(__('The raw order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The raw order could not be saved. Please, try again.'));
        }
        $orgs = $this->RawOrders->Orgs->find('list', ['limit' => 200]);
        $this->set(compact('rawOrder', 'orgs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Raw Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rawOrder = $this->RawOrders->get($id);
        if ($this->RawOrders->delete($rawOrder)) {
            $this->Flash->success(__('The raw order has been deleted.'));
        } else {
            $this->Flash->error(__('The raw order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
