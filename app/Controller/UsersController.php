<?php

class UsersController extends AppController {
    public $helpers = array('Html', 'Form');

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                $this->Auth->login();
                return $this->redirect(array('controller' => 'Posts', 'action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function login() {
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function beforeFilter() {
        $this->Auth->allow('add', 'login');
    }
}