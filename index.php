<?php
use Tracy\Debugger;

require("vendor/autoload.php");

session_start();

Debugger::enable(Debugger::DETECT);

define("APP_URL", "BIND-Dashboard");

\Controllers\Dashboard::initiate();