<?php
class DoorController extends Controller
{
    public $layout = 'simple';
    public $api = array( 'open' );
    
    public function accessRules()
	{
		return array(
			array( 'allow', 'users' => array( '*' ) )
		);
	}

	public function filters()
	{
		return array( 'accessControl' );
	}
    
    public function actionOpen ( $phoneUDID )
    {
    	$user = User::model()->findByUDID( $phoneUDID );

    	if ( !$user ) 			  $this->fail( ErrorCode::NOT_REGISTERED );
    	if ( $user->isGuest() )   $this->failToOpen( ErrorCode::REVIEWING );
    	if ( $user->isExpired() ) $this->failToOpen( ErrorCode::EXPIRED );

    	
    	Door::open( $user->username );
    	
    	$this->success( array( 'status' => 'ok' ) );
    }
    
 	private function failToOpen ( $status )
 	{
 		$this->success(array(
 			'status' => 'fail',
 			'reason' => Yii::t( 'error', $status )
 		));
 	}
}