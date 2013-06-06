<?php
trait ActiveTable 
{
	public static $tableName = __CLASS__;
	
	public static function model ( $tableName = null )
	{
		return parent::model( static::$tableName );
	}
	
	public function tableName()
	{
		return '{{' . strtolower( static::$tableName ) . '}}';
	}
	
	public function findById ( $id )
	{
		return self::model()->findByPk( $id );
	}
		
	public function findByIds( $ids )
	{
		$criteria = new CDbCriteria();
		$criteria->addInCondition( 'id', unserialize( $ids ) );
		return self::model()->findAll( $criteria );
	}
	
	public function updateById ( $id, $attributes, $condition = '', $params = array() )
	{
		return self::model()->updateByPk( $id, $attributes, $condition, $params );
	}
	
}