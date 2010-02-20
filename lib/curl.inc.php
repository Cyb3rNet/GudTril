<?php


////
//// CLASS - CURL BASE GET
////
//
class CCurlBaseGet
{
	private $_ch;
	
	protected $_sURL;

	public function __construct($sURL)
	{
		$this->_ch = curl_init();
		
		$this->_sURL = $sURL;
	}

	public function __destruct()
	{
		//closing the curl
		curl_close($this->_ch);
	}
	
	public function GetURL()
	{
		return $this->_sURL;
	}
	
	public function PrepareOptions()
	{
		curl_setopt($this->_ch, CURLOPT_URL, $this->_sURL);
	}

	public function Execute()
	{
		//getting response from server
		$sResponse = curl_exec($this->_ch);
		
		#echo curl_error($this->_ch);
		
		return $sResponse;
	}
}


////
//// CLASS - CURL BASE POST
////
//
class CCurlBasePost
{
	protected $_ch;
	
	private $_sURL;
	private $_sPost;

	public function __construct($sURL)
	{
		$this->_ch = curl_init();
		
		$this->_sURL = $sURL;
		$this->_sPost = "";
	}

	public function __destruct()
	{
		//closing the curl
		curl_close($this->_ch);
	}
	
	public function GetURL()
	{
		return $this->_sURL;
	}

	public function PrepareOptions()
	{
		curl_setopt($this->_ch, CURLOPT_URL, $this->_sURL);
		curl_setopt($this->_ch, CURLOPT_POST, true);
	}
	
	public function SetPostString($sPost)
	{
		$this->_sPost = $sPost;
	}

	public function GetPostString()
	{
		return $this->_sPost;
	}
	
	public function Execute()
	{
		curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_sPost);

		//getting response from server
		$sResponse = curl_exec($this->_ch);
		
		#echo curl_error($this->_ch);
		
		return $sResponse;
	}
}


?>