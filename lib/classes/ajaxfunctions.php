<?php
class Timezone_Search_AjaxFunctions{

  private $curlWrapClass;

  public function __construct($curlWrapClass)
  {
      $this->curlWrapClass = $curlWrapClass;
  }

  //process ajax data and send response
  function returnSearchResults(){
		$lat = $_POST["lat"];
		$lng = $_POST["lng"];
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		$rest_url = "https://maps.googleapis.com/maps/api/timezone/json?location=";
		$rest_url .= $lat . ',';
		$rest_url .= $lng;
		$rest_url .= '&timestamp=' . $timestamp;
		$rest_url .= '&key=AIzaSyC-n69UWYMY_kgERSEd1UnyGqLFYl_Wi5Y';
		$this->curlWrapClass->exec($rest_url);
		if ($this->curlWrapClass->getHttpCode()!='200') {
			print "ERROR: Failed to fetch url. ". $this->curlWrapClass->getError(). "\n";
		} else {
			$res = $this->curlWrapClass->getExecResponse();
			$tz_data = json_decode($res);
			$timeZoneName = $tz_data->timeZoneName;
			$rawOffset = $tz_data->rawOffset;
			$dstOffset = $tz_data->dstOffset;
			$gmdate = gmdate("m/d/Y g:i:s A", time()+($rawOffset)+$dstOffset);
			echo '<p>Time Zone Name: ' . $timeZoneName . '</p>';
			echo '<p>Current Time: ' . $gmdate . '</p>';
			
			die();
		}
  }
}