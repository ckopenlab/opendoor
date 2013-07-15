<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $params = array(
		'phoneUDID', 'phoneModel', 'softVersion'
	);
	
	/**
	 * 请求成功
	 * @param array $result
	 */
	public function success ( $result = array() )
	{
	    $json = array( 'state' => ErrorCode::SUCCESS );
	    if ( $result ) {
	        $json[ 'result' ] = $result;
	    }
	    echo json_encode( $json );
	    Yii::app()->end();
	}

	/**
	 * 请求失败
	 * @param string $code
	 * @param array $params
	 */
	public function fail ( $code = ErrorCode::UNKNOWN_ERROR, $params = array() )
	{
	    $this->error( array(
	        'code' => $code,
	        'message' => Yii::t( 'error', $code, $params )
	    ) );
	}

	/**
	 * 输出错误信息
	 * @param array $error
	 */
	public function error ( $error )
	{
	    echo json_encode( array(
	    	'state'   => $error[ 'code' ],
	        'message' => $error[ 'message' ]
	    ) );
	    Yii::app()->end();
	}

	/**
	 * 检查请求
	 * @see CController::beforeAction()
	 */
	public function beforeAction ( $action )
	{
	    $this->checkParams();
	    return true;
	}
	
	/**
	 * 检查必备参数
	 */
	public function checkParams()
	{
		$params = $this->getActionParams();
		foreach ( $this->params as $name ) {
			if ( !isset( $params[ $name ] ) )  $this->fail( ErrorCode::INVALID_REQUEST );
		}		
	}

	/**
     * 获取参数
     */
	public function getActionParams()
	{
		return array_merge( $_GET, $_POST );
	}

	/**
	 * 获取参数
	 * @param array $names
	 */
	public function getParams ( $names = array() )
	{
	    $params = array();
	    foreach ( $names as $name ) {
	        array_push( $params, $this->actionParams[ $name ] );
	    }
	    return $params;
	}
}