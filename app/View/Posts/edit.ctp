Edit Post
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '5'));
echo $this->Form->input('category_id', ['options' => $categories]);
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>