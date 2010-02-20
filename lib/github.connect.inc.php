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
//
class CGithubConnect extends CHTTPRequester implements IGithubResponse, IGithubRequest
{
	private $_sResponseType;
	private $_sAPIPath;
	private $_sResponse;

	public function __construct($sBaseURL, $iMethod, $sPostString = "")
	{
		parent::__construct($sBaseURL, $iMethod, $sPostString = "");

		$this->_sResponseType = "";
		$this->_sAPIPath = "";
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
}


?>