<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Customers Controller
 *
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);
        $this->set(compact('customers'));

        $this->loadComponent('OrgsComp');
        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('customer', 'orgs'));

        
        $cusTable = TableRegistry::get('Customers')->find();
        foreach($cusTable as $cus){
            $cus_id = $cus->id;
            $cusAddrTable = TableRegistry::get('Customer_Addresses')->find()->where(['customer_id' => $cus_id]);
                foreach($cusAddrTable as $cusAddr){
                    $address_id = $cusAddr->address_id;
                    $address = TableRegistry::get('Addresses')->find()->where(['id' => $address_id])->toArray();
                        $this->set(compact('customer', 'addresses'));
                }
        }

    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        $this->loadComponent('OrgsComp');
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $cus_id = $customer->id;
                $addressTable = TableRegistry::get('Addresses');
                $address = $addressTable->newEntity();
                $address = $addressTable->patchEntity($address, $this->request->getData());
                if($addressTable->save($address)){
                    $addr_id = $address->id;
                    $cus_address_Table = TableRegistry::get('Customer_Addresses');
                    $cus_address = $cus_address_Table->newEntity();
                    $cus_address->customer_id = $cus_id;
                    $cus_address->address_id = $addr_id;
                    $cus_address->seq = 0;
                    $cus_address_Table->save($cus_address);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));

        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('customer', 'orgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
