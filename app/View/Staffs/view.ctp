<div class="staffs view">
<h2><?php echo __('Staff'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($staff['Staff']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Staff'), array('action' => 'edit', $staff['Staff']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Staff'), array('action' => 'delete', $staff['Staff']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $staff['Staff']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Staffs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Staff'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bills'), array('controller' => 'bills', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bill'), array('controller' => 'bills', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bills'); ?></h3>
	<?php if (!empty($staff['Bill'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Staff Id'); ?></th>
		<th><?php echo __('Subtotal'); ?></th>
		<th><?php echo __('Total Discount'); ?></th>
		<th><?php echo __('Total Bill'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($staff['Bill'] as $bill): ?>
		<tr>
			<td><?php echo $bill['id']; ?></td>
			<td><?php echo $bill['user_id']; ?></td>
			<td><?php echo $bill['staff_id']; ?></td>
			<td><?php echo $bill['subtotal']; ?></td>
			<td><?php echo $bill['total_discount']; ?></td>
			<td><?php echo $bill['total_bill']; ?></td>
			<td><?php echo $bill['note']; ?></td>
			<td><?php echo $bill['created']; ?></td>
			<td><?php echo $bill['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bills', 'action' => 'view', $bill['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bills', 'action' => 'edit', $bill['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bills', 'action' => 'delete', $bill['id']), array('confirm' => __('Are you sure you want to delete # %s?', $bill['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bill'), array('controller' => 'bills', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
