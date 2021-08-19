<?php
if(AuthComponent::user()){
	echo '<span style="font-size: 16px; color: white; margin-right: 20px;">Xin chào:<strong style="color: red;">' . AuthComponent::user("full_name") . '</strong></span>';
	echo $this->HTML->link('Thoát', array('controller' => 'users', 'action' => 'logout'), array('class' => 'btn btn-sm btn-danger'));
}
