<?php
class StatusTest extends TestCase
{
	const STATUS_NEW        = 'new';
	const STATUS_REVIEW  	= 'review';
	const STATUS_NORMAL     = 'normal';
	const STATUS_EXPIRED    = 'expired';
	
	protected $fields = array(
		'status', 'notice'
	);	

	/**
	 * 测试前删除用户
	 */
	function setUp()
	{
		$this->destroyTestUser( TEST_USER );	
	}
	
	/**
	 * 测试后删除用户
	 */
	function tearDown()
	{
		$this->destroyTestUser( TEST_USER );	
	}
	
    /**
     * 获取状态(成功)
     */
    function testStatusShouldSuccess()
    {
        $r = $this->getAPI();
        $this->assertSuccess( $r );
    }
    
    /**
     * 首次访问提示新用户
     */
    function testFirstTimeShouldReturnNew()
    {
        $r = $this->getAPI();
        if ( $this->assertSuccess( $r ) ) {
        	$this->assertEqual( $r[ 'result' ][ 'status' ], self::STATUS_NEW );
        }
    }
    
    /**
     * 新用户注册后提示正在审核 
     */
    function testAfterRegisterShouldReturnReview()
    {
    	$this->createTestUser();
        $r = $this->getAPI();
        if ( $this->assertSuccess( $r ) ) {
        	$this->assertEqual( $r[ 'result' ][ 'status' ], self::STATUS_REVIEW );
        }
    }
    
	/**
     * 审核通过后状态正常
     */
    function testAfterReviewShouldReturnNormal()
    {
    	$this->createTestUser();
    	Sqlite::exec( 'update tbl_user set level="user", expire=' . ( time() + 100 ) . ' where username="' . TEST_USER . '"' );
        $r = $this->getAPI();
        var_dump($r);
        if ( $this->assertSuccess( $r ) ) {
        	$this->assertEqual( $r[ 'result' ][ 'status' ], self::STATUS_NORMAL );
        }
    }
    
	/**
     * 过期后提示过期
     */
    function testAfterExpiredShouldReturnExpired()
    {
    	$this->createTestUser();
    	Sqlite::exec( 'update tbl_user set level="user", expire=' . ( time() - 100 ) . ' where username="' . TEST_USER . '"' );
        $r = $this->getAPI();
        $this->assertEqual( $r[ 'result' ][ 'status' ], self::STATUS_EXPIRED );
    }
}