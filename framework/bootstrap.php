<?php

/**
 * This file is responsible for all of the dependencies of a tactus app
 */

function __autoload($className) {
  $className = str_replace('Tactus\\', '', $className);

	$filePath = dirname(__FILE__) . '/lib/' . $className . '.php';
  if (file_exists($filePath))
    return require_once $filePath;

  $baseFilePath = dirname(__FILE__) . '/lib/base/' . $className . '.php';
  if (file_exists($baseFilePath))
    return require_once $baseFilePath;
}

spl_autoload_register('__autoload');

/**
 * Also autoload admin dependencies if the file exists
 */
$rootFolder = __DIR__ . "/../../";
$adminFolder = $rootFolder . "tactus-admin/";
if (file_exists($adminFolder . 'bootstrap/externalApp.php')) {
  require_once $adminFolder . 'bootstrap/externalApp.php'; // Admin auto-loading
}
