<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'user_id',
            'order' => 'Comment.created DESC'
        ),
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id',
            'order' => 'Post.created DESC'
        )
    );

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Provided Username already exists.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'email' => array(
            'required' => array(
                'rule'    => array('notBlank', 'email'),
                'message' => 'Please supply a valid email address.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Provided Email already exists.'
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}