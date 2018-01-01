Your Posts

<table>
<tr>
<th>Title</th>
<th>Category</th>
<th>Created</th>
<th>Action</th>
</tr>
<?php foreach ($posts as $post): ?>
<tr>
<td>
<?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link($post['Category']['category_name'], array('controller' => 'categories', 'action' => 'index', $post['Post']['category_id'])); ?>
<?php //echo $post['Category']['category_name']; ?></td>
<td><?php echo $post['Post']['created']; ?></td>

<td>
<?php echo $this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])); ?>

<?php echo $this->Form->postLink('Delete', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?')); ?>
</td>

</tr>
<?php endforeach; ?>
<?php unset($post); ?>
</table>

<?php echo $this->Html->link('Create New Post', array('controller' => 'posts', 'action' => 'add')); ?>