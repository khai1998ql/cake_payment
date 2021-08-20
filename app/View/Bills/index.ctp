<?php

//	debug($this->Session->read('data'));
?>

<div style="text-align: center; color: red; font-weight: 700; margin: 30px auto; font-size: 25px;">
	TẠO HÓA ĐƠN
</div>
<div class="card">
	<div class="container">

		<div class="row">
			<div class="col-8 mt-1" style="background-color: white">
				<div class="card-body">
					<div class="bill_customer mb-3">
						<form class="bill_customer_form" action="" method="POST" id="bill_customer_form">
							<input type="text" id="phone_number" <?php if($this->Session->read('data.data_customer.user_text')) : ?> value="<?php echo $this->Session->read('data.data_customer.user_text'); ?>"  <?php endif; ?> name="phone_number" placeholder="Nhập sđt khách hàng" style="width: 250px;">
							<div style="margin: 0 10px; margin-top: 5px; cursor: pointer;" title="Xóa" onclick="deleteCustomer()"><i class="fas fa-times" style="background-color: black; color: red; font-size: 20px; width: 20px; height: 20px;"></i></div>
							<button type="submit" class="btn btn-sm btn-danger">Submit</button>
						</form>
					</div>
					<div class="bill_search_product">
						<form class="bill_barcode_form" action="" method="POST" id="bill_barcode_form">
							<input type="text" id="product_barcode" name="product_barcode" placeholder="Nhập mã vạch sản phẩm">
							<input type="number" id="product_qty" name="product_qty" value="1" class="ml-3" style="width: 50px;">
							<div style="margin: 0 10px; margin-top: 5px; cursor: pointer;" title="Xóa" onclick="deleteBarcode()"><i class="fas fa-times" style="background-color: black; color: red; font-size: 20px; width: 20px; height: 20px;"></i></div>
							<button type="submit" class="btn btn-sm btn-danger">Submit</button>
						</form>
					</div>
					<div class="bill_product mt-1">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Mã vạch</th>
									<th scope="col">Tên hàng hóa</th>
									<th scope="col">Số lượng</th>
									<th scope="col">Đơn giá</th>
									<th scope="col">Thành tiền</th>
									<th scope="col">Hành động</th>
								</tr>
							</thead>
							<tbody id="bill_product_table">
								<?php if($this->Session->read('data.data_products')) :  ?>
									<?php foreach ($this->Session->read('data.data_products') as $key => $item) : ?>
									<tr id="row_<?php echo $key; ?>">
										<td><?php echo $item['barcode'] ?></td>
										<td><?php echo $item['product_name'] ?></td>
<!--										<td>--><?php //echo $item['product_qty'] ?><!--</td>-->
										<td><input type="number" min="1" value="<?php echo $item['product_qty'] ?>" id="number_<?php echo $key; ?>" onchange="onChangeQty(this.id)" class="bill_product_table_input"></td>
										<td id="product_price_<?php echo $key; ?>"><?php echo $this->Lib->formatPrice($item['product_price']); ?></td>
										<td id="single_price_<?php echo $key; ?>"><?php echo $this->Lib->formatPrice($item['single_price']); ?></td>
										<td><span class="btn btn-sm btn-danger" style="cursor: pointer" id="delete_<?php echo $key; ?>" onclick="onDeleteProduct(this.id)">Xóa</span></td>
									</tr>
									<?php endforeach; ?>
								<?php else: ?>

								<?php endif; ?>
							</tbody>

						</table>
					</div>
					<hr />
					<div class="bill_payment">
						<div class="bill_payment_text">Tổng tiền hàng</div>
						<?php if($this->Session->read('data.data_products')) :  ?>
							<div class="bill_payment_number" id="bill_payment_number"><?php echo $this->Lib->formatPrice($this->Session->read('data.data_totalPrice')); ?></div>
						<?php else: ?>
						<div class="bill_payment_number" id="bill_payment_number">0 VNĐ</div>

						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="customer_money">
					<div class="customer_money_text">Tiền khách đưa</div>
					<div class="d-flex">
						<input type="text" value="" id="customer_money">
						<div style="margin: 0 10px; margin-top: 5px; cursor: pointer;" title="Xóa" onclick="deleteMoney()"><i class="fas fa-times" style="background-color: black; color: red; font-size: 20px; width: 20px; height: 20px;"></i></div>
						<span class="btn btn-sm btn-danger" style="cursor: pointer" onclick="onCustomerMoney()">Submit</span>
					</div>

				</div>
				<div class="customer_money">
					<div class="customer_money_text">Tiền khách phải thanh toán</div>
					<?php if($this->Session->read('data.data_products')) :  ?>
						<div class="customer_money_number" id="customer_money_number"><?php echo $this->Lib->formatPrice($this->Session->read('data.data_totalPrice')); ?></div>
					<?php else: ?>
						<div class="customer_money_number" id="customer_money_number">0 VND</div>

					<?php endif; ?>

				</div>
				<div class="customer_money">
					<div class="customer_money_text">Trả lại khách</div>
					<div class="customer_money_number" id="refund_customer">0 VND</div>
				</div>
				<div class="bill_action">
					<span class="btn btn-danger" style="cursor: pointer;" onclick="destroyBill()">HỦY HÓA ĐƠN</span>
					<?php echo $this->HTML->link('HOÀN THÀNH',
							array('controller' => 'bills', 'action' => 'index', '?xuat_excel=1'),
							array('class' => 'btn btn-success')) ?>
				</div>
			</div>

		</div>
	</div>

