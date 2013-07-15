<?php
class OldTest extends TestCase
{
    /**
     * 旧版本客户端提示过期
     */
    function testOpenShouldFail()
    {
        $r = $this->get( TEST_API_SERVER . '/open.php' );
        $this->assertText( '废弃使用' );
    }
		
}