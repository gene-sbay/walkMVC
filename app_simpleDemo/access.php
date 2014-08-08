<?php

// Comment out *error_reporting* when going to production
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once './_util/app_cfg.php';
require_once './_util/app_includes.php';

localInit();

// =====================
// ----- REST DEMO ------

$app->get('/access/sayHello', 'sayHello' );
function sayHello ()
{ echo "hello2"; }

// =====================
// ----- 404 Handler ------

$app->notFound(function ()
{
	global $app;

	BaseAppUtil::xlog('handling notFound');

	$restStart = APP_REST_ROOT . '/post/home';
	BaseAppUtil::xlog("Attempting to redirect to: $restStart");

	$app->redirect($restStart);

	return true;
});



// =====================
// ----- Now run $app ------

$app->run();