</div>
<!--	JQUERY-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>-->
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$('#bill_customer_form').submit(function (e){
			e.preventDefault();
			var phone_number = $('#phone_number').val();
			$.ajax({
				url: '/training_cake/payment/users/getCustomer/' + phone_number,
				type : "GET",
				dataType : 'json',
				success:function (data){
					if (data.data_toastr.type == 'success'){
						toastr.success(data.data_toastr.message);
						$('#phone_number').val(data.user_text);
					}else{
						toastr.error(data.data_toastr.message);
					}

				}
			});
		})
		$('#bill_barcode_form').submit(function (e){
			e.preventDefault();
			var barcode = $('#product_barcode').val();
			if(barcode){
				var product_qty = parseInt($('#product_qty').val());
				console.log(product_qty);
				$.ajax({
					url : '/training_cake/payment/products/getProduct/' + barcode + '/' + product_qty,
					type : 'GET',
					dataType: 'json',
					success:function (data){
						console.log(data);
						if(data.data_toastr.type == 'success'){
							$('#bill_product_table').empty();
							toastr.success(data.data_toastr.message);
							$.each(data.data_products, function (key, item){
								$('#bill_product_table').append('<tr id="row_'+ key + '">'+
									'<td>'+ item.barcode +'</td>' +
									'<td>'+ item.product_name +'</td>' +
									'<td><input type="number" min="1" value="'+ item.product_qty +'" id="number_'+ key + '" onchange="onChangeQty(this.id)" class="bill_product_table_input"></td>' +
									'<td id="product_price_'+ key + '">'+String(item.product_price).replace(/(.)(?=(\d{3})+$)/g,"$1,") +' VND</td>' +
									'<td id="single_price_'+ key + '">'+String(item.product_price * item.product_qty).replace(/(.)(?=(\d{3})+$)/g,"$1,") +' VND</td>' +
									'<td><span class="btn btn-sm btn-danger" style="cursor: pointer" id="delete_'+ key + '" onclick="onDeleteProduct(this.id)">Xóa</span></td>' +
								"</tr>");
							});

							$('#bill_payment_number').html(String(data.data_totalPrice).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
							$('#customer_money_number').html(String(data.data_totalPrice).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");

						}else{
							toastr.error(data.data_toastr.message);
						}
						// $('#product_barcode').val('');
						// $('#product_qty').val(1);
					}
				})
			}else{
				toastr.error('Vui lòng nhập mã sản phẩm!');
			}

		})
	});
	function deleteCustomer(){
		$('#phone_number').val('');
		$.ajax({
			url: '/training_cake/payment/bills/deleteCustomer',
			type: 'GET',
			dataType: 'json',
			success:function (data){
				toastr.success(data.message);
			}
		})
	}
	function deleteBarcode(){
		$('#product_barcode').val('');
		$('#product_qty').val(1);
	}
	function onChangeQty(id){
		var product_key = parseInt(id.substr(7));
		var product_qty = parseInt($('#'+id).val());
		if(!product_qty){
			product_qty = 1;
			$('#'+id).val(1);
		}
		$.ajax({
			url: '/training_cake/payment/bills/changeQty/' + product_key + '/' + product_qty,
			type: 'GET',
			dataType: 'json',
			success:function (data){
				$('#single_price_'+product_key).html(String(parseInt(data.single_price_new)).replace(/(.)(?=(\d{3})+$)/g,"$1,") + " VNĐ");
				$('#bill_payment_number').html(String(data.data_totalPrice_new).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
				$('#customer_money_number').html(String(data.data_totalPrice_new).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
			}
		})
	}
	function onDeleteProduct(id){
		var product_key = parseInt(id.substr(7));
		// $('#row_' + product_key).remove();
		$.ajax({
			url: '/training_cake/payment/bills/deleteProduct/' + product_key,
			type: 'GET',
			dataType: 'json',
			success:function (data){
				$('#bill_payment_number').html(String(data.data_totalPrice_new).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
				$('#customer_money_number').html(String(data.data_totalPrice_new).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
				$('#row_' + product_key).remove();
			}
		})
	}
	function deleteMoney(){
		$('#customer_money').val('');
	}
	function onCustomerMoney(){
		var customer_money = parseInt($('#customer_money').val());
		if(customer_money){
			$('#customer_money').val(String(customer_money).replace(/(.)(?=(\d{3})+$)/g,'$1,'));
		}

		$.ajax({
			url: '/training_cake/payment/bills/moneyCustomer/' + customer_money,
			type: 'GET',
			dataType: 'json',
			success:function (data){
				$('#customer_money_number').html(String(data.data_totalPrice_old).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
				$('#refund_customer').html(String(data.refund_pay).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
			}
		})
	}
	function destroyBill(){
		$('#bill_product_table').html('');
		$('#phone_number').val('');
		$('#product_barcode').val('');
		$('#product_qty').val(1);
		$('#customer_money').val('');
		$('#bill_payment_number').html(String(0).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
		$('#customer_money_number').html(String(0).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
		$('#refund_customer').html(String(0).replace(/(.)(?=(\d{3})+$)/g,'$1,') + " VNĐ");
		$.ajax({
			url: '/training_cake/payment/bills/destroyBill',
			type: 'GET',
			dataType: 'json',
			success:function (data){
				console.log(data);
				if(data.type == 'success'){
					toastr.success(data.message);
				}
			}
		})
	}
</script>
