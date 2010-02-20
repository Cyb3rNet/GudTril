<?php

include("github.connect.inc.php");


//// INTERFACE - GITHUB RESPONSE WRAPPER
//
interface IGithubResponseWrapper
{
	public function SetResponseType(CGithubResponseTypes $sType);
	public function GetResponseType();
	public function GetResponse();
}


//// INTERFACE - GITHUB REQUEST WRAPPER
//
interface IGithubRequestWrapper
{
	public function SetRequest(CGithubRequest $oGithubRequest);
}


//// INTERFACE - GITHUB API SPECIFICATION
//
interface IGithubAPISpecification
{
	public function AppendAPIURL($sURL);
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
	
	public function __construct($sURL, CHTTPRequestMethodTypes $iMethod)
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
}


////
//// CLASS - GITHUB REQUEST
////
//
class CGithubRequest extends CHTTPRequest
{
	public function __construct(string $sProtocolLessURL, CHTTPRequestMethodTypes $iMethod)
	{
		$sURL = $this->_SetProtocol().$sProtocolLessURL;
	
		parent::__construct($sURL, $iMethod);
	}
	
	private function _SetProtocol()
	{
		if (HTTPS)
			return 'https';
		else
			return 'http';
	}
}


////
//// CLASS - GITHUB RESPONSE TYPES
////
//
class CGithubResponseTypes
{
	const sJSON = 'json';
	const sYAML = 'yaml';
	const sXML = 'xml';
}


////
//// CLASS - GITHUB CONNECTION WRAPPER
////
//
class CGithubConnectionWrapper extends CGithubConnect implements IGithubResponseWrapper, IGithubRequestWrapper, IGithubAPISpecification
{
	private $_oGithubRequest;
	private $_sResponseType;
	private $_sAPIPath;
	private $_sResponse;

	public function __construct()
	{
		$this->_oGithubRequest = null;
		$this->_sResponseType = "";
		$this->_sAPIPath = "";
	}
	
	public function SetRequest(CGithubRequest $oGithubRequest)
	{
		$this->_oGithubRequest = $oGithubRequest;
	}

	public function SetResponseType(CGithubResponseTypes $sType)
	{
		$this->_sResponseType = $sType;
	}

	public function GetResponseType()
	{
		return $this->_sResponseType;
	}
	
	public function GetResponse()
	{
		return $this->_sResponse;
	}
	
	public function AppendAPIURL($sPath)
	{
		$this->_sAPIPath = $sPath;
	}
	
	public function MakeRequest()
	{
		$this->_oGithubRequest->AppendURL($this->_sResponseType);
		$this->_oGithubRequest->AppendURL($this->_sAPIPath);
		
		parent::__construct($this->_oGithubRequest);
		
		$this->_sResponse = $this->Connect();
	}
}


?>