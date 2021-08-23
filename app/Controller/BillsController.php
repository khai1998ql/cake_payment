<?php
	class BillsController extends AppController
	{
		public $components = array('Session');
		public $helpers = array('PhpExcel', 'Lib');
		public function index(){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				$data = $this->Session->read('data');
//				debug($data);die;
				if(isset($this->request->query['xuat_excel']) && $this->request->query['xuat_excel']){
					$this->Session->delete('data');
					if(isset($data['data_products']) && isset($data['data_totalPrice']) && isset($data['payment']) && isset($data['data_customer'])){
//						$this->Session->delete('data');
						// Lưu bill và bill detail
						$this->Bill->create();
						$data_bill = array(
							'user_id' => intval($data['data_customer']['user']['id']),
							'subtotal' => intval($data['data_totalPrice']),
							'total_discount' => 0,
							'total_bill' => (intval($data['data_totalPrice']) - 0),
							'note' => ''
						);
						$this->Bill->save($data_bill);
						$select_id = $this->Bill->query("SELECT id FROM `bills` WHERE 1 ORDER BY id DESC LIMIT 1");
						$last_id = intval($select_id[0]['bills']['id']);
						foreach ($data['data_products'] as $detail){
							$data_detail = array(
								'bill_id' => $last_id,
								'product_id' => $detail['id'],
								'number' => $detail['product_qty'],
								'discount' => $detail['discount'],
								'single_price' => $detail['single_price'],
							);

							$this->Bill->Detail->create();
							$this->Bill->Detail->save($data_detail);
						}
						// Xứ lý xuất excel
						$this->set('data', $data);
						$this->layout = null;
						$this->render('export_excel');
					}else{
						$this->Session->setFlash('Thông tin không đầy đủ!!!');
						$this->redirect('index');
					}

				}

			}else{
				$this->redirect('/users/index');
			}
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
		public function changeQty($key, $value){
			$this->layout = null;
			$product_qty_new = intval($value);
			$product_qty_old = intval($this->Session->read('data.data_products.' . $key . '.product_qty'));
			$product_price = intval($this->Session->read('data.data_products.' . $key . '.product_price'));
			$data_totalPrice_old = intval($this->Session->read('data.data_totalPrice'));
			$sub_qty = $product_qty_new - $product_qty_old;
			$data_totalPrice_new = intval($data_totalPrice_old + $sub_qty * $product_price);
			$single_price_new = $product_price * $product_qty_new;

			$this->Session->write('data.data_products.' . $key . '.product_qty', $product_qty_new);
			$this->Session->write('data.data_products.' . $key . '.single_price', $single_price_new);
			$this->Session->write('data.data_totalPrice', $data_totalPrice_new);

			$data = array(
				'single_price_new' => $single_price_new,
				'data_totalPrice_new' => $data_totalPrice_new,
			);
			$this->set('data', $data);
		}
		public function deleteProduct($key){
			$this->layout = null;

			$single_price = $this->Session->read('data.data_products.' . $key . '.single_price');
			$data_totalPrice_old = intval($this->Session->read('data.data_totalPrice'));
			$data_totalPrice_new = intval($data_totalPrice_old - $single_price);

			$this->Session->write('data.data_totalPrice', $data_totalPrice_new);
			$this->Session->delete('data.data_products.' . $key);
			$data = array(
				'data_totalPrice_new' => $data_totalPrice_new,
			);
			$this->set('data', $data);

		}
		public function moneyCustomer($money){
			$this->layout = null;
			$money = intval($money);
			if($this->Session->read('data.data_totalPrice')){
				$data_totalPrice_old = intval($this->Session->read('data.data_totalPrice'));
			}else{
				$data_totalPrice_old = 0;
			}
//			debug($data_totalPrice_old);die;
			$sub_money = $money - $data_totalPrice_old;
			$data = array(
				'customer_pay' => $money,
				'data_totalPrice_old' => $data_totalPrice_old,
				'refund_pay' => $sub_money,
			);
			$this->Session->write('data.payment', $data);

			$this->set('data', $data);
		}
		public function destroyBill(){
			$this->layout = null;
			if($this->Session->read('data')){
				$this->Session->delete('data');
			}

			$data = array(
				'type' => 'success',
				'message' => 'Hủy hóa đơn thành công',
			);
			$this->set('data', $data);
		}
		public function view(){
			$bills = $this->Bill->find('all');
//			debug($bills);die;
			$this->set('bills', $bills);
		}
		public function detail($id){
			$detail = $this->Bill->findById($id);
			foreach ($detail['Detail'] as $key => $item){
				$product = $this->Bill->Detail->Product->query("SELECT * FROM `products` where id = " . $item['product_id']);
				$detail['Detail'][$key]['product'] = $product[0]['products'];
			}
			$this->set('detail', $detail);
		}
	}
?>
