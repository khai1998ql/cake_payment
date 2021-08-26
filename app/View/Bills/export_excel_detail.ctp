<?php
	$this->PhpExcel->loadWorksheet(WWW_ROOT.'export_excel/bill_detail.xlsx');
	$this->PhpExcel->setDefaultFont('Time New Roman', 12);

$this->PhpExcel->getActiveSheet()->setCellValue(
	'A1', 'Mã đơn hàng #' . $detail['Bill']['id']);
$this->PhpExcel->getActiveSheet()->setCellValue(
	'A2', 'Tên khách hàng : ' . $detail['User']['full_name']);
$this->PhpExcel->getActiveSheet()->setCellValue(
	'A3', 'Số điện thoại khách hàng : ' . $detail['User']['phone_number']);
$this->PhpExcel->getActiveSheet()->setCellValue(
	'A4', 'Ghi chú : ' . $detail['Bill']['note']);
$this->PhpExcel->getActiveSheet()->setCellValue(
	'A5', 'Thời gian đặt hàng : ' . $detail['Bill']['created']);
$this->PhpExcel->getActiveSheet()->setCellValue(
	'A5', 'Cập nhật lần cuối : ' . $detail['Bill']['modified']);

$this->PhpExcel->setRow(8);
// TẠO BẢNG


$table = array(
	array('label' => __('STT'), 'width' => 5, 'filter' => true),
	array('label' => __('Mã sản phẩm'), 'width' => 13, 'filter' => true),
	array('label' => __('Tên sản phẩm'), 'width' => 20, 'wrap' => true, 'filter' => true),
	array('label' => __('Giá sản phẩm'), 'width' => 15, 'filter' => true, 'horizontal' => 'center'),
	array('label' => __('Số lượng'), 'width' => 10, 'filter' => true),
	array('label' => __('Thành tiền'), 'width' => 10, 'filter' => true)
);

$this->PhpExcel->addTableHeader($table, array('bold' => true));

$i = 1;
foreach ($detail['Detail'] as $item) {
	$this->PhpExcel->addTableRow(array(
		$i,
		$item['product']['barcode'],
		$item['product']['product_name'],
		intval($item['product']['product_price']),
		intval($item['number']),
		intval($item['single_price'])
	));
	$i++;
}

// TÍNH TỔNG



// THIẾT LẬP CÁC CÔNG THỨC TÍNH

$next2Row = $this->PhpExcel->getRow() + 9 + $i;

// set label for total
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)$next2Row, 'Tổng');
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 1), 'Tổng tạm tính');
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 2), 'Giảm giá');
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 3), 'Tổng tiền');

$subTotalFrom = $this->PhpExcel->_tableParams['header_row'] + 1;
$subTotalTo = $next2Row - 2;
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 4), $subTotalFrom);
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 5), $subTotalTo);
$this->PhpExcel->getActiveSheet()->setCellValue('D'. (string)($next2Row + 6), $next2Row);


$this->PhpExcel->getActiveSheet()->setCellValue('E'.(string)($next2Row),
	'=SUM(E' . (string)($subTotalFrom) . ':E' . (string)($subTotalTo) .')');

$this->PhpExcel->output('Chi-tiet-don-hang.xlsx');

