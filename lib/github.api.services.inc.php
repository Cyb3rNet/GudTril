<?php


include("github.connect.inc.php");


//// INTERFACE - GITHUB API CONNECTION SERVICES
//
interface IGithubAPIConnection
{
	public function AssembleRequest();
	public function RequestService();
}


//// INTERFACE - GITHUB API SERVICES GROUP
//
interface IGithubAPIRequestServices
{
	public function SetResponseType($sResponseType);
	public function SetAuthenticate($bAuthenticate);
	Public function RequestService($sAPIPathURL, $sDefaultMethod, $sPostString = "");
}


////
//// CLASS - GITHUB API REQUESTER
////
//   Class implementing the API connection and request by extension (inheritance)
//   of CGithubConnect a layer above its services.
//
class CGithubAPIRequester extends CGithubConnect implements IGithubAPIConnection
{
	private $_sAPIPathURL;
	private $_sResponseType;
	private $_bAuthenticate;
	private $_iRequestMethod;

	public function __construct($sAPIPathURL, $iDefaultRequestMethod, $sResponseType, $bAuthenticate)
	{
		$this->_sAPIPathURL = $sAPIPathURL;
		
		$this->_iRequestMethod = $iDefaultRequestMethod;
	
		$this->_sResponseType = $sResponseType;

		$this->_bAuthenticate = $bAuthenticate;
		
		if ($this->_bAuthenticate)
		{
			$this->_iRequestMethod = CHTTPRequestMethods::iPost;
		}
	}
	
	public function AssembleRequest($sPostString = "")
	{
		parent::__construct(GITHUB_BASEURL, $this->_iRequestMethod);
		
		if ($this->_bAuthenticate)
		{
			parent::SetAuthentication();
		}
		
		parent::SetPostString($sPostString);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Request();
	}

}


////
//// CLASS - GITHUB API REQUEST SERVICES
////
//   Implements the higher level services for API request and response
//
class CGithubAPIRequestServices implements IGithubAPIRequestServices
{
	// GitHub Service Object
	private $_oGHS;

	private $_sResponseType;
	private $_bForceAuthenticate;
	
	public function __construct($sResponseType, $bForceAuthenticate = false)
	{
		$this->_sResponseType = $sResponseType;
		$this->_bForceAuthenticate = $bForceAuthenticate;
	}

	public function SetResponseType($sResponseType)
	{
		$this->_sResponseType = $sResponseType;
	}

	public function SetAuthenticate($bAuthenticate)
	{
		$this->_bForceAuthenticate = $bAuthenticate;
	}

	Public function RequestService($sAPIPathURL, $sDefaultMethod, $DefaultAutheticated = false, $sPostString = "")
	{
		$bAuthenticate |= $this->_bForceAuthenticate |= $DefaultAutheticated;
	
		$this->_oGHS = new CGithubAPIRequester($sAPIPathURL, $sDefaultMethod, $this->_sResponseType, $bAuthenticate);

		$this->_oGHS->AssembleRequest($sPostString);
		
		$sResponse = $this->_oGHS->RequestService();
		
		unset($this->_oGHS);
		
		return $sResponse;
	}
}


?>