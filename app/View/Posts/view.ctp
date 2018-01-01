<h1><?php echo ($post['Post']['title']); ?></h1>

Category:
<?php echo $this->Html->link($post['Category']['category_name'], array('controller' => 'categories', 'action' => 'index', $post['Post']['category_id'])); ?>
<?php //echo $post['Category']['category_name']; ?></td>
<p><small>Created at: <?php echo $post['Post']['created']; ?></small></p>
<p><small>Created by: <?php echo $post['User']['username']; ?></small></p>
<p><?php echo h($post['Post']['body']); ?></p>

<?php
echo 'Comments By Users : ';
if(!empty($post['Comment'])){

?>

<table>
<thead>
<tr>
<td>user name</td>
<td>comment body</td>
</tr>
</thead>
<tbody>
<?php
    foreach ($post['Comment'] as $key=>$value){?>
    <tr>

    <td><?php echo $value['User']['username'];?></td>
    <td><?php echo $value['body'];?></td>

    </tr>

    <?php } ?>
    </tbdoy>
    </table>
    <?php
}
else {
    echo '<br/>';
    echo 'No Comments Yet';
} ?>

<?php echo $this->Html->link('Add comment', array('controller' => 'comments', 'action' => 'add', $post['Post']['id'])); ?>