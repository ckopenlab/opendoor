<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=640px, target-densitydpi=260;"/>
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" type="text/css" href="/css/app.css?v=1.1" />
</head>
<body>
<?php
error_reporting( E_ALL & ~E_NOTICE );
require_once 'protected/config/define.php';
require_once 'protected/helpers/Sqlite.php';

$token = $_GET[ 'token' ];

$user = Sqlite::findOne('select * from tbl_user where token=?', $token );

//如token未记录则为访客，跳转到欢迎页面
if ( !$user ){
    $salt = md5( time() );
    $pass = md5( 'openlab' . $salt );
    Sqlite::exec(
    	'insert into tbl_user (level, username, password, salt, token, time, expire) values (?,?,?,?,?,?,?)',
        array( 'guest', null, $pass, $salt, $token, time(), null )
    );
    $status = 'reviewing';
}
//未通过审核，不能开门 
else if ( $user[ 'level' ] == 'guest' ) {
    $status = 'reviewing';
}
//token已过期，不能开门
else if ( $user[ 'expire' ] < time() ) {
    $status = 'expired';
}
//权限正常，可以开门
else {
    $door = Sqlite::findOne( 'select * from tbl_door' );
    if ( abs( time() - (int) $door[ 'opened_at' ] ) > OPEN_INTERVAL  ) {
        Sqlite::exec( 'update tbl_door set opened_at=?', time() );
        system( 'gpio mode ' . GPIO_PIN . ' out' );
        system( 'gpio write ' . GPIO_PIN . ' 0' );
        system( 'sleep ' . OPEN_DELAY );
        system( 'gpio write ' . GPIO_PIN . ' 1' );
    }
    $status = 'opened';
}

$statusMap = array(
    'opened'    => '门已经打开了',
    'reviewing' => '正在等待管理员审核..',
    'expired'   => '授权过期，请联系管理员'
);
?>
<div id="door" class="<?php echo $status ?>">
	<span><?= $statusMap[ $status ]?></span>
</div>
</body>
</html>