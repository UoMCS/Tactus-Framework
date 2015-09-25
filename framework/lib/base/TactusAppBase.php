<?php

/**
 * BaseTactusApp
 *
 * Includes all internal functionality required by a tactus app.
 * @see TactusApp for public functinality
 */
abstract class TactusAppBase implements JsonSerializable {
  protected $validApp = true;
  protected $appsBaseURL; // set in config.php

  private $appPath = 'app/';

  private $frameworkRootPath;
  private $appsRootPath;

  private $calledCallbacks = array();

  private $phpFilesToServe = array('index.php', 'template.php');

  public function __construct($id = false, $appJSON = false) {

    $this->frameworkRootPath = __DIR__ . '/../../';
    $this->appsRootPath = $this->frameworkRootPath . '../';

    $this->appsBaseURL = Tactus\Config::getConfig('app-url', '/tactus-apps/');

    // if not set the current path is tactus-apps/apps/app-id/index.php
    if(!$id) {
      $id = join(DIRECTORY_SEPARATOR, array_slice(explode(DIRECTORY_SEPARATOR, getcwd()), -2));
    }

    $this->id = $id;

    if(!$appJSON)
      $appJSON = file_get_contents($this->getAppJSONPath());
    $this->parseAppJSON($appJSON);
  }

  public function serve() {
    $this->includeAppFiles();
    $this->checkAllCallbacksWereTriggered();
  }

  public function updateFromArray($attributesArray) {
    $tactusAdminVariables = array('name', 'description', 'version', 'author', 'colour', 'icon', 'popularity', 'email', 'visible');

    foreach($tactusAdminVariables as $var) {
      if (isset($attributesArray[$var]))
        $this->{$var} = $attributesArray[$var];
    }

    if(isset($attributesArray['tags'])) {
      if(is_array($attributesArray['tags'])) {
        $this->tags = $attributesArray['tags'];
      } else {
        $this->tags = array($attributesArray['tags']);
      }
    }
  }

  private function includeAppFiles() {
    $foundCode = false;

    foreach($this->phpFilesToServe as $fileToServe) {
      if(file_exists($this->appPath . $fileToServe)) {
        $app = &$this;
        include_once($this->appPath . $fileToServe);
        $foundCode = true;
      }
    }

    if(!$foundCode) {
      $message = 'You must define at least one of: ' . implode(',', $this->phpFilesToServe) . '; for your app to run!';
      $app->errorAndExit($message);
    }
  }

  private function parseAppJSON($jsonString) {

    $json = json_decode($jsonString, true);
    if(json_last_error() != JSON_ERROR_NONE) {
      $this->validApp = false;
      return false;
    }

    $topLevelVariables = array('name', 'version', 'description', 'author', 'icon', 'url', 'visible', 'email');

    foreach($topLevelVariables as $var) {
      if (isset($json[$var]))
        $this->{$var} = $json[$var];
    }

    $colour = isset($json['colour']) ? $json['colour'] : (isset($json['color']) ? $json['color'] : 'Purple');
    $colour = ucfirst(strtolower($colour));
    if(defined('Colour::' . $colour)) {
      $this->colour = constant('Colour::' . $colour);
    } else {
      $this->colour = Colour::Purple;
    }

    if(isset($json['tags'])) {
      if(is_array($json['tags'])) {
        $this->tags = $json['tags'];
      } else {
        $this->tags = array($json['tags']);
      }
    }
  }

  //////////////////////////

  private function getDefaultJSFilePath() {
    return $this->appPath . 'js/app.js';
  }

  private function getDefaultCSSFilePath() {
    return $this->appPath . 'css/app.css';
  }

  private function getFrameworkPublicFolder() {
    return Tactus\Config::getConfig('framework-public-url', '/framework/public');
  }

  private function getAppDir() {
    return realpath($this->appsRootPath . $this->id . '/') . '/';
  }

  private function getAppJSONPath() {
    return $this->getAppDir() . $this->appPath . 'app.json';
  }

  private function checkAllCallbacksWereTriggered() {
    $expectedCallbacks = ['head', 'bodyHead', 'bodyFooter'];

    foreach($expectedCallbacks as $functionName) {
      if(!$this->calledCallbacks[$functionName]) {
        $this->errorAndExit("A callback was missed, make sure your template calls \$app->$functionName()!");
      }
    }
  }

  private function errorAndExit($message) {
    ob_clean();
    die($message);
  }

  ////////////////////////


  /**
   * Add common app dependencies including bootstrap and jQuery
   */
  public function head() {
    $this->calledCallbacks[__FUNCTION__] = true;
    include_once($this->frameworkRootPath . 'template/header.php');
  }

  /**
   * Add content to the top of the page
   */
  public function bodyHead() {
    $this->calledCallbacks[__FUNCTION__] = true;
  }

  /**
   * Add content to the end of the page
   */
  public function bodyFooter() {
    $this->calledCallbacks[__FUNCTION__] = true;
  }

  ////////////////////////

  /**
   * Attempt to load a cached URL from disk
   * @return The cached response of the url OR false
   */
  public function getCachedFile($url, $cacheMinutes = 1800) {
    $cacheFile = '/tmp/' . md5($url) . '.tactus-cache';
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - $cacheMinutes))) {
      return file_get_contents($cacheFile);
    } else {
      return false;
    }
  }

  /**
   * Save a the response for a URL to disk
   */
  public function saveCachedFile($url, $contents) {
    $cacheFile = '/tmp/' . md5($url) . '.tactus-cache';
    file_put_contents($cacheFile, $contents, LOCK_EX);
  }

  /**
   * Lookup the student database for the developer of this app and connect to it
   */
  protected function getAdminPDO() {
    if(empty($this->getUsername())) {
      throw new TactusException('No username found for the developer of this app, unable to lookup dashboard database.');
    }

    $factory = new TactusAdmin\StudentDatabaseFactory($this->getUsername());
    $db = $factory->getPDOConnection();

    return $db;
  }

  protected function getAdminMysqli() {
    if(empty($this->getUsername())) {
      throw new TactusException('No username found for the developer of this app, unable to lookup dashboard database.');
    }

    $factory = new TactusAdmin\StudentDatabaseFactory($this->getUsername());
    $db = $factory->getMysqliConnection();

    return $db;
  }
}
