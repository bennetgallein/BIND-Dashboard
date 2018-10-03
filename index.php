<?php
use Tracy\Debugger;

require("vendor/autoload.php");

Debugger::enable(Debugger::DETECT);

define("APP_URL", "BIND-Dashboard");

\Controllers\Dashboard::initiate();