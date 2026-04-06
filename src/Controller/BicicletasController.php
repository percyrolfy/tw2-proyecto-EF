<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bicicletas Controller
 *
 * @property \App\Model\Table\BicicletasTable $Bicicletas
 */
class BicicletasController extends AppController
{   
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Bicicletas->find()->orderByDesc('id');
        $bicicletas = $this->paginate($query);

        $this->set(compact('bicicletas'));
    }

    /**
     * View method
     *
     * @param string|null $id Bicicleta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bicicleta = $this->Bicicletas->get($id);
        $this->set(compact('bicicleta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bicicleta = $this->Bicicletas->newEmptyEntity();
        if ($this->request->is('post')) {
            $bicicleta = $this->Bicicletas->patchEntity($bicicleta, $this->request->getData());
            if ($this->Bicicletas->save($bicicleta)) {
                $this->Flash->success(__('La bicicleta fue guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la bicicleta. Intenta nuevamente.'));
        }
        $this->set(compact('bicicleta'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bicicleta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bicicleta = $this->Bicicletas->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bicicleta = $this->Bicicletas->patchEntity($bicicleta, $this->request->getData());
            if ($this->Bicicletas->save($bicicleta)) {
                $this->Flash->success(__('La bicicleta fue actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar la bicicleta. Intenta nuevamente.'));
        }
        $this->set(compact('bicicleta'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bicicleta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bicicleta = $this->Bicicletas->get($id);
        if ($this->Bicicletas->delete($bicicleta)) {
            $this->Flash->success(__('La bicicleta fue eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la bicicleta. Intenta nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

