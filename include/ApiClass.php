<?php
class API {
    private $url;
  
    public function __construct($url) {
      $this->url = $url;
    }
  
    public function getData($params = array()) {
      $ch = curl_init();
  
      $url = $this->url;
      if (!empty($params)) {
        $url .= '?' . http_build_query($params);
      }
  
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
      $response = curl_exec($ch);
      if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception($error);
      }
  
      curl_close($ch);
      return json_decode($response, true);
    }
  }
  
 

?>