


	<div id="container">
		<div id="header">
			<h1><a href="http://cakephp.org">CakePHP: the rapid development php framework</a></h1>
		</div>
		<div id="content">

<h1>Solutions posts</h1>
  <?php echo $this->Html->link('Add New',
array('controller' => 'solutions', 'action' => 'add')); ?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($solutions as $solution): ?>
    <tr>
        <td><?php echo $solution['Solution']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($solution['Solution']['name'],
array('controller' => 'solutions', 'action' => 'edit', $solution['Solution']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>
</div>