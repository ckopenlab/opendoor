<?php
error_reporting( E_ALL & ~E_NOTICE );
require_once dirname(__FILE__).'/../protected/config/define.php';
require_once dirname(__FILE__).'/../protected/helpers/Sqlite.php';

foreach ( array( 'phoneUDID', 'phoneModel', 'softVersion' ) as $name ) {
	if ( !isset( $_GET[ $name ] ) ) fail( '1003', '非法的请求' );
}		
	
function get ( $names = array() )
{
	$params = array();
	foreach ( $names as $name ) {
		if ( !isset( $_GET[ $name ] ) ) fail( '1001', '缺少参数 ' . $name );
		array_push( $params, $_GET[ $name ] );
	}	
	return $params;
}

function success ( $result = array() )
{
    $json = array( 'state' => '1' );
    if ( $result ) {
        $json[ 'result' ] = $result;
    }
    echo json_encode( $json );
    exit();
}
	
function fail ( $code = 0, $message = 'failed' )
{
	echo json_encode( array(
    	'state'   => $code,
        'message' => $message
    ) );
    exit();
}