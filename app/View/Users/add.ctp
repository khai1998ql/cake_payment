<div class="container">
	<div class="mt-5" style="text-align: center; color: red;">
		<h1>Tạo tài khoản</h1>
	</div>
	<?php echo $this->Form->create('User'); ?>
	<div class="form-group">
		<?php echo $this->Form->input('full_name', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nhập tên')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('phone_number', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nhập số điện thoại')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('username', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Nhập tên đăng nhập')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'placeholder' => 'Nhập mật khẩu')); ?>
	</div>
	<?php echo $this->Form->end(__('Tạo tài khoản')); ?>
</div>
