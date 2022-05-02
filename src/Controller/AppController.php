<?php

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
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Candidatos',
                'action' => 'indexAdmin'
            ],
            'loginAction' => [
                'controller' => 'pages',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'pages',
                'action' => 'home'
            ],


            'authError' => 'Usuário ou senha inválida.',


        ]);
        $this->Auth->allow(['display']);

        if ($this->request->getSession()->read('Auth.User')) {
            $userName = $this->request->getSession()->read('Auth.User');

            // debug($userName['sistema']);
            // die;
            if ($userName['active'] == 1) {
                $this->viewBuilder()->setLayout('home');
            }
        }



        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
    }

    public function isAuthorized($user)
    {
        if ((isset($user['active'])) &&
            (isset($user['sistema'])) &&
            ($user['active'] == 1 && $user['sistema'] == 1)
        ) {
            return true;
        }
        return false;
    }
}
