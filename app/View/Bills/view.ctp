<?php
//	debug($bills);die;
?>
<div class="container mt-4">
	<div>
		<h1 style="font-size: 25px;color: red;font-weight: 700;display: inline;">Quản lý hóa đơn</h1>
		<div style="display: inline;float: right; margin-left: 5px;" class=""><?php echo $this->HTML->link('Thêm mới đơn hàng',
				array('controller' => 'bills', 'action' => 'index'),
				array('class' => 'btn btn-success')); ?><br /></div>
		<div style="display: inline;float: right" class=""><?php echo $this->HTML->link('Xuất Excel',
				array('controller' => 'bills', 'view' => 'index', '?xuat_excel=1'),
				array('class' => 'btn btn-primary')); ?><br /></div>
	</div>
	<div class="mt-5">

		<div class="alert alert-dark" role="alert">
			Danh sách đơn hàng
		</div>
		<table class="table">
			<thead>
			<tr>
				<th scope="col">STT</th>
				<th scope="col">Tên khách hàng</th>
				<th scope="col">Tổng tiền</th>
				<th scope="col">Ngày khởi tạo</th>
				<th scope="col">Hành động</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$count = 1;
			?>
			<?php foreach ($bills as $bill) : ?>
				<tr>
					<td><?php echo $count; ?></td>
					<td><?php echo $bill['User']['full_name']; ?></td>
					<td><?php echo $this->Lib->formatPrice($bill['Bill']['total_bill']); ?></td>
					<td><?php echo $bill['Bill']['created']; ?></td>
					<td>
						<?php echo $this->HTML->link('Xem', array('controller' => 'bills', 'action' => 'detail', $bill['Bill']['id']), array('class' => 'btn btn-success')) ?>
						<?php echo $this->Form->postLink('Xóa', array('controller' => 'bills', 'action' => 'delete', $bill['Bill']['id']), array('class' => 'btn btn-warning')) ?>
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

