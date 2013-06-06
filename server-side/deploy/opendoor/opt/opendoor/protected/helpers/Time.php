<?php
class Time
{
	const DEFAULT_FORMAT = "Y年n月j日 G:i";
	
	const SECONDS_PER_MINUTE = 60;
	const SECONDS_PER_HOUR = 3600;
	const SECONDS_PER_DAY = 86400;
	const SECONDS_PER_WEEK = 604800;
	const SECONDS_PER_MONTH = 2592000;
	const SECONDS_PER_YEAR = 31536000;
	
	const MINUTES_PER_HOUR = 60;
	const MINUTES_PER_DAY = 1440;
	const MINUTES_PER_WEEK = 10080;
	const MINUTES_PER_MONTH = 43200;
	const MINTUES_PER_YEAR = 525600;
	
	const HOURS_PER_DAY = 24;
	const HOURS_PER_WEEK = 168;
	const HOURS_PER_MONTH = 720;
	const HOURS_PER_YEAR = 8760;
	
	const DAYS_PER_WEEK = 7;
	const DAYS_PER_MONTH = 30;
	const DAYS_PER_YEAR = 365;
	
	const WEEKS_PER_MONTH = 4;
	const WEEKS_PER_YEAR = 52;
	
	const MONTHS_PER_YEAR = 12;
	
	public static function render ( $time, $format = self::DEFAULT_FORMAT )
	{
		echo date( $format, $time );	
	}

	public static function interval ( $time )
	{
	    $now = time();
	    
	    if ( $time > $now ) {
	        list( $now, $time ) = array( $time, $now );
	        $direction =  '后';
	    } else {
	        $direction = '前';
	    }
	    
		$min_dis = floor( ( $now - $time ) / self::SECONDS_PER_MINUTE );
		$hor_dis = floor( ( $now - $time ) / self::SECONDS_PER_HOUR );
		$day_dis = floor( ( $now - $time ) / self::SECONDS_PER_DAY );
		$wek_dis = floor( ( $now - $time ) / self::SECONDS_PER_DAY / self::DAYS_PER_WEEK );
		$mon_dis = ( date( "Y", $now ) * 12 + date( "m", $now ) ) - ( date( "Y" , $time ) * 12 + date( "m", $time ) );
		if ( $day_dis < date( "t", $now ) ) $mon_dis = 0;
		$yer_dis = date( "Y", $now ) - date( "Y", $time );
		$this_year_days = self::DAYS_PER_YEAR;
		if ( date( "L", $now ) ) $this_year_days++; 
		if ( $day_dis < $this_year_days ) $yer_dis = 0;
		
		if ( $yer_dis ) return $yer_dis . '年' . $direction;
        if ( $mon_dis ) return $mon_dis . '个月' . $direction;
        if ( $wek_dis ) return $wek_dis . '周' . $direction;
        if ( $day_dis ) return $day_dis . '天' . $direction;
        if ( $hor_dis ) return $hor_dis . '小时' . $direction;
        if ( $min_dis ) return $min_dis . '分钟' . $direction;
		
		return "刚刚";
	}	
	
	private static function renderInterval ( $dis, $unit, $direction )
	{
	    return $dis . $unit . ( $direction ? '后' : '前' );
	} 
}