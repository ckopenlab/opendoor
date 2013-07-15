<?php
class ParamsTest extends TestCase
{
	const ROUTE = '/version';
	
	/**
     * 没有parms的请求(失败)
     */
    function testWithNoParamsShouldFail()
    {
        $r = $this->getAPI();
        $this->assertFail( $r, ErrorCode::INVALID_REQUEST );
    }
    
    /**
     * 带params的请求(成功)
     */
    function testWithParamsShouldSuccess()
    {
        $r = $this->getAPI( parent::appendParams(array()) );
        $this->assertSuccess( $r );
    }
    
    public function appendParams($params)
    {
    	return $params;
    } 
}