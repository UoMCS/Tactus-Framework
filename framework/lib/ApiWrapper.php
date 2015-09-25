<?php

abstract class ApiWrapper {
  private $secretKey;
  private $endPointURL;

  public function __construct($endPointURL, $secretKey) {
    $this->secretKey = $secretKey;
    $this->endPointURL = $endPointURL;
  }

  protected function getEndPointURL() {
    return $this->endPointURL;
  }

  protected function getSecretKey() {
    return $this->secretKey;
  }

  protected function get($data = array(), $cacheMinutes = 1800) {
    $data['key'] = $this->getSecretKey();

    $url = $this->getEndPointURL().'?'.http_build_query($data);

    $response = $this->getCachedFile($url, $cacheMinutes);
    if(!$response) {
      $curl = curl_init($url);
      curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false
      ));
      $response = curl_exec($curl);
      curl_close($curl);

      $this->saveCachedFile($url, $response);
    }

    return $response;
  }

  /**
   * Make a post request to the endpoint
   */
  protected function post($data = array()) {
    $data['key'] = $this->getSecretKey();

    $url = $this->getEndPointURL();
    $curl = curl_init($url);
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url,
      CURLOPT_CONNECTTIMEOUT => 5,
      CURLOPT_TIMEOUT => 5,
      CURLOPT_POST => 1,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_SSL_VERIFYPEER => false
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }

  private function getCachedFile($name, $cacheMinutes = 1800) {
    if($cacheMinutes == false) {
      return false;
    }

    $cacheFile = '/tmp/' . md5($name) . '.tactus-api-cache';
    if (file_exists($cacheFile) && (filemtime($cacheFile) > (time() - $cacheMinutes))) {
      return file_get_contents($cacheFile);
    } else {
      return false;
    }
  }

  private function saveCachedFile($name, $contents) {
    $cacheFile = '/tmp/' . md5($name) . '.tactus-api-cache';
    file_put_contents($cacheFile, $contents, LOCK_EX);
  }
}
