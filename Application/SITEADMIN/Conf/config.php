<?php
return array(
	//'配置项'=>'配置值'
	'URL_HTML_SUFFIX' => '',
	/* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'onethink_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
	/* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/Static',
        '__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

	/* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'blog', //session前缀
    'COOKIE_PREFIX'  => 'blog_', // Cookie前缀 避免冲突
    'VAR_SESSION_ID' => 'session_id',	//修复uploadify插件无法传递session_id的bug

    ///* 后台错误页面模板 */
    //'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.html', // 默认错误跳转对应的模板文件
    //'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/success.html', // 默认成功跳转对应的模板文件
    //'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.html',// 异常页面的模板文件
	'SHOW_PAGE_TRACE' =>true,
    
);