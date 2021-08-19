<div class="container mt-4">
	<div>
		<h1 style="font-size: 25px;color: red;font-weight: 700;display: inline;">Quản lý sản phẩm</h1>
		<div style="display: inline;float: right; margin-left: 5px;" class=""><?php echo $this->HTML->link('Tạo mới sản phẩm',
				array('controller' => 'products', 'action' => 'add'),
				array('class' => 'btn btn-success')); ?><br /></div>
		<div style="display: inline;float: right" class=""><?php echo $this->HTML->link('Xuất Excel',
				array('controller' => 'products', 'action' => 'index', '?xuat_excel=1'),
				array('class' => 'btn btn-primary')); ?><br /></div>
	</div>
	<div class="mt-5">

		<div class="alert alert-dark" role="alert">
			Danh sách sản phẩm
		</div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Tên SP</th>
					<th scope="col">Số lượng</th>
					<th scope="col">Mã vạch</th>
					<th scope="col">Trạng thái</th>
					<th scope="col">Cập nhật lần cuối</th>
					<th scope="col">Hành động</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$count = 1;
				?>
				<?php foreach ($products as $product) : ?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $product['Product']['product_name']; ?></td>
					<td><?php echo $product['Product']['number']; ?></td>
					<td><?php echo $product['Product']['barcode']; ?></td>
					<td>
						<?php if($product['Product']['status'] == 1) : ?>
							<span class="badge bg-success">Public</span>
						<?php else : ?>
							<span class="badge bg-warning text-dark">Hidden</span>
						<?php endif; ?>
					</td>
					<td><?php echo $product['Product']['modified']; ?></td>
					<td>
						<?php echo $this->HTML->link('Xem', array('controller' => 'products', 'action' => 'view', $product['Product']['id']), array('class' => 'btn btn-success')) ?>
						<?php echo $this->HTML->link('Sửa', array('controller' => 'products', 'action' => 'edit', $product['Product']['id']), array('class' => 'btn btn-danger')) ?>
						<?php echo $this->Form->postLink('Xóa', array('controller' => 'products', 'action' => 'delete', $product['Product']['id']), array('class' => 'btn btn-warning')) ?>
					</td>
				</tr>
					<?php
						$count++;
					?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>

