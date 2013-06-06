<?php
class Door extends CActiveRecord
{
    const ID = 1;         //默认门ID
    const PIN = 7;        //GPIO输出针脚
    const HIGH = 1;       //高电平
    const LOW = 0;        //低电平
    const DELAY = 0;      //每次改变持续的时间
    const INTERVAL = 3;   //连续两次开门之间间隔的时间
    
    use ActiveTable;
    
    public function create ( $data )
	{
		$record = new User;
		$record->level = self::DEFAULT_LEVEL;
		$record->token = $data[ 'token' ];
		$record->time = time();
		$record->setPassword( self::DEFAULT_PASSWORD );
		return $record->save();
	}
    
    public static function open ( $id = self::ID )
    {
        $door = self::model()->findById( $id );
        if ( time() > $door->opened_at + self::INTERVAL  ) {
            $door->opened_at = time();
            $door->save();
            system( 'gpio mode ' . self::PIN . ' out' );
            system( 'gpio write ' . self::PIN . ' ' . self::LOW );
            system( 'sleep ' . self::DELAY );
            system( 'gpio write ' . self::PIN . ' ' . self::HIGH );
        }
    }
}