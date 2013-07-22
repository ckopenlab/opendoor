<?php
class OpenTest extends TestCase
{
	protected $fields = array( 'status' );
	
	/**
	 * 测试前创建测试用户
	 */
	function setUp()
	{
		parent::setUp();
		$this->createTestUser( TEST_USER );
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
     * 审核通过后可以开门(成功)
     */
    function testOpenAfterAccessShouldSuccess()
    {
        $this->accessTestUser( TEST_USER );
        $r = $this->getAPI();
        if ( $this->assertSuccess( $r ) ) {
        	$this->assertEqual( $r[ 'result' ][ 'status' ], 'ok' );
        }
        
    }
	
    /**
     * 正在审核中不能开门(失败)
     */
    function testOpenWhileReviewingShouldFail()
    {
        $r = $this->getAPI();
        if ( $this->assertSuccess( $r ) ) {
	        $this->assertEqual( $r[ 'result' ][ 'status' ], 'fail' );
	        $this->assertFields( $r[ 'result' ], array( 'reason' ) );
        }
    }
    
    /**
     * 授权过期后不能开门(失败)
     */
    function testOpenAfterExpiredShouldFail()
    {
    	$this->expireTestUser( TEST_USER );
        $r = $this->getAPI();
        if ( $this->assertSuccess( $r ) ) {
	        $this->assertEqual( $r[ 'result' ][ 'status' ], 'fail' );
	        $this->assertFields( $r[ 'result' ], array( 'reason' ) );
        }
    }
    
    /**
     * 没有注册不能开门(失败)
     */
    function testOpenWithOuteRegisterShouldFail()
    {
    	$this->destroyTestUser( TEST_USER );
        $r = $this->getAPI();
        $this->assertFail( $r, ErrorCode::NOT_REGISTERED );
    }
}