<?php
	$this->PhpExcel->loadWorksheet(WWW_ROOT.'export_excel/product.xlsx');
	$this->PhpExcel->setRow(5);

	$stt = 1;

	foreach ($products as $product){
		$this->PhpExcel->addTableRow(array(
			$stt,
			$product['Product']['id'],
			$product['Product']['product_name'],
			$product['Product']['product_price'],
			$product['Product']['number'],
			$product['Product']['sold'],
			$product['Product']['barcode'],
			$product['Product']['discount'],
			$product['Product']['status'],
			$product['Product']['created'],
			$product['Product']['modified'],
		));
		$stt++;
	}
	$this->PhpExcel->output('Danh-sach-san-pham.xlsx');
?>
