<?php
class User extends CActiveRecord
{
    const DEFAULT_LEVEL = 'guest';
    const DEFAULT_PASSWORD = 'openlab';
    const NICKNAME_LENGTH_MAX = 30;
    const NICKNAME_LENGTH_MIN = 2;
    
    use ActiveTable;
    
    private static $levelNameMap = array(
		'guest' => '游客',
		'user' => '普通用户',
		'admin' => '管理员',
	);
    
	public function findByUDID ( $udid )
	{
		return User::model()->find(array(
			'condition' => 'udid=:udid',
			'params'    => array( ':udid' => $udid )
		));
	}
	
	public function findByName ( $name )
	{
		return User::model()->find(array(
			'condition' => 'username=:name',
			'params'    => array( ':name' => $name )
		));
	}

    public function create ( $data )
	{
		$record = new User;
		$record->level = self::DEFAULT_LEVEL;
		$record->time = time();
		$record->setPassword( self::DEFAULT_PASSWORD );
		foreach ( $data as $key => $value ) {
			$record->$key = $value;
		}
		return $record->save();
	}
    
	public function setPassword ( $password )
	{
		$this->salt = md5( time() );
		$this->password = md5( $password . $this->salt );
	} 
	
	public function checkPassword ( $password )
	{
		return $this->password == md5( $password . $this->salt );
	}

	public static function getLevels()
	{
		return self::$levelNameMap;
	}

	public static function getLevelName()
	{
		return self::$levelNameMap[ $this->level ];
	}
    
    public function isExpired()
    {
        return $this->expire < time();
    }
    
    public function isGuest()
    {
        return $this->level == 'guest';
    }

    public static function isValidName ( $name )
    {
    	if ( !preg_match( "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]+$/u", $name ) ) return false;
		//检查昵称长度是否合法
		if ( mb_strlen( $name, 'utf-8' ) > self::NICKNAME_LENGTH_MAX ||
			 mb_strlen( $name, 'utf-8' ) < self::NICKNAME_LENGTH_MIN ) return false;
	    //昵称合法
	    return true; 
    } 
    
    /* to be removed */
	public static function checkToken ( $token )
    {
        return (boolean) User::model()->findAll(array(
			'condition'	=> 'token=:token and expire>:expire',
			'params'	=> array( ':token' => $token, ':expire' => time() ),
		));
    }
}