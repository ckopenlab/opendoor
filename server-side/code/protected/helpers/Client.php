<?php
class Client
{
    public static function getUserAgent()
	{
		return $_SERVER[ 'HTTP_USER_AGENT' ];
	}

	public static function isAndroid()
	{
		return preg_match( '/android/i', self::getUserAgent() );
	}
	
	public static function isIOS()
	{
		return preg_match( '/(iphone|ipod)/i', self::getUserAgent() );
	}
	
}