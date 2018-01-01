
<h1>Add Comment</h1>
<?php

echo $this->Form->create('Comment');
echo $this->Form->input('body', array('rows' => '5'));

echo $this->Form->end('Save Post');
?>