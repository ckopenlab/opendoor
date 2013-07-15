<?php
session_start();
if ( !isset( $_SESSION[ 'open_dice' ] ) || $_SESSION[ 'open_dice' ] >= 2 ) {
	$_SESSION[ 'open_dice' ] = 1;	
} else {
	$_SESSION[ 'open_dice' ]++;
}

switch ( $_SESSION[ 'open_dice' ] ) {
	case 1 : printData( array( 'status' => 'ok ') ); break;
	case 2 : printData( array( 'status' => 'fail', 'reason' => '您开门太频繁了' )  ); break;
}


function printData ( $data ) {
	echo json_encode(array(
		'state' => 1,
		'result' => $data
	));
}