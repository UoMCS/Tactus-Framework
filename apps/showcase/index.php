<?php

/**
 * Make no changes to this file, it will be deleted when you deploy your app
 * This is the entry point for your application
 * All pages served for tactus will go via this file, it handles access to the configuration and to the template
 */

// Include the framework
$is_localhost = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
$framework_bootstrap = '../../framework/bootstrap.php';
if (file_exists($framework_bootstrap)) {
  require_once('../../framework/bootstrap.php');
} else {
  $dir_name = dirname($framework_bootstrap);
  $real_path = realpath($dir_name);

  echo 'Error: An app must be accessed from /apps/app-name/, or the Tactus framework as not found.<br />';
  if ($is_localhost) {
  	echo 'Searched for bootstrap.php in ' . ($real_path ? $real_path : $dir_name).'<br />';

  	echo '<h2>Installed Apps</h2>';
  	echo '<ul>';
  	foreach(glob("*/") as $filename) {
  		echo sprintf('<li><a href="%1$s" target="_blank">%1$s</a></li>', $filename);
  	}
  	echo '</ul>';
  }

  die();
}

// Create an instance of your application
$app = new TactusApp();

// Serve it to the end user
$app->serve();
