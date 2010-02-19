<?php

include("curl.inc.php");


//// INTERFACE - GITHUB CONNECT
//
interface IGithubConnect
{
	public function Connect();
}


////
//// CLASS - FOR GITHUB CONNECTION
////
//
class CGithubConnect implements IGithubConnect
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
		switch ($this->_oHTTPRequest->iMethod)
		{
			case CHTTPRequestMethodTypes::iGet:
				$oCurl = new CCurlBaseGet($this->_oHTTPRequest->sURL);
			break;
			
			case CHTTPRequestMethodTypes::iPost:
				$oCurl = new CCurlBasePost($this->_oHTTPRequest->sURL);
			break;
		}
		
		return $oCurl;
	}
	
	public function Connect()
	{
		$this->_oConnection->PrepareOptions();
		
		if ($this->_oHTTPRequest->iMethod == CHTTPRequestMethodTypes::iPost)
			$this->_oConnection->SetPostString($this->_oHTTPRequest->sPost);
		
		return $this->_oConnection->Execute();
	}
}


?>