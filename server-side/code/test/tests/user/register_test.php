<?php
class RegisterTest extends TestCase
{
	/**
	 * 测试前删除测试用户
	 */
	function setUp()
	{
		parent::setUp();
		$this->destroyTestUser( TEST_USER );
	}

	/**
	 * 测试后删除测试用户
	 */
	function tearDown()
	{
		parent::tearDown();
		$this->destroyTestUser( TEST_USER );
	}
	
    /**
     * 注册(成功)
     */
    function testRegisterShouldSuccess()
    {
        $r = $this->getAPI(array( 'name' => TEST_USER ));
        if ( $this->assertSuccess( $r ) ) {
        	$this->assertEqual( $r[ 'result' ][ 'status' ], 'ok' );	
        }
    }
    
    /**
     * 重复注册(失败)
     */
    function testRepeatRegisterShouldFail()
    {
        $r = $this->getAPI(array( 'name' => TEST_USER ));
        $r = $this->getAPI(array( 'name' => TEST_USER ));
        $this->assertFail( $r, ErrorCode::REGISTERED );
    }
    
    /**
     * 不合法的名称(失败)
     */
    function testWrongNameShouldFail()
    {
    	foreach ( array( '1', '!!!', 'aoecudaoludrc2ounha,r.cuhc,r.hucar,huca,u' ) as $name ) {
        	$this->assertFail( $this->getAPI(array( 'name' => $name )), ErrorCode::INVALID_PARAM );
        	$this->destroyTestUser( $name );
    	}
    }
}