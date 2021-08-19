<div class="container mt-4">
	<div>
		<h1 style="font-size: 25px;color: red;font-weight: 700;display: inline;">Thêm mới sản phẩm</h1>
		<div style="display: inline;float: right; margin-left: 5px;" class=""><?php echo $this->HTML->link('Quay lại',
				array('controller' => 'products', 'action' => 'index'),
				array('class' => 'btn btn-danger')); ?><br /></div>
	</div>
	<div class="mt-5">
		<?php
		echo $this->Form->create('Product'); ?>
		<div class="mb-3">
			<?php echo $this->Form->input('product_name', array('type' => 'text','class' => 'form-control')); ?>
		</div>
		<div class="mb-3">
			<?php echo $this->Form->input('product_price', array('type' => 'number','class' => 'form-control')); ?>
		</div>
		<div class="mb-3">
			<?php echo $this->Form->input('number', array('type' => 'number','class' => 'form-control')); ?>
		</div>
		<div class="mb-3">
			<?php echo $this->Form->input('discount', array('type' => 'number','class' => 'form-control', 'value'=> 0)); ?>
		</div>
		<div class="mb-3">
			<?php echo $this->Form->input('barcode', array('type' => 'text','class' => 'form-control')); ?>
		</div>
		<div class="mb-3">
			<?php echo $this->Form->select('status', array(0 => 'Hidden', 1 => 'Public'), array('empty' => false)); ?>
		</div>
		<!--		echo $this->Form->input('name');-->
		<!--		echo $this->Form->select('status', array(0 => 'Hidden', 1 => 'Public'), array('empty' => false));-->
		<?php echo $this->Form->end('Sửa sản phẩm'); ?>
	</div>

</div>

