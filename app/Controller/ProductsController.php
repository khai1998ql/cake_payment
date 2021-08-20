<?php
	class ProductsController extends AppController {
		public $components = array('Session');
		public $helpers = array('PhpExcel');
		public function index(){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				$data = $this->Product->find('all');
				$this->set('products', $data);
				if(isset($this->request->query['xuat_excel']) && $this->request->query['xuat_excel']){
					// Xứ lý xuất excel
					$this->layout = null;
					$this->render('export_excel');
				}
			}else{
				$this->redirect('/users/index');
			}

		}
		public function add(){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				if($this->request->is('post')){
					$this->Product->create();
					if($this->Product->save($this->request->data)){
						$this->Session->setFlash('Tạo mới sản phẩm thành công!');
						$this->redirect('index');
					}else{
						$this->Session->setFlash('Tạo mới sản phẩm thất bại!');
					}
				}
			}else{
				$this->redirect('/users/index');
			}

		}
		public function view($id){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				$data = $this->Product->findById($id);
				$this->set('product', $data);
			}else{
				$this->redirect('/users/index');
			}

		}
		public function edit($id){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				$data = $this->Product->findById($id);
				if($this->request->is(array('put','post'))){
					$this->Product->id =$id;
					if($this->Product->save($this->request->data)){
						$this->Session->setFlash('Sửa sản phẩm thành công!');
						$this->redirect('index');
					}else{
						$this->Session->setFlash('Sửa sản phẩm thất bại!');
					}
				}
				$this->request->data = $data;
			}else{
				$this->redirect('/users/index');
			}
		}
		public function delete($id){
			if(AuthComponent::user() && AuthComponent::user('role') == 2){
				$this->Product->id = $id;
				$data = $this->Product->findById($id);
				if($this->request->is(array('post', 'put'))){
					if($this->Product->delete()){
						$this->Session->setFlash('Xóa sản phẩm thành công');
						$this->redirect('index');
					}
				}else{
					$this->Session->setFlash('Sản phẩm không tồn tại');
					$this->redirect('index');
				}
			}else{
				$this->redirect('/users/index');
			}
		}
		public function getProduct($barcode, $number){
			$this->layout = null;
			$product = $this->Product->findByBarcode($barcode);
			$total_price = array();
			if(!empty($product)){
				if(!$this->Session->read('data.data_products')){
					$data_products[1] = array(
						'id' => $product['Product']['id'],
						'product_name' => $product['Product']['product_name'],
						'product_price' => intval($product['Product']['product_price']),
						'barcode' => $product['Product']['barcode'],
						'discount' => intval($product['Product']['discount']),
						'product_qty' => intval($number),
						'single_price' => intval($product['Product']['product_price']) * intval($number),
					);
				}else{
					$data_products = $this->Session->read('data.data_products');
					$count_qty = 0;
					$number_qty = intval($number);
					$check_barcode = false;
					$last_key = 0;
					foreach ($data_products as $key => $item){
						if($item['barcode'] == $barcode){
							$count_qty = $key;
							$number_qty += intval($item['product_qty']);
							$check_barcode = true;
						}
						$last_key = intval($key);
					}
					if($check_barcode){
						$data_products[$count_qty] = array(
							'id' => $product['Product']['id'],
							'product_name' => $product['Product']['product_name'],
							'product_price' => intval($product['Product']['product_price']),
							'barcode' => $product['Product']['barcode'],
							'discount' => intval($product['Product']['discount']),
							'product_qty' => $number_qty,
							'single_price' => intval($product['Product']['product_price']) * $number_qty,
						);
					}else{
						$data_products[$last_key + 1] = array(
							'id' => $product['Product']['id'],
							'product_name' => $product['Product']['product_name'],
							'product_price' => intval($product['Product']['product_price']),
							'barcode' => $product['Product']['barcode'],
							'discount' => intval($product['Product']['discount']),
							'product_qty' => intval($number),
							'single_price' => intval($product['Product']['product_price']) * intval($number),
						);
					}
				}
				$data_toastr = array(
					'type' => 'success',
					'message' => 'Thêm sản phẩm thành công!'
				);
				$total_price = 0;
				foreach ($data_products as $data_product) {
					$total_price += intval($data_product['single_price']);
				}
			}else{
				$data_toastr = array(
					'type' => 'error',
					'message' => 'Sản phẩm không tồn tại!'
				);
			}
			if($total_price){
				$data = array(
					'data_products' => $data_products,
					'data_toastr' => $data_toastr,
					'data_totalPrice' => $total_price,
				);
//				$this->Session->write('data', $data);
				$this->Session->write('data.data_products', $data_products);
				$this->Session->write('data.data_toastr', $data_toastr);
				$this->Session->write('data.data_totalPrice', $total_price);
			}else{
				$data = array(
					'data_toastr' => $data_toastr,
				);
				$this->Session->write('data.data_toastr', $data_toastr);
			}

//			debug($data);die;
//			$this->Session->delete('data');
//			$this->Session->write('data.data_products', $data_products);
//			debug($this->Session->read('data'));

			$this->set('data', $data);
		}
	}
