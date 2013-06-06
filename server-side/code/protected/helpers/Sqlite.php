<?php
class Sqlite
{
    public static $db;
    
	public static function db()
	{
		if ( !isset( self::$db ) ) {
		    self::$db = new PDO( 'sqlite:' . DB_PATH );
		}
		return self::$db;
	}
	
	public static function findAll ( $query, $params = array() )
	{
	    return self::db()->query( self::buildQuery( $query, $params ) )->fetchAll( PDO::FETCH_ASSOC );
	}
	
	public static function findOne ( $query, $params = array() )
	{
	    return self::db()->query( self::buildQuery( $query, $params ) )->fetch( PDO::FETCH_ASSOC );
	}
	
	public static function exec ( $query, $params = array() )
	{
	    return self::db()->exec( self::buildQuery( $query, $params ) );
	}
	
	public static function buildQuery ( $query, $params = array() )
	{
	    if ( !is_array( $params ) ) $params = array( $params );
	    foreach ( $params as $param ) {
	        $query = preg_replace( '/\?/', self::db()->quote( $param ), $query, 1 );
	    }
	    return $query;
	}
}