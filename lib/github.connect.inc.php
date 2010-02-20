<?php

include("github.curl.wrapper.inc.php");


//// INTERFACE - GITHUB RESPONSE
//
interface IGithubResponse
{
	public function SetResponseType(CGithubResponseTypes $sType);
	public function GetResponseType();
	public function GetResponse();
}


//// INTERFACE - GITHUB REQUEST
//
interface IGithubRequest
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
//// CLASS - GITHUB CONNECTION WRAPPER
////
//
class CGithubConnect extends CGithubCurlWrapper implements IGithubResponse, IGithubRequest, IGithubAPISpecification
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