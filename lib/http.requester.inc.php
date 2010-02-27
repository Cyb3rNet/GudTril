<?php


include("curl.inc.php");
include("github.api.call.limitator.inc.php");


//// INTERFACE - CONNECT
//
interface IConnect
{
	public function Connect();
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
//
class CHTTPRequester extends CGithubAPICallLimitator implements IConnect
{
	private $_sURL;
	private $_iMethod;
	private $_sPostString;

	private $_oConnection;

	public function __construct($sURL, $iMethod, $sPostString = "")
	{
		parent::__construct();
	
		if (FORCE_HTTPS)
			$sURL = $this->_SetHTTPS($sURL);

		$this->_sURL = $sURL;
		$this->_iMethod = $iMethod;
		$this->_sPostString = $sPostString;
	}
	
	private function _SetHTTPS($sURL)
	{
		return str_replace('http://', 'https://', $sURL);
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

	public function Connect()
	{

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