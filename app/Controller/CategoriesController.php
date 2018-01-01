<?php

class CategoriesController extends AppController {
    public function index($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        $Post = ClassRegistry::init('Post');
        $posts = $Post->find('all', ['conditions' => ['Post.category_id' => $id]]);

        $this->set('posts', $posts);
    }
}