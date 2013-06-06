<?php
class User extends CActiveRecord
{
    const DEFAULT_LEVEL = 'guest';
    const DEFAULT_PASSWORD = 'openlab';
    
    use ActiveTable;
    
    private static $levelNameMap = array(
		'guest' => '游客',
		'user' => '普通用户',
		'admin' => '管理员',
	);
    

    public function create ( $data )
	{
		$record = new User;
		$record->level = self::DEFAULT_LEVEL;
		$record->token = $data[ 'token' ];
		$record->time = time();
		$record->setPassword( self::DEFAULT_PASSWORD );
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
	
	public static function checkToken ( $token )
    {
        return (boolean) User::model()->findAll(array(
			'condition'	=> 'token=:token and expire>:expire',
			'params'	=> array( ':token' => $token, ':expire' => time() ),
		));
    }

	public static function getLevels()
	{
		return self::$levelNameMap;
	}

	public function getLevelName()
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
}