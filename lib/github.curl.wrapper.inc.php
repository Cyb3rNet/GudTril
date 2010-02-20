<?php

include("curl.inc.php");


//// INTERFACE - GITHUB CONNECT
//
interface IGithubConnect
{
	public function Connect();
}


////
//// CLASS - HTTP REQUEST METHOD TYPES
////
//
class CHTTPRequestMethodTypes
{
	const iGet = 0;
	const iPost = 1;	
}


////
//// CLASS - HTTP REQUEST
////
//
class CHTTPRequest
{
	private $_sURL;
	private $_iMethod;
	private $_sPost;
	
	public function __construct($sURL, $iMethod)
	{
		$this->_sURL = $sURL;
		$this->_iMethod = $iMethod;
		$this->_sPost = "";
	}
	
	public function AppendURL($sPath)
	{
		$this->_sURL .= $sPath;
	}
	
	public function SetPost($sPost)
	{
		$this->_sPost = $sPost;
	}
	
	public function GetURL()
	{
		return $this->_sURL;
	}
	
	public function GetMethod()
	{
		return $this->_iMethod;
	}
	
	public function GetPost()
	{
		return $this->_sPost;
	}
}


////
//// CLASS - FOR GITHUB CONNECTION
////
//
class CGithubCurlWrapper implements IGithubConnect
{
	private $_oHTTPRequest;
	private $_oConnection;

	public function __construct(CHTTPRequest $oHTTPRequest)
	{
		$this->_oHTTPRequest = $oHTTPRequest;
	
		$this->_oConnection = $this->_GetConnectionByRequest();
	}

	private function _GetConnectionByRequest()
	{
		switch ($this->_oHTTPRequest->GetMethod())
		{
			case CHTTPRequestMethodTypes::iGet:
				$oCurl = new CCurlBaseGet($this->_oHTTPRequest->GetURL());
			break;
			
			case CHTTPRequestMethodTypes::iPost:
				$oCurl = new CCurlBasePost($this->_oHTTPRequest->GetURL());
			break;
		}
		
		return $oCurl;
	}
	
	public function Connect()
	{
		$this->_oConnection->PrepareOptions();
		
		if ($this->_oHTTPRequest->GetMethod() == CHTTPRequestMethodTypes::iPost)
			$this->_oConnection->SetPostString($this->_oHTTPRequest->GetPost());
		
		return $this->_oConnection->Execute();
	}
}


?>