<?php
//$data = $this->Product->query("Select * from `products` where 1");
//debug($detail['Detail']);die;
?>
<div class="container mt-4">
	<div>
		<h1 style="font-size: 25px;color: red;font-weight: 700;display: inline;">Chi tiết đơn hàng</h1>
		<div style="display: inline;float: right; margin-left: 5px;" class=""><?php echo $this->HTML->link('Quay lại',
				array('controller' => 'bills', 'action' => 'view'),
				array('class' => 'btn btn-danger')); ?><br /></div>

	</div>
	<div class="mt-5 mb-5">
		<ol class="list-group list-group-numbered">
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Tên khách hàng</div>
					<?php echo $detail['User']['full_name']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Số điện thoại khách hàng</div>
					<?php echo $detail['User']['phone_number']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Tổng tiền tạm tính</div>
					<?php echo $this->Lib->formatPrice($detail['Bill']['subtotal']); ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Giảm giá</div>
					<?php echo $this->Lib->formatPrice($detail['Bill']['total_discount']); ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Tổng tiền</div>
					<?php echo $this->Lib->formatPrice($detail['Bill']['total_bill']); ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Ghi chú</div>
					<?php echo $detail['Bill']['note']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Thời gian đặt hàng</div>
					<?php echo $detail['Bill']['created']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Cập nhật lần cuối</div>
					<?php echo $detail['Bill']['modified']; ?>
				</div>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-start">
				<div class="ms-2 me-auto">
					<div class="fw-bold">Danh sách sản phẩm</div>
					<table class="table">
						<thead>
							<tr>
								<th scope="col">STT</th>
								<th scope="col">Tên sản phẩm</th>
								<th scope="col">Giá sản phẩm</th>
								<th scope="col">Số lượng</th>
								<th scope="col">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$count = 1;
						?>
							<?php foreach ($detail['Detail'] as $item) : ?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $item['product']['product_name']; ?></td>
								<td><?php echo $this->Lib->formatPrice($item['product']['product_price']); ?></td>
								<td><?php echo $item['number']; ?></td>
								<td><?php echo $this->Lib->formatPrice($item['single_price']); ?></td>
							</tr>
								<?php
									$count++;
								?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</li>
		</ol>
	</div>
</div>

