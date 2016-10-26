<?php

class Timezone_Search_CurlWrap
{
  private $ch;
  private $url;
  private $response;
  private $info;
  private $http_code;
  private $CURL_EXEC_RETRY_MAX = 3;

  function __construct()
  {
     $this->ch = curl_init();
     $this->setOption(CURLOPT_RETURNTRANSFER,true);
     $this->setOption(CURLOPT_BINARYTRANSFER,true);
     $this->setOption(CURLOPT_FOLLOWLOCATION,true);
  }

  function __destruct() {curl_close($this->ch); }

  public function setOption($option,$value) {curl_setopt($this->ch,$option,$value);}

  public function exec($url='')
  {
     if ($url!='') $this->setOption(CURLOPT_URL,$url);
     $this->retryExec();
     $this->info=curl_getinfo($this->ch);
     $this->http_code=$this->info['http_code'];
  }

  public function getHttpCode() {return $this->http_code;}
  public function getExecResponse() {return $this->response;}
  public function getExecInfo() {return $this->info;}
  public function getError() {return curl_error($this->ch);}

  //The logic of retry can be different, but when making a web service call
  //it is essential have some retry, as the resource might not be accessible briefly online
  //due to many reasons.
  private function retryExec()
  {
     $i=0;
     while ($i++ <$this->CURL_EXEC_RETRY_MAX) {
        $this->response=curl_exec($this->ch);
        if ($this->response) break;
        if ($i<$this->CURL_EXEC_RETRY_MAX) sleep($i);
     }
  }

}