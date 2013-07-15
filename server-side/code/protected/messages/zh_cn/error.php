<?php
return array(

    //通用错误
    ErrorCode::UNKNOWN_ERROR    => '未知错误',
    ErrorCode::UNSUPPORTED      => '不支持的API接口',
    ErrorCode::INVALID_REQUEST  => '非法的请求',
    ErrorCode::MISS_PARAM       => '缺少参数 param',
    ErrorCode::INVALID_PARAM    => '非法的参数 param',
    ErrorCode::NOT_FOUND        => '没有找到记录',

    //用户错误
    ErrorCode::REGISTERED  => '您已经注册过了！',
    ErrorCode::REVIEWING   => '您的审核还没通过呢！',
    ErrorCode::EXPIRED     => '您的授权已过期，请联系管理员！',
    
);