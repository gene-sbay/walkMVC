<?php

// must be called prior to app includes, since they check for user id
// when running in public page, it is just an extra call with miniscule overhead
session_start();  

require_once './_util/app_cfg.php';
require_once './_util/app_includes.php';	


frameworkLevelIncludes('../walkMVC');
appLevelIncludes(APP_FILE_PATH);

$smartyPathPrefix = '.';
loadSmarty($smartyPathPrefix);

$app = getRestConfig('.');

	// FOR DEMO
$app->get('/access/sayHello', 'sayHello' ); 
function sayHello () 
				{ echo "hello2"; }


$app->run();