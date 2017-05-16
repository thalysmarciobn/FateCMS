<?php
require '../classes/autoload.php';

$app = new \Fate\App();

$app->getPlugins()->put("news", new \Plugins\News());
$app->getPlugins()->put("ranking", new \Plugins\Ranking());

$app->getRoutes()->put("", new \Controllers\home());
$app->getRoutes()->put("ranking", new \Controllers\ranking());
$app->getRoutes()->put("cf-userlogin.php", new \Controllers\game\login());
$app->getRoutes()->put("cf-usersignup.php", new \Controllers\game\signup());
$app->getRoutes()->put("gameversion.asp", new \Controllers\game\version());

$app->getRoutes()->put("ipn", new \Controllers\PayPal());

$app->run();