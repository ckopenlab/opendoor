<?php
class Door extends CActiveRecord
{
    const ID = 1;         //默认门ID
    const HIGH = 1;       //高电平
    const LOW = 0;        //低电平
    
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
        if ( abs( time() - (int) $door[ 'opened_at' ] ) > OPEN_INTERVAL  ) {
            $door->opened_at = time();
            $door->save();
            system( 'gpio mode ' . GPIO_PIN . ' out' );
            system( 'gpio write ' . GPIO_PIN . ' ' . self::LOW );
            system( 'sleep ' . OPEN_DELAY );
            system( 'gpio write ' . GPIO_PIN . ' ' . self::HIGH );
        }
    }
}