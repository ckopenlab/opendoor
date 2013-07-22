<?php
require_once 'api.php';

$user = Sqlite::findOne('select * from tbl_user where udid=?', $_GET[ 'phoneUDID' ] );

//新用户
if ( !$user ) {
	status( 'new' );
}
//等待审核
else if ( $user[ 'level' ] == 'guest' ) {
	status( 'review' );
}
//已经过期
else if ( $user[ 'expire' ] < time() ) {
	status( 'expired' );
}
//正常
else {
	status( 'normal' );
}

function status ( $status )
{
	$door = Sqlite::findOne('select * from tbl_door');
	success( array(
		'status' => $status,
		'notice' => $door[ 'opened_by' ] ? $door[ 'opened_by' ] . interval( $door[ 'opened_at' ] ) . '打开了门' : ''   
	) );   	
}

function interval ( $time )
{
    $interval = time() - $time;
    
    if ( $interval < 60 )      return '刚刚';
    if ( $interval < 3600 )    return floor( $interval / 60 ) . '分钟前';
    if ( $interval < 86400 )   return floor( $interval / 3600 ) . '小时前';
    if ( $interval < 2592000 ) return floor( $interval / 86400 ) . '天前';
    return '曾经';
}
