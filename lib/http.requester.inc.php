<?php


require_once("curl.inc.php");
require_once("github.api.call.limitator.inc.php");


//// INTERFACE - HTTPRequest
//
interface IHTTPRequest
{
	public function GetURL();
	public function AppendToURL($sURLPart);
	
	public function GetMethod();
	
	public function SetPostString($sPostString);
	public function GetPostString();
	
	public function Request();
}


////
//// CLASS - HTTP REQUEST METHOD
////
//
class CHTTPRequestMethods
{
	const iGet = 0;
	const iPost = 1;	
}


////
//// CLASS - HTTP REQUESTER
////
//   Class implementing HTTP connection and request with usage of CurlBaseGet
//   and CurlBasePost. It is also limited to 60 requests per minute by the
//   extension (inheritance) of CGithubAPICallLimitator.
//
class CHTTPRequester extends CGithubAPICallLimitator implements IHTTPRequest
{
	private $_sURL;
	private $_iMethod;
	private $_sPostString;

	private $_oConnection;

	public function __construct($sURL, $iMethod, $sPostString = "")
	{
		parent::__construct();

		$this->_sURL = $sURL;
		$this->_iMethod = $iMethod;
		$this->_sPostString = $sPostString;
	}
	
	public function SetHTTPS()
	{
		$this->_sURL = str_replace('http://', 'https://', $this->_sURL);
	}
	
	public function GetURL()
	{
		return $this->_sURL;
	}
	
	public function AppendToURL($sURLPart)
	{
		$this->_sURL .= $sURLPart;
	}
	
	public function GetMethod()
	{
		return $this->_iMethod;
	}
	
	public function SetPostString($sPostString)
	{
		$this->_sPostString = $sPostString;
	}
	
	public function GetPostString()
	{
		return $this->_sPostString();
	}

	public function Request()
	{	
		if (FORCE_HTTPS)
			$this->SetHTTPS();

		switch ($this->_iMethod)
		{
			case CHTTPRequestMethods::iGet:
				$this->_oConnection = new CCurlBaseGet($this->_sURL);
			break;
			
			case CHTTPRequestMethods::iPost:
				$this->_oConnection = new CCurlBasePost($this->_sURL);
			break;
		}

		$this->_oConnection->PrepareOptions();
		
		if ($this->_iMethod == CHTTPRequestMethods::iPost)
			$this->_oConnection->SetPostString($this->_sPostString);
		
		return $this->_oConnection->Execute();
	}
}


?>