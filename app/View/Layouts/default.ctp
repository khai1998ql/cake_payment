<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
//		echo $this->Html->meta('icon');

	//		echo $this->Html->css('cake.generic');
			echo $this->Html->css('app');
//
//		echo $this->fetch('meta');
//		echo $this->fetch('css');
//		echo $this->fetch('script');
	?>
<!--	// Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--	// font awesome-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!--	Tao thong bao-->
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>
<body>
	<div id="container">
		<div id="header">
			<?php
				if(AuthComponent::user() && AuthComponent::user('role') == 2) : ?>
			<nav class="navbar navbar-expand-lg navbar-dark  bg-dark">
				<?php echo $this->HTML->link('Trang chủ', array('controller' => 'staffs', 'action' => 'index'), array('class' => 'navbar-brand')) ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
<!--							<a class="nav-link" href="#">Bán hàng <span class="sr-only">(current)</span></a>-->
							<?php echo $this->HTML->link('Bán hàng', array('controller' => 'bills', 'action' => 'index'), array('class' => 'nav-link')) ?>
						</li>
						<li class="nav-item active">
							<?php echo $this->HTML->link('Quán lý sản phẩm', array('controller' => 'products', 'action' => 'index'), array('class' => 'nav-link')) ?>
<!--							<a class="nav-link" href="/">Quán lý sản phẩm <span class="sr-only">(current)</span></a>-->
						</li>
						<li class="nav-item active">
							<?php echo $this->HTML->link('Quản lý đơn hàng', array('controller' => 'bills', 'action' => 'view'), array('class' => 'nav-link')) ?>

						</li>
					</ul>
					<div class="form-inline my-2 my-lg-0">

						<?php
							if(AuthComponent::user()){
								echo '<span style="font-size: 16px; color: white; margin-right: 20px;">Xin chào:<strong style="color: red;">' . AuthComponent::user("full_name") . '</strong></span>';
								echo $this->HTML->link('Thoát', array('controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-sm btn-danger'));
							}
						?>

					</div>
				</div>
			</nav>
			<?php endif; ?>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
<!--			--><?php //echo $this->Html->link(
//					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
//					'https://cakephp.org/',
//					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
//				);
//			?>
<!--			<p>-->
<!--				--><?php //echo $cakeVersion; ?>
<!--			</p>-->
		</div>
	</div>
<!--	--><?php //echo $this->element('sql_dump'); ?>

<!--	// Bootstrap-->
	<!--	JQUERY-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
	<!--		TOASTR-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!--	// font awesome-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


</body>
</html>
