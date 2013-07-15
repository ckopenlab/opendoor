<?php
session_start();
if ( !isset( $_SESSION[ 'status_dice' ] ) || $_SESSION[ 'status_dice' ] >= 5 ) {
	$_SESSION[ 'status_dice' ] = 1;	
} else {
	$_SESSION[ 'status_dice' ]++;
}

switch ( $_SESSION[ 'status_dice' ] ) {
	case 1 : printStatus( 'new'     ); break;
	case 2 : printStatus( 'review'  ); break;
	case 3 : printStatus( 'normal'  ); break;
	case 4 : printStatus( 'expired' ); break;
	case 5 : error()                 ; break;
}


function printStatus ( $status ) {
	echo json_encode(array(
		'state' => 1,
		'result' => array(
			'status' => $status,
			'notice' => '刘国维刚刚开了门'
		)
	));
}

function error ( ) {
	echo json_encode(array(
		'state' => '1000',
		'message' => '服务器未知错误'
	));
}