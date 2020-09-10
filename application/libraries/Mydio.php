<?php 
/**
 * Mydio Sing Simple Library For CodeIgniter
 * Created by Made Ari Sudarma
 * email : arisudarma@gmail.com
 */
include_once('Curl.php');

class Mydio
{
	public $curl = null;
	function __construct()
	{
		$this->curl = new Curl();
	}
	public function song($param='')
	{
		if ($param == '') {
			return null;
		}else{
			// $data = $this->curl->simple_get('https://mydiosing.com:8843/mydio/QueryRecording?'.http_build_query($param));
			$data = $this->curl->simple_get('https://dev.mydiosing.com/mydio/QueryRecording?'.http_build_query($param));
			return json_decode($data, true);
		}
	}
	public function qsong($param)
	{
		if ($param == '') {
			return null;
		}else{
			// $data = $this->curl->simple_get('https://mydiosing.com:8843/mydio/QuerySong?'.http_build_query($param));
			$data = $this->curl->simple_get('https://dev.mydiosing.com/mydio/QuerySong?'.http_build_query($param));
			return json_decode($data, true);
		}
	}
	public function users($param)
	{
		if ($param == '') {
			return null;
		}else{
			// $data = $this->curl->simple_get('https://mydiosing.com:8843/mydio/QueryUser?'.http_build_query($param));
			$data = $this->curl->simple_get('https://dev.mydiosing.com/mydio/QueryUser?'.http_build_query($param));
			return json_decode($data, true);
		}
	}
}
 ?>