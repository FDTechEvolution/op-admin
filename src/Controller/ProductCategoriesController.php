<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * ProductCategories Controller
 *
 * @property \App\Model\Table\ProductCategoriesTable $ProductCategories
 *
 * @method \App\Model\Entity\ProductCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductCategoriesController extends AppController
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

        $this->loadComponent('OrgsComp');
        $orgs = $this->OrgsComp->orgList();
        $this->set(compact('productCategories', 'orgs'));

        $productCategories = $this->paginate($this->ProductCategories);
        $this->set(compact('productCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => ['Orgs', 'Products']
        ]);

        $this->set('productCategory', $productCategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productCategory = $this->ProductCategories->newEntity();
        if ($this->request->is('post')) {
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $this->request->getData());
            if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success(__('The product category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product category could not be saved. Please, try again.'));
        }
        $orgs = $this->ProductCategories->Orgs->find('list', ['limit' => 200]);
        $this->set(compact('productCategory', 'orgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $postData = $this->request->getData();
        $id = $postData['cateID'];
        $productCategory = $this->ProductCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productCategory = $this->ProductCategories->patchEntity($productCategory, $postData);
            if ($this->ProductCategories->save($productCategory)) {
                $this->Flash->success(__('The product category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product category could not be saved. Please, try again.'));
        }
        $orgs = $this->ProductCategories->Orgs->find('list', ['limit' => 200]);
        $this->set(compact('productCategory', 'orgs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productCategory = $this->ProductCategories->get($id);
        if ($this->ProductCategories->delete($productCategory)) {
            $this->Flash->success(__('The product category has been deleted.'));
            $productTable = TableRegistry::get('Products');
            $products = $productTable->find()->where(['product_category_id' => $productCategory->id])->toArray();
                foreach($products as $product){
                    $product->product_category_id = $productCategory->id;
                    $productTable->delete($product);
                }
        } else {
            $this->Flash->error(__('The product category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
