<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ShipmentInouts Controller
 *
 * @property \App\Model\Table\ShipmentInoutsTable $ShipmentInouts
 *
 * @method \App\Model\Entity\ShipmentInout[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShipmentInoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orgs', 'FromWarehouses', 'ToWarehouses', 'Users', 'Bpartners']
        ];
        $shipmentInouts = $this->paginate($this->ShipmentInouts);
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
     * @param string|null $id Shipment Inout id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $shipmentInout = $this->ShipmentInouts->get($id, [
            'contain' => ['Orgs', 'FromWarehouses', 'ToWarehouses', 'Users', 'Bpartners', 'ShipmentInoutLines']
        ]);

        $this->set('shipmentInout', $shipmentInout);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shipmentInout = $this->ShipmentInouts->newEntity();
        if ($this->request->is('post')) {
            $this->log($this->request->getData(),'debug');
            $shipmentInout = $this->ShipmentInouts->patchEntity($shipmentInout, $this->request->getData());
            if ($this->ShipmentInouts->save($shipmentInout)) {
                $shipment_id = $shipmentInout->id;
                $this->Flash->success(__('The shipment inout has been saved.'));

                return $this->redirect(['action' => 'edit', $shipment_id]);
            }
            $this->Flash->error(__('The shipment inout could not be saved. Please, try again.'));
        }
        $orgs = $this->ShipmentInouts->Orgs->find('list', ['limit' => 200]);
        $fromWarehouses = $this->ShipmentInouts->FromWarehouses->find('list', ['limit' => 200]);
        $toWarehouses = $this->ShipmentInouts->ToWarehouses->find('list', ['limit' => 200]);
        $users = $this->ShipmentInouts->Users->find('list', ['limit' => 200]);
        $bpartners = $this->ShipmentInouts->Bpartners->find('list', ['limit' => 200]);
        $this->set(compact('shipmentInout', 'orgs', 'fromWarehouses', 'toWarehouses', 'users', 'bpartners'));
    }

    public function addShipment(){
        $postData = $this->request->getData();
        $SMinOut = TableRegistry::get('shipment_inout_lines');
        
        if ($this->request->is('post')) {
            foreach($postData['products'] as $key => $product){
                if(!isset($postData['SMids'][$key]['SMid'])){
                    $shipmentInoutLine = $SMinOut->newEntity();
                    $shipmentInoutLine->shipment_inout_id = $postData['shipment_inout_id'];
                    $shipmentInoutLine->product_id = $product['product_id'];
                    $shipmentInoutLine->qty = $postData['qtys'][$key]['qty'];
                    if(!empty($postData['qtys'][$key]['qty'])){
                        $SMinOut->save($shipmentInoutLine);
                    }
                }elseif(isset($postData['SMids'][$key]['SMid'])){
                    $shipmentInoutLine = $SMinOut->get($postData['SMids'][$key]['SMid']);
                    $shipmentInoutLine->qty = $postData['qtys'][$key]['qty'];
                    if(!empty($postData['qtys'][$key]['qty'])){
                        $SMinOut->save($shipmentInoutLine);
                    }
                }
            }
            $shipmentInout = $this->ShipmentInouts->get($postData['shipment_inout_id']);
            $shipmentInout->status = 'DX';
            if($this->ShipmentInouts->save($shipmentInout)){
                return $this->redirect(['action' => 'edit', $postData['shipment_inout_id']]);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Shipment Inout id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shipmentInout = $this->ShipmentInouts->get($id, [
            'contain' => ['Orgs', 'FromWarehouses', 'ToWarehouses', 'Users', 'Bpartners', 'ShipmentInoutLines']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shipmentInout = $this->ShipmentInouts->patchEntity($shipmentInout, $this->request->getData());
            if ($this->ShipmentInouts->save($shipmentInout)) {
                $this->Flash->success(__('The shipment inout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The shipment inout could not be saved. Please, try again.'));
        }
        $orgs = $this->ShipmentInouts->Orgs->find('list', ['limit' => 200]);
        $fromWarehouses = $this->ShipmentInouts->FromWarehouses->find('list', ['limit' => 200]);
        $toWarehouses = $this->ShipmentInouts->ToWarehouses->find('list', ['limit' => 200]);
        $users = $this->ShipmentInouts->Users->find('list', ['limit' => 200]);
        $bpartners = $this->ShipmentInouts->Bpartners->find('list', ['limit' => 200]);
        $this->set(compact('shipmentInout', 'orgs', 'fromWarehouses', 'toWarehouses', 'users', 'bpartners'));

        $this->loadComponent('ProductsComp');
        $products = $this->ProductsComp->productsList();
        $this->set(compact('shipmentInout', 'products'));

        $shipmentProducts = TableRegistry::get('shipment_inout_lines');
        $SMproducts = $shipmentProducts->find()->where(['shipment_inout_id' => $id]);
        if(isset($SMproducts)){
            $this->set(compact('shipmentInout', 'SMproducts'));
        }
    }

    public function addtowarehouse(){
        $postData = $this->request->getData();
        $id = $postData['shipment_inout_id'];
        $warehouses = TableRegistry::get('warehouse_lines');
        $shipmentLines = TableRegistry::get('shipment_inout_lines');
        $shipmentInout = $this->ShipmentInouts->get($id);
        if($this->request->is('post')){
            $shipmentLine = $shipmentLines->find()->where(['shipment_inout_id' => $id]);
            foreach($shipmentLine as $shipment){
                $warehouse = $warehouses->newEntity();
                $warehouse->product_id = $shipment->product_id;
                $warehouse->warehouse_id = $shipmentInout->to_warehouse_id;
                $warehouse->qty = $shipment->qty;
                $warehouses->save($warehouse);
            }
            $shipmentInout->status = 'CO';
            if($this->ShipmentInouts->save($shipmentInout)){
                return $this->redirect(['action' => 'edit', $id]);
            }
        }
    }

    public function endofwarehouse(){
        $postData = $this->request->getData();
        $id = $postData['shipment_inout_id'];
        $shipmentInout = $this->ShipmentInouts->get($id);
        $shipmentInout->status = 'VO';
            if($this->ShipmentInouts->save($shipmentInout)){
                return $this->redirect(['action' => 'edit', $id]);
            }
    }

    /**
     * Delete method
     *
     * @param string|null $id Shipment Inout id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shipmentInout = $this->ShipmentInouts->get($id);
        if ($this->ShipmentInouts->delete($shipmentInout)) {
            $this->Flash->success(__('The shipment inout has been deleted.'));
        } else {
            $this->Flash->error(__('The shipment inout could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
