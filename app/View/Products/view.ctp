<div class="container mt-4">
	<div>
		<h1 style="font-size: 25px;color: red;font-weight: 700;display: inline;">Chi tiết sản phẩm</h1>
		<div style="display: inline;float: right; margin-left: 5px;" class=""><?php echo $this->HTML->link('Quay lại',
				array('controller' => 'products', 'action' => 'index'),
				array('class' => 'btn btn-danger')); ?><br /></div>

	</div>
	<div class="mt-5 mb-5">
		<ol class="list-group list-group-numbered">
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Tên sản phẩm</div>
					<?php echo $product['Product']['product_name']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Số lượng còn lại</div>
					<?php echo $product['Product']['number']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Số lượng đã bán</div>
					<?php echo $product['Product']['sold']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Giảm giá</div>
					<?php echo $product['Product']['discount'] . ' %'; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Trạng thái</div>
					<?php if($product['Product']['status'] == 1) : ?>
						<span class="badge bg-success">Public</span>
					<?php else : ?>
						<span class="badge bg-warning text-dark">Hidden</span>
					<?php endif; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Số lượng đã bán</div>
					<?php echo $product['Product']['sold']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Ngày khởi tạo</div>
					<?php echo $product['Product']['created']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Cập nhật lần cuối</div>
					<?php echo $product['Product']['modified']; ?>
				</div>
			</li>
		</ol>
	</div>
	<div style="text-align: center; margin: 30px auto" class="">
		<?php echo $this->HTML->link('Sửa sản phẩm',
				array('controller' => 'products', 'action' => 'edit', $product['Product']['id']),
				array('class' => 'btn btn-danger')); ?>
		<?php echo $this->Form->postLink('Xóa sản phẩm',
				array('controller' => 'products', 'action' => 'delete', $product['Product']['id']),
				array('class' => 'btn btn-dark')); ?>
	</div>
</div>

