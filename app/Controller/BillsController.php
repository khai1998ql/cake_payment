<?php
	class BillsController extends AppController
	{
		public $components = array('Session');
		public $helpers = array('PhpExcel', 'Lib');
		public function index(){

		}
		public function deleteCustomer(){
			$this->layout = null;
			if($this->Session->read('data.data_customer')){
				$this->Session->delete('data.data_customer');
			}
			$data = array(
				'type' => 'success',
				'message' => 'Xóa khách hàng thành công!'
			);
			$this->set('data', $data);
		}

	}
?>
