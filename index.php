<?php

/* Load application config */
require 'application/config/config.php';

/* Setup application */
if (APP_ENCODING) { header('Content-Type: text/html; charset=' . APP_ENCODING); }
if (APP_LOCALE) { setlocale(LC_ALL, APP_LOCALE); }
if (APP_TIMEZONE) { date_default_timezone_set(APP_TIMEZONE); }
if (APP_SESSION) { session_start(); }

/* Error reporting */
if (APP_ENVIRONMENT == 'development') {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
} else {
	error_reporting(0);
	ini_set('display_errors', 'Off');
}


// Load application
require 'lib/application.php';
require 'lib/controller.php';
require 'lib/model.php';

/* Load database */
if (APP_DATABASE) { require 'lib/database.php'; }

/* Load crypt */
if (APP_CRYPT) { require 'lib/crypt.php'; }

// Start the application
$app = new Application();
