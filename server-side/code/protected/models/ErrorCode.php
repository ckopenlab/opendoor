<?php
class ErrorCode
{
	/**
     * 请求成功
     */
    const SUCCESS = 1;           //请求成功

    /**
     * 通用错误
     */
    const UNKNOWN_ERROR    = 0;     //未知错误
    const UNSUPPORTED      = 1000;  //不支持的API接口
    const MISS_PARAM       = 1001;  //缺少参数
    const INVALID_PARAM    = 1002;  //非法参数
    const INVALID_REQUEST  = 1003;  //非法请求
    const NOT_FOUND        = 1004;  //未找到此记录
    
    /**
     * 用户错误
     */
    const REGISTERED       = 2000; //已经注册
    const NOT_REGISTERED   = 2001; //还没有注册 
    const REVIEWING		   = 2002; //正在审核中
    const EXPIRED		   = 2003; //已经过期
    
    /**
     * 门错误
     */
}