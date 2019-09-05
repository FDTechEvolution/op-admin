<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orgs', 'Customers', 'Users', 'RawOrders'],
            'order' => ['Orders.created' => 'DESC']
        ];
        $orders = $this->paginate($this->Orders);
        $this->set(compact('orders'));

        $this->loadComponent('CustomersComp');
        $customers = $this->CustomersComp->customerList();
        $this->set(compact('customers'));

        $this->loadComponent('UsersComp');
        $users = $this->UsersComp->UsersList();
        $this->set(compact('users'));

        $status = [
            ['value' => 'CO', 'text' => 'Complete'],
            ['value' => 'VO', 'text' => 'Delete']
        ];
        $this->set('status', $status);
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Orgs', 'Customers', 'Users', 'RawOrders', 'OrderLines']
        ]);

        $this->set('order', $order);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $orderdate = date('Y-m-d');
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            $order->org_id = $ORG_ID;
            $order->orderdate = $orderdate;
            $order->status = 'DR';
            $order->totalamt = 0;
            if ($this->Orders->save($order)) {
                $orderId = $order->id;
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'edit', $orderId]);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $orgs = $this->Orders->Orgs->find('list', ['limit' => 200]);
        $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $rawOrders = $this->Orders->RawOrders->find('list', ['limit' => 200]);
        $this->set(compact('order', 'orgs', 'customers', 'users', 'rawOrders'));
    }

    public function addToOrderLines(){
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');
        $postData = $this->request->getData();
        $orderlines = TableRegistry::get('Order_lines');
        $productTable = TableRegistry::get('Products');
        $totalamt = 0;
        
        if ($this->request->is('post')) {
            foreach($postData['products'] as $key => $product){
                if(!isset($postData['ODids'][$key]['ODid'])){
                    $orderline = $orderlines->newEntity();
                    $orderline->org_id = $ORG_ID;
                    $orderline->order_id = $postData['order_id'];
                    $orderline->product_id = $product['product_id'];
                    $orderline->qty = $postData['qtys'][$key]['qty'];
                    $query = $productTable->find()->where(['id' => $product['product_id']])->first();
                    $orderline->price = $query->price;
                    $orderline->amount = $this->amountPrice($orderline->qty, $orderline->price);
                    if(!empty($postData['qtys'][$key]['qty'])){
                        $orderlines->save($orderline);
                    }
                }elseif(isset($postData['ODids'][$key]['ODid'])){
                    $orderline = $orderlines->get($postData['ODids'][$key]['ODid']);
                    $orderline->qty = $postData['qtys'][$key]['qty'];
                    $query = $productTable->find()->where(['id' => $product['product_id']])->first();
                    $orderline->price = $query->price;
                    $orderline->amount = $this->amountPrice($orderline->qty, $orderline->price);
                    if(!empty($postData['qtys'][$key]['qty'])){
                        $orderlines->save($orderline);
                    }else{
                        $orderlineDel = $orderlines->get($postData['ODids'][$key]['ODid']);
                        $orderlines->delete($orderlineDel);
                    }
                }
                $totalamt += $this->amountPrice($orderline->qty, $orderline->price);
            }
            $this->setStatus($postData['order_id'], $totalamt);
        }
    }

    public function addTracking(){
        if($this->request->is('post')){
            $postData = $this->request->getData();
            $order = $this->Orders->get($postData['order_id']);
            $order->trackingno = $postData['trackingno'];
            if($this->Orders->save($order)){
                if(isset($postData['pointer'])){
                    return $this->redirect(['action' => 'index']);
                }else{
                    return $this->redirect(['action' => 'edit', $postData['order_id']]);
                }
            }
        }
    }

    private function amountPrice($qty, $price){
        $amount = 0;
        if (is_numeric($qty) && is_numeric($price)) {
            $amount = ($qty*$price);
        }
        return $amount;
    }

    private function setStatus($orderID, $totalamt){
        $orderlines = TableRegistry::get('Order_lines');
        $orderline = $orderlines->find()->where(['order_id' => $orderID])->toArray();
            if(sizeof($orderline) != 0){
                $order = $this->Orders->get($orderID);
                $order->status = 'DX';
                $order->totalamt = $totalamt;
                if($this->Orders->save($order)){
                    return $this->redirect(['action' => 'edit', $orderID]);
                }
            }else{
                $order = $this->Orders->get($orderID);
                $order->status = 'DR';
                $order->totalamt = 0;
                if($this->Orders->save($order)){
                    return $this->redirect(['action' => 'edit', $orderID]);
                }
            }
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ORG_ID = $this->request->getSession()->read('Core.golbal.org_id');
        $order = $this->Orders->get($id, [
            'contain' => ['Customers', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $orgs = $this->Orders->Orgs->find('list', ['limit' => 200]);
        $customers = $this->Orders->Customers->find('list', ['limit' => 200]);
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $rawOrders = $this->Orders->RawOrders->find('list', ['limit' => 200]);
        $this->set(compact('order', 'orgs', 'customers', 'users', 'rawOrders'));

        $this->loadComponent('ProductsComp');
        $products = $this->ProductsComp->productsList();
        $this->set(compact('products'));

        $Order_Line = TableRegistry::get('Order_lines');
        $orderlines = $Order_Line->find()->where(['order_id' => $id]);
        if(isset($orderlines)){
            $this->set(compact('orderlines'));
        }
    }

    public function orderConfirm(){
        if($this->request->is('post')){
            $order = $this->Orders->get($this->request->getData());
            $order->status = "CO";
            if($this->Orders->save($order)){
                return $this->redirect(['action' => 'edit', $order->id]);
            }
        }
    }

    public function orderChangeStatusArray(){
        $postData = $this->request->getData();
        $orderlines = TableRegistry::get('Order_lines');

        if($this->request->is('post')){
            foreach($postData['orders'] as $key => $orderId){
                $orderline = $orderlines->find()->where(['order_id' => $postData['orders'][$key]['order_id']])->toArray();
                if(sizeof($orderline) != 0){
                    $order = $this->Orders->get($postData['orders'][$key]['order_id']);
                    $order->status = $postData['status'];
                    $this->Orders->save($order);
                }
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function orderCancel(){
        if($this->request->is('post')){
            $order = $this->Orders->get($this->request->getData());
            $order->status = "VO";
            if($this->Orders->save($order)){
                return $this->redirect(['action' => 'edit', $order->id]);
            }
        }
    }
}
