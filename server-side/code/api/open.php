<?php
require_once 'api.php';

$user = Sqlite::findOne('select username,level,expire from tbl_user where udid=?', $_GET[ 'phoneUDID' ] );

//未注册不能开门
if ( !$user ) { 			  
	fail( '2001', '您还没有注册呢！' );	
}
//未通过审核不能开门
else if ( $user[ 'level' ] == 'guest' ) {
	success(array( 'status' => 'fail', 'reason' => '您的审核还没通过呢！' ));
}  
//授权过期不能开门
else if ( $user[ 'expire' ] < time() ) {
	success(array( 'status' => 'fail', 'reason' => '您的授权已过期，请联系管理员！' ));	
}
//权限正常，可以开门
else {
	$door = Sqlite::findOne( 'select opened_at from tbl_door' );
    if ( abs( time() - (int) $door[ 'opened_at' ] ) > OPEN_INTERVAL  ) {
        Sqlite::exec( 'update tbl_door set opened_by=?,opened_at=? ', array( $user[ 'username' ], time() ) );
        system( 'gpio mode ' . GPIO_PIN . ' out' );
        system( 'gpio write ' . GPIO_PIN . ' 0' );
        system( 'sleep ' . OPEN_DELAY );
        system( 'gpio write ' . GPIO_PIN . ' 1' );
    }
    success( array( 'status' => 'ok' ) );
}

