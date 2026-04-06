<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{   
    /**
     * Acciones sin sesión (formulario de acceso en `/`).
     *
     * @var array<string, bool>
     */
    protected array $unauthenticatedActions = [
        'login' => true,
        'register' => true,
    ];

    /**
     * Comprueba la contraseña: admite hash bcrypt y texto plano (datos heredados).
     */
    private function passwordsMatch(string $plain, ?string $stored): bool
    {
        if ($stored === null || $stored === '') {
            return false;
        }
        if (str_starts_with($stored, '$2y$')
            || str_starts_with($stored, '$2a$')
            || str_starts_with($stored, '$2b$')) {
            return password_verify($plain, $stored);
        }

        return hash_equals($stored, $plain);
    }

    /**
     * Acceso con correo y contraseña (`users.correo`, `users.password`).
     *
     * @return \Cake\Http\Response|null|void
     */
    public function login()
    {
        $session = $this->request->getSession();
        if ($session->read('Auth.user')) {
            return $this->redirect(['controller' => 'Tasks', 'action' => 'index']);
        }

        if ($this->request->is('post')) {
            $correo = (string)$this->request->getData('correo');
            $password = (string)$this->request->getData('password');
            $user = $this->Users->find()->where(['correo' => $correo])->first();

            if ($user !== null && $this->passwordsMatch($password, $user->password)) {
                $session->write('Auth.user', [
                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'correo' => $user->correo,
                    'lenguaje' => $user->lenguaje ?? 'es',
                ]);
                $this->Flash->success(__('Welcome, {0}.', $user->nombre));

                return $this->redirect(['controller' => 'Tasks', 'action' => 'index']);
            }
            $this->Flash->error(__('Invalid email or password.'));
        }
    }

    /**
     * Registro público de cuenta.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function register()
    {
        $session = $this->request->getSession();
        if ($session->read('Auth.user')) {
            return $this->redirect(['controller' => 'Tasks', 'action' => 'index']);
        }

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => ['nombre', 'apellido', 'correo', 'password', 'lenguaje'],
            ]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your account was created. Please sign in.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('We could not create your account. Please check the form and try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Perfil: idioma preferido (y nombre) del usuario autenticado.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function profile()
    {
        $uid = (int)$this->request->getSession()->read('Auth.user.id');
        $user = $this->Users->get($uid);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => ['nombre', 'apellido', 'lenguaje'],
            ]);
            if ($this->Users->save($user)) {
                $session = $this->request->getSession();
                $auth = $session->read('Auth.user');
                $auth['nombre'] = $user->nombre;
                $auth['apellido'] = $user->apellido;
                $auth['lenguaje'] = $user->lenguaje ?? 'es';
                $session->write('Auth.user', $auth);
                $this->Flash->success(__('Your profile has been updated.'));

                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Cierra sesión y vuelve al login.
     *
     * @return \Cake\Http\Response|null
     */
    public function logout()
    {
        $this->request->getSession()->delete('Auth.user');
        $this->Flash->success(__('You have been signed out.'));

        return $this->redirect(['action' => 'login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (isset($data['password']) && $data['password'] === '') {
                unset($data['password']);
            }
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
