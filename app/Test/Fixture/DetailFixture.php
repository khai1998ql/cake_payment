<?php
/**
 * Detail Fixture
 */
class DetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'bill_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'discount' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'single_price' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'bill_id' => 1,
			'product_id' => 1,
			'number' => 1,
			'discount' => 1,
			'single_price' => 1,
			'created' => '2021-08-20 10:06:27',
			'modified' => '2021-08-20 10:06:27'
		),
	);

}
