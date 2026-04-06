<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 */
class TasksController extends AppController
{  
    /**
     * @return int
     */
    private function authUserId(): int
    {
        $id = $this->request->getSession()->read('Auth.user.id');

        return (int)$id;
    }

    /**
     * Lista solo las tareas del usuario autenticado.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function index()
    {
        $uid = $this->authUserId();
        $query = $this->Tasks->find()
            ->where(['Tasks.user_id' => $uid])
            ->orderByDesc('Tasks.modified');
        $tasks = $this->paginate($query);

        $estados = \App\Model\Table\TasksTable::estadosDisponibles();
        $this->set(compact('tasks', 'estados'));
    }

    /**
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void
     */
    public function view($id = null)
    {
        $uid = $this->authUserId();
        $task = $this->Tasks->find()
            ->where(['Tasks.id' => $id, 'Tasks.user_id' => $uid])
            ->firstOrFail();

        $this->set(compact('task'));
    }

    /**
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $task = $this->Tasks->newEmptyEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData(), [
                'fields' => ['titulo', 'descripcion', 'estado', 'fecha_limite'],
            ]);
            $task->user_id = $this->authUserId();
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $estados = \App\Model\Table\TasksTable::estadosDisponibles();
        $this->set(compact('task', 'estados'));
    }

    /**
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null|void
     */
    public function edit($id = null)
    {
        $uid = $this->authUserId();
        $task = $this->Tasks->find()
            ->where(['Tasks.id' => $id, 'Tasks.user_id' => $uid])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData(), [
                'fields' => ['titulo', 'descripcion', 'estado', 'fecha_limite'],
            ]);
            $task->user_id = $uid;
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $estados = \App\Model\Table\TasksTable::estadosDisponibles();
        $this->set(compact('task', 'estados'));
    }

    /**
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $uid = $this->authUserId();
        $task = $this->Tasks->find()
            ->where(['Tasks.id' => $id, 'Tasks.user_id' => $uid])
            ->firstOrFail();

        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
