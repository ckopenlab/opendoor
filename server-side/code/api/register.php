<?php
require_once 'api.php';

list( $udid, $model, $name ) = get( array( 'phoneUDID', 'phoneModel', 'name' ) );
 
//只允许中英文数字下划线
if ( !preg_match( "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]+$/u", $name ) ) {
	fail( '1002', '非法的参数 name' );
}
//2~30位
else if ( mb_strlen( $name, 'utf-8' ) > 30 || mb_strlen( $name, 'utf-8' ) < 2 ) {
	fail( '1002', '非法的参数 name' );
}
//已经注册
else if ( Sqlite::findOne('select udid,username from tbl_user where udid=? or username=?', array( $udid, $name ) ) ) {
	fail( '2000', '您已经注册过了！' );
}
//可以注册
else {
	Sqlite::exec(
    	'insert into tbl_user (level, username, password, salt, udid, model, time, expire) values (?,?,?,?,?,?,?,?)',
        array( 'guest', $name, null, null, $udid, $model, time(), null )
    );
	success(array( 'status' => 'ok' ));
}