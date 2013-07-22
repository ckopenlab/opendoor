<?php
require_once dirname(__FILE__).'/define.php';
require_once dirname(__FILE__).'/tester/tester.php';
require_once dirname(__FILE__).'/../protected/config/define.php';
require_once dirname(__FILE__).'/../protected/helpers/Sqlite.php';
require_once dirname(__FILE__).'/../protected/models/ErrorCode.php';

abstract class TestCase extends ZTestCase
{
    const RESPONSE_TYPE = 'json';
    
    public function appendParams($params)
    {
    	return array_merge( $params, array(
    		'phoneUDID' => TEST_UDID,
    		'phoneModel' => TEST_DEVICE,
    		'softVersion' => TEST_VERSION
    	));
    }
    
    public function createTestUser ( $name = TEST_USER )
    {
    	$r = $this->getAPI( '/register', array( 'name' => $name ) );
    }
    
    public function destroyTestUser ( $name = TEST_USER )
    {
    	Sqlite::exec( 'delete from tbl_user where username="' . $name . '"' );
    }
    
    public function accessTestUser ( $name = TEST_USER )
    {
    	Sqlite::exec( 'update tbl_user set level="user", expire=' . ( time() + 100 ) . ' where username="' . $name . '"' );
    }
    
    public function expireTestUser ( $name = TEST_USER )
    {
    	Sqlite::exec( 'update tbl_user set level="user", expire=' . ( time() - 100 ) . ' where username="' . $name . '"' );
    }

    protected function getFields ( $response )
    {
        return $response[ 'result' ];
    }
}

new Tester( dirname( __FILE__ ) . '/tests' );
