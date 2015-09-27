<?php

class TactusApp extends TactusAppBase {

  // Default app values that can be overridden by app.json
  protected $id = 'example-app';
  protected $name = 'App with No Name';
  protected $version = '0.0.1';
  protected $description = 'My First Description';
  protected $author = 'Unknown Author';
  protected $icon = 'external-link-square';
  protected $colour = Colour::Red;
  protected $url = null;
  protected $visible = true;
  protected $tags = array();
  protected $email = "unknown@example.com";
  protected $popularity = 0;
  protected $username = null;

  public function isValid() {
    return $this->validApp;
  }

  public function getID() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getVersion() {
    return $this->version;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getAuthor() {
    return $this->author;
  }

  public function getURL() {
    // URL's can be optionally overridden
    if($this->url)
      return $this->url;

    return $this->appsBaseURL . $this->id;
  }

  public function getColour() {
    return $this->colour;
  }

  public function getIcon() {
    return $this->icon;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getTags() {
    return $this->tags;
  }

  public function getPopularity() {
    return $this->popularity;
  }

  public function getUsername() {
    return $this->username;
  }

  public function isVisible() {
    return (boolean) $this->visible;
  }

  public function jsonSerialize() {
    return array(
      'name' => $this->getName(),
      'description' => $this->getDescription(),
      'version' => $this->getVersion(),
      'author' => $this->getAuthor(),
      'colour' => $this->getColour(),
      'icon' => $this->getIcon(),
      'url' => $this->getURL(),
      'popularity' => $this->getPopularity(),
      'emailMD5' => md5(strtolower(trim($this->getEmail()))),
      'tags' => $this->getTags()
    );
  }

  //////////// Useful Functions

  // Caching
  /**
   * @alias getCachedURL
   */
  public function getCachedHTML($url, $cacheMinutes = 1800) {
    return $this->getCachedURL($url);
  }

  /**
   * Make a cached web request, returning the output
   * @param $url URL to make the request to
   * @param $cacheMinutes Number of minutes to cache the reply for
   */
  public function getCachedURL($url, $cacheMinutes = 1800) {
    $contents = $this->getCachedFile($url);

    if($contents === false) {
      $contents = file_get_contents($url); # grab from the internet
      $this->saveCachedFile($url, $contents);
    }

    return $contents;
  }

  /**
   * Make a cached web request, returning the results as decoded JSON
   * @param $url URL to make the request to
   * @param $cacheMinutes Number of minutes to cache the reply for
   */
  public function getCachedJSON($url, $cacheMinutes = 1800) {
    return json_decode($this->getCachedURL($url));
  }

  /**
   * Make a PDO connection to the student database
   * If developing locally this falls back to the passed arguments
   */
  public function getPDO($fallbackHost = false, $fallbackDatabase = false,
                         $fallbackUsername = false, $fallbackPassword = false) {
    // If admin is loaded use production DB credentials
    if(class_exists('TactusAdmin\StudentDatabaseFactory')) {
      $db = $this->getAdminPDO();
      if($db) {
        return $db;
      }
    }

    // If the admin panel isn't loaded, or the user didn't have an account, fallback to passed arguments
    if($fallbackHost && $fallbackDatabase && $fallbackUsername) {
      $db = new PDO($hoststring, $username, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $db;
    }

    throw new TactusException('Unable to connect to student database and but fallback information was provided.');
  }

  /**
   * Make a Mysqli connection to the student database
   * If developing locally this falls back to the passed arguments
   */
  public function getMysqli($fallbackHost = false, $fallbackDatabase = false,
                         $fallbackUsername = false, $fallbackPassword = false) {
    // If admin is loaded use production DB credentials
    if(class_exists('TactusAdmin\StudentDatabaseFactory')) {
      $db = $this->getAdminMysqli();
      if($db) {
        return $db;
      }
    }

    // If the admin panel isn't loaded, or the user didn't have an account, fallback to passed arguments
    if($fallbackHost && $fallbackDatabase && $fallbackUsername) {
      $db = new mysqli($host, $username, $password, $database);
      if($db->connect_errno) {
        $error = sprintf("Unable to make a mysqli connection to fallback db '%s' with user %s@%s: %s", $database, $host, $username, $mysqli->connect_error);
        throw new TactusException($error);
        return false;
      } else {
        return $db;
      }
    }

    throw new TactusException('Unable to connect to student database and but fallback information was provided.');
  }
}
