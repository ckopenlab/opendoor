<?php
	$this->widget( 'Buttons', array(
		'options' => array( 'class' => 'full' ),
		'buttons' => array(
			array( 'title' => '审核新用户', 'url' => '/user/review', 'badge' => $guestCount ),
			array( 'title' => '用户管理', 'url' => '/user/list', 'badge' => $userCount, 'class' => 'old full' ),
			array( 'title' => '修改密码', 'class' => 'disabled full' ),
			array( 'title' => '退出登录', 'highlight' => true, 'url' => '/site/logout' )
		)
	) );
?>
