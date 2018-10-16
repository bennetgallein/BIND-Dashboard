<?php
use Tracy\Debugger;

require("vendor/autoload.php");

session_start();

Debugger::enable(Debugger::DETECT);

\Controllers\Dashboard::initiate();