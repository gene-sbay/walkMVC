<?php

function frameworkLevelIncludes($pathPrefix='../..')
{
		// 3rd-PARTY INCLUDES
		
	require_once $pathPrefix . '/php/codeguy-Slim/Slim/Slim.php';
	
	require_once $pathPrefix . '/php/phpDataMapper/Base.php';
	require_once $pathPrefix . '/php/phpDataMapper/Adapter/Mysql.php';
	
	require_once($pathPrefix . '/php/smarty/libs/Smarty.class.php');
	
		// walkMVC INCLUDES
		
	require_once $pathPrefix . '/php/misc_util.php';
}


function appLevelIncludes($pathPrefix='.')
{
	// app-specific INCLUDES
	
	require_once $pathPrefix . '/_util/util_smarty.php';
	
	require_once $pathPrefix . '/_util/app_cfg.php';
	require_once $pathPrefix . '/_util/app_message.php';
	require_once $pathPrefix . '/_util/app_util.php';
	
	require_once $pathPrefix . '/_util/util_formcfg.php';
	require_once $pathPrefix . '/_util/util_session.php';
	
	
	// START model includes - after base includes
	
	require_once $pathPrefix . '/post/logic_post.php';
	require_once $pathPrefix . '/post/form_post.php';
	require_once $pathPrefix . '/post/map_post.php';
}

/*
*/
	// END model includes

function getRestConfig($pathPrefix='.')
{
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();
			
	require_once $pathPrefix . '/post/rest_post.php';	
	
	return $app;
}

?>