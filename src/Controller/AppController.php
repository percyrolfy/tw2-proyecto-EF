<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Actions that don't require authentication.
     *
     * @var array<string, bool>
     */
    protected array $unauthenticatedActions = [];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        $session = $this->request->getSession();
        $user = $session->read('Auth.user');
        $this->setUserLocale($user);

        $action = (string)$this->request->getParam('action');
        if (isset($this->unauthenticatedActions[$action])) {
            return;
        }

        if (!$user) {
            $this->Flash->error(__('You must sign in to continue.'));
            $response = $this->redirect(['controller' => 'Users', 'action' => 'login']);
            if ($response !== null) {
                $event->setResult($response);
            }

            return;
        }

        $this->set('authUser', $user);
    }

    /**
     * Ajusta el idioma de la interfaz según `users.lenguaje` del usuario en sesión.
     *
     * @param array<string, mixed>|null $user Datos de `Auth.user`.
     * @return void
     */
    protected function setUserLocale(?array $user): void
    {
        $lang = null;
        if (is_array($user) && isset($user['lenguaje']) && is_string($user['lenguaje'])) {
            $lang = $user['lenguaje'];
        }
        $allowed = ['es' => 'es', 'en' => 'en', 'pt' => 'pt', 'fr' => 'fr'];
        I18n::setLocale($allowed[$lang] ?? 'es');
    }
    
}
