<?php

include("http.requester.inc.php");


//// INTERFACE - GITHUB RESPONSE
//
interface IGithubResponse
{
	public function SetResponseType($sType);
	public function GetResponseType();
}


//// INTERFACE - GITHUB REQUEST
//
interface IGithubRequest
{
	public function SetAPIRequest($sAPIRequest);
	public function GetAPIRequest();
	
	public function SetPostString($sPostString);
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
//// CLASS - GITHUB HTTP CONNECT
////
//   Class implementing HTTP connection and request by extension (inheritance) of
//   CHTTPRequester, adding a layer of service closer to the API.
//
class CGithubConnect extends CHTTPRequester implements IGithubResponse, IGithubRequest, IHTTPRequest
{
	private $_sResponseType;
	private $_sAPIPath;
	private $_sResponse;
	private $_sAuthentication;

	public function __construct($sBaseURL, $iMethod, $sPostString = "")
	{
		parent::__construct($sBaseURL, $iMethod, $sPostString = "");

		$this->_sResponseType = "";
		$this->_sAPIPath = "";
		
		$this->_sAuthentication = "";
	}

	public function SetResponseType($sType)
	{
		$this->_sResponseType = $sType;

		$this->AppendToURL($this->_sResponseType);
	}

	public function GetResponseType()
	{
		return $this->_sResponseType;
	}
	
	public function SetAPIRequest($sAPIRequest)
	{
		$this->_sAPIPath = $sAPIRequest;
		
		$this->AppendToURL($this->_sAPIPath);
	}
	
	public function GetAPIRequest()
	{
		return $this->_sAPIPath;
	}
	
	public function SetAuthentication()
	{
		$this->_sAuthentication = "login=".GITHUB_LOGIN."&token=".GITHUB_TOKEN."&";
	}
	
	public function SetPostString($sPostString)
	{
		$sPostString = $this->_sAuthentication.$sPostString;
	
		parent::SetPostString($sPostString);
	}
}


?>