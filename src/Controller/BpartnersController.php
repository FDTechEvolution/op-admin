<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Bpartners Controller
 *
 *
 * @method \App\Model\Entity\Bpartner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BpartnersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //$bpartners = $this->paginate($this->Bpartners);
       // $this->set(compact('bpartners'));

        $this->loadComponent('OrgsComp');
        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('bpartner', 'orgs'));

        $bpartners =  $this->Bpartners->find()
        ->contain(['Orgs'])
        ->toArray();

        $this->loadComponent('AddressesComp');
        $addresses = $this->AddressesComp->addressList();
        $this->set(compact('bpartners', 'addresses'));
        /*
        $partnerAddrTable = TableRegistry::get('Bpartner_Addresses')->find()->where(['bpartner_id' => $id]);
            foreach($partnerAddrTable as $partnerAddr){
                $address_id = $partnerAddr->address_id;
                $addressTable = TableRegistry::get('Addresses')->find()->where(['id' => $address_id]);
                    $this->set(compact('addressTable'));
            }
        */
    }

    /**
     * View method
     *
     * @param string|null $id Bpartner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bpartner = $this->Bpartners->get($id, [
            'contain' => ['BpartnerAddresses'=>['Addresses']]
        ]);

        $this->set('bpartner', $bpartner);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadComponent('OrgsComp');
        $bpartner = $this->Bpartners->newEntity();
        if ($this->request->is('post')) {
            $bpartner = $this->Bpartners->patchEntity($bpartner, $this->request->getData());
            if ($this->Bpartners->save($bpartner)) {
                $partner_id = $bpartner->id;
                $addressTable = TableRegistry::get('Addresses');
                $address = $addressTable->newEntity();
                $address = $addressTable->patchEntity($address, $this->request->getData());
                if($addressTable->save($address)){
                    $addr_id = $address->id;
                    $partner_address_Table = TableRegistry::get('Bpartner_Addresses');
                    $partner_address = $partner_address_Table->newEntity();
                    $partner_address->bpartner_id = $partner_id;
                    $partner_address->address_id = $addr_id;
                    $partner_address->seq = 0;
                    $partner_address_Table->save($partner_address);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bpartner could not be saved. Please, try again.'));
        }
        $this->set(compact('bpartner'));

        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('bpartner', 'orgs'));
    }

    public function addAddress(){
        $postData =$this->request->getData();
        $id = $postData['partnerID'];
        $addressTable = TableRegistry::get('Addresses');
        $address = $addressTable->newEntity();
        $address = $addressTable->patchEntity($address, $this->request->getData());
            if($addressTable->save($address)){
                $addr_id = $address->id;
                $partner_address_Table = TableRegistry::get('Bpartner_Addresses');
                $partner_address = $partner_address_Table->newEntity();
                $partner_address->bpartner_id = $id;
                $partner_address->address_id = $addr_id;
                $partner_address->seq = 0;
                $partner_address_Table->save($partner_address);
            }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bpartner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $postData =$this->request->getData();
        $id = $postData['partnerID'];
        $bpartner = $this->Bpartners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bpartner = $this->Bpartners->patchEntity($bpartner, $postData);
            if ($this->Bpartners->save($bpartner)) {
                $this->Flash->success(__('The bpartner has been saved.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The bpartner could not be saved. Please, try again.'));
        }
        $this->set(compact('bpartner'));
    }

    public function editAddress(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData=$this->request->getData();
            $id = $postData['addressID'];
            $bpartnerID = $postData['partnerID'];
            
            $addressTable = TableRegistry::get('Addresses');
            $address = $addressTable->find()->where(['id' => $id])->toArray();
                foreach($address as $addr){
                    $addr->line1 = $postData['line1'];
                    $addr->subdistrict = $postData['subdistrict'];
                    $addr->district = $postData['district'];
                    $addr->province = $postData['province'];
                    $addr->zipcode = $postData['zipcode'];
                    $addr->description = $postData['description'];
                    $addressTable->save($addr);
                }
            return $this->redirect(['action' => 'view', $bpartnerID]);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Bpartner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bpartner = $this->Bpartners->get($id);
        if ($this->Bpartners->delete($bpartner)) {
            $partnerAddressTable = TableRegistry::get('Bpartner_Addresses');
            $partnerAddresses = $partnerAddressTable->find()->where(['bpartner_id' => $id]);
                foreach($partnerAddresses as $partnerAddress){
                    $addressTable = TableRegistry::get('Addresses');
                    $addresses = $addressTable->find()->where(['id' => $partnerAddress->address_id]);
                        foreach($addresses as $address){
                            $address->id = $partnerAddress->address_id;
                            $addressTable->delete($address);
                        }
                    $partnerAddress->address_id = $id;
                    $partnerAddressTable->delete($partnerAddress);
                }
        } else {
            $this->Flash->error(__('The bpartner could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delAddress(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData=$this->request->getData();
            $id = $postData['addressID'];
            $bpartnerID = $postData['partnerID'];

            $partnerAddressTable = TableRegistry::get('Bpartner_Addresses');
            $partnerAddresses = $partnerAddressTable->find()->where(['address_id' => $id]);
                foreach($partnerAddresses as $partnerAddress){
                    $addressTable = TableRegistry::get('Addresses');
                    $addresses = $addressTable->find()->where(['id' => $partnerAddress->address_id]);
                        foreach($addresses as $address){
                            $address->id = $partnerAddress->address_id;
                            $addressTable->delete($address);
                        }
                    $partnerAddress->address_id = $id;
                    $partnerAddressTable->delete($partnerAddress);
                }
            return $this->redirect(['action' => 'view', $bpartnerID]);
        }
    }
}