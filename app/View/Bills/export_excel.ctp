<?php
$time = time();
$day = date('d-m-Y m:h', $time);
$this->PhpExcel->loadWorksheet(WWW_ROOT.'export_excel/payment.xlsx');
$this->PhpExcel->setRow(3);
$this->PhpExcel->addTableRow(array(
	'Ngày bán: ' . $day,
	'Quầy bán: 123ABC',
));

$this->PhpExcel->setRow(5);
$count = 1;

foreach ($data['data_products'] as $product){
	$this->PhpExcel->addTableRow(array(
		$product['product_name'],
		$this->Lib->formatPriceNot($product['product_price']),
		$product['product_qty'],
		$this->Lib->formatPriceNot($product['single_price']),
	));
	$count++;
}
$this->PhpExcel->setRow(intval(5+$count));
$this->PhpExcel->addTableRow(array(
	'Tổng tiền thanh toán: ',
	'',
	'',
	$this->Lib->formatPriceNot($data['data_totalPrice']),
));
$this->PhpExcel->addTableRow(array(
	'Tiền khách trả: ',
	'',
	'',
	$this->Lib->formatPriceNot($data['payment']['customer_pay']),
));
$this->PhpExcel->addTableRow(array(
	'Tổng tiền thanh toán: ',
	'',
	'',
	$this->Lib->formatPriceNot($data['payment']['refund_pay']),
));
$this->PhpExcel->output('Xuat_hoa_don.xlsx');

?>
