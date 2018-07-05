<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// ini_set("session.save_path", "tcp://46.101.72.243?prefix=APP_SESSIONS:&auth=1CF2A06FB081610F55539FFEA52DAD687E5893BA0A167D155D4EA5F8A338FD2A");

// GET /visit-counter.php initialises a session and returns the number
// of requests already made by a given authenticated client.
// This is the main test script that exercises the RedisSessionHandler.

require_once __DIR__.'/../../vendor/autoload.php';

if (isset($_GET['with_no_time_limit'])) {
    set_time_limit(0);
} elseif (isset($_GET['with_custom_cookie_params'])) {
    session_set_cookie_params(86400, '/', '', true, true);
}

$session = new \Aliene\Phalcon\Session\Redis([
    "host" => "46.101.72.243",
    "auth" => "1CF2A06FB081610F55539FFEA52DAD687E5893BA0A167D155D4EA5F8A338FD2A",
    "lifetime" => 10000
]);

$session->start();

var_dump($session->get("visits"));

if (!$session->has('visits')) {
    $session->set('visits', 0);
}

// $session->incr("visits");
++$_SESSION["visits"];
echo $session->get("visits");
