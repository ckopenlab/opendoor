<?php
class OldTest extends TestCase
{
    /**
     * 旧版本客户端提示过期
     */
    function testOpenShouldFail()
    {
        $r = $this->get( TEST_API_SERVER . '/deprecated.php' );
        $this->assertText( '废弃使用' );
        $r = $this->get( TEST_API_SERVER . '/open/token' );
        $this->assertText( '废弃使用' );
    }
		
}