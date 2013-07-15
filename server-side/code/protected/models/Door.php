<?php
class Door extends CActiveRecord
{
	const SOMEONE = '某人'; //默认文案
    const ID = 1;          //默认门ID
    const HIGH = 1;        //高电平
    const LOW = 0;         //低电平
    
    use ActiveTable;
    
    public static function open ( $name = self::SOMEONE, $id = self::ID )
    {
        $door = self::model()->findById( $id );
        if ( abs( time() - (int) $door[ 'opened_at' ] ) > OPEN_INTERVAL  ) {
        	$door->opened_by = $name; 
            $door->opened_at = time();
            $door->save();
            system( 'gpio mode ' . GPIO_PIN . ' out' );
            system( 'gpio write ' . GPIO_PIN . ' ' . self::LOW );
            system( 'sleep ' . OPEN_DELAY );
            system( 'gpio write ' . GPIO_PIN . ' ' . self::HIGH );
        }
    }
    
    public static function log ( $id = self::ID )
    {
    	$door = self::model()->findById( $id );
    	return !$door->opened_by ? '' : Yii::t( 'door', 'notice', array(
			'person' => $door->opened_by,
    		'time' => Time::interval( $door->opened_at )
    	) );
    }
}