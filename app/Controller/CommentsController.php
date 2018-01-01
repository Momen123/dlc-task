<?php

class CommentsController extends AppController {
    public function add($id) {
        if ($this->request->is('post')) {
            $this->Comment->create();
            $this->Comment->set('user_id', $this->Auth->user('id'));
            $this->Comment->set('post_id', $id);
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success(__('Your Comment has been saved.'));
                return $this->redirect(array('controller'=>'posts', 'action' => 'view', $id));
            }
            $this->Flash->error(__('Unable to add your Comment.'));
        }
    }
}