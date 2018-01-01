<?php

class PostsController extends AppController {
//    public $helpers = array('Html', 'Form');
    public $components = array('Flash');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->Post->recursive=2;
        $post = $this->Post->find('first', ['conditions' => ['Post.id' =>$id]]);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        $this->set('post', $post);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->Post->set('user_id', $this->Auth->user('id'));
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }

        $Category = ClassRegistry::init('Category');
        $categories = $Category->find('list', ['fields' => ['Category.id', 'Category.category_name']]);

        $this->set(compact('categories'));
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $userId = $this->Auth->user('id');

        $post = $this->Post->find('first', ['conditions' => ['Post.id' => $id, 'Post.user_id' => $userId ]]);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;

            $Category = ClassRegistry::init('Category');
            $categories = $Category->find('list', ['fields' => ['Category.id', 'Category.category_name']]);

            $this->set(compact('categories'));

        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $userId = $this->Auth->user('id');

        $post = $this->Post->find('first', ['conditions' => ['Post.id' => $id, 'Post.user_id' => $userId ]]);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
}