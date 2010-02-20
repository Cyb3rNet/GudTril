<?php

include("github.connect.inc.php");

//// INTERFACE - GITHUB API SERVICE
//
interface IGithubAPIService
{
	public function AssembleRequest();
	public function RequestService();
}


////
//// CLASS - GITHUB STATE ISSUES
////
//
class CGithubIssueStates
{
	const sOpen = 'open';
	const sClosed = 'closed';
}


////
//// CLASS - GITHUB ISSUES - SEARCH ISSUES
////
//   Search Issues
//   GET
//
//   Returns:
/*

{
  "issues": [
    {
      "user": 		"kfl",
      "updated_at": "2009\/04\/20 03:34:48 -0700",
      "votes": 		3,
      "number": 	102,
      "title": 		"Pressing question-mark does not show help",
      "body": 		"Pressing the '?'-key does not open the help lightbox.\r\n\r\nHowever, at least the 'j', 'k', and 'c' works (the only ones I've tested).\r\n\r\n* **OS:** Linux, ubuntu 8.04.1\r\n* **Browser:** Firefox 3.08",
      "state": 		"open",
      "created_at": "2009\/04\/17 12:57:52 -0700"
    }
  ]
}

*/
class CGithubIssuesSearch extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, CGithubStateIssues $sState, $sSearchTerm)
	{
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/search/".$sUser."/".$sRepo."/".$sState."/".$sSearchTerm;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return $this->Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - PROJECT ISSUES LIST
////
//   List a Projects Issues
//   GET
//
//   Returns:
/*

issues: 
- number: 1
  votes: 0
  created_at: 2009-04-17 14:55:33 -07:00
  body: my sweet, sweet issue
  title: new issue
  updated_at: 2009-04-17 14:55:33 -07:00
  user: schacon
  state: open
- number: 2
  votes: 0
  created_at: 2009-04-17 15:16:47 -07:00
  body: the body of a second issue
  title: another issue
  updated_at: 2009-04-17 15:16:47 -07:00
  user: schacon
  state: open

*/
class CGithubIssuesProjectList extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, CGithubStateIssues $sState)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/list/".$sUser."/".$sRepo."/".$sState;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - VIEW ISSUE
////
//   View an Issue
//   GET
//
//   Returns:
/*

issue: 
  number: 1
  votes: 0
  created_at: 2009-04-17 14:55:33 -07:00
  body: my sweet, sweet issue
  title: new issue
  updated_at: 2009-04-17 14:55:33 -07:00
  user: schacon
  state: open

*/
class CGithubIssuesView extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/show/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - LIST ISSUE COMMENTS
////
//   List an Issue’s Comments
//   GET
//
//   Returns:
/*

comments: 
- created_at: 2010-02-08 12:54:54 -08:00
  body: this is a really great idea
  updated_at: 2010-02-08 12:54:54 -08:00
  id: 1
  user: defunkt
- created_at: 2010-02-08 12:55:05 -08:00
  body: is it?
  updated_at: 2010-02-08 12:55:05 -08:00
  id: 2
  user: schacon

*/
class CGithubIssuesListComments extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/comments/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - OPEN ISSUE
////
//   Open's an Issue
//   POST
/*

title
body

*/
//
//   Returns:
/*

issue: 
  user: schacon
  body: my ticket
  title: new
  number: 1
  votes: 0
  state: open
  
*/
class CGithubIssuesOpen extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	private $_sPost;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $sTitle, $sBody)
	{
		$this->_sPost = "title=".$sTitle."&body=".$sBody;
	
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/open/".$sUser."/".$sRepo;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
		
		$oGithubRequest->SetPost($this->_sPost);
		
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - CLOSE ISSUE
////
//   Close's an Issue
//   GET
//
//   Returns:
/*

issue: 
  user: schacon
  body: 
  title: new
  number: 1
  votes: 0
  state: closed

*/
class CGithubIssuesClose extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/close/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - REOPEN ISSUE
////
//   Reopen's an Issue
//   GET
//
//   Returns:
/*

issue: 
  user: schacon
  body: 
  title: new
  number: 1
  votes: 0
  state: open
  
*/
class CGithubIssuesReopen extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/reopen/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - EDIT ISSUE
////
//   Edit Existing Issues
//   POST
//
//   HAS TO BE: AUTHENTICATED
//   HAS TO BE: COLLABORATOR
/*

title
body
  
*/
class CGithubIssuesEdit extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	private $_sPost;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber, $sTitle, $sBody)
	{
		$this->_sPost = "title=".$sTitle."&body=".$sBody;
	
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/edit/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
	
		$oGithubRequest->SetPost($this->_sPost);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - LIST LABELS
////
//   Listing Labels
//
//   Returns:
/*

labels:
- label1
- label2
  
*/
class CGithubIssuesListLabels extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/labels/".$sUser."/".$sRepo;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - ADD LABEL
////
//   Add Labels
//
//   Returns:
/*

labels: 
- testing
- test_label
  
*/
class CGithubIssuesAddLabel extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $sLabel, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/label/add/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - REMOVE LABEL
////
//   Remove's Labels
//
//   Returns:
/*

labels: 
- testing
- test_label
  
*/
class CGithubIssuesRemoveLabel extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $sLabel, $iNumber)
	{
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/label/remove/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


////
//// CLASS - GITHUB ISSUES - ADD LABEL
////
//   Comment on Issues
//   POST
/*

comment

*/
class CGithubIssuesComment extends CGithubConnect implements IGithubAPIService
{
	private $_sResponseType;
	private $_sAPIPathURL;
	
	private $_sPost;
	
	public function __construct(CGithubResponseTypes $sResponseType, $sUser, $sRepo, $iNumber, $sComment)
	{
		$this->_sPost = "comment=".$sComment;
	
		parent::__construct();
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/comment/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		$oGithubRequest = new CGithubRequest(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
	
		$oGithubRequest->SetPost($this->_sPost);
	
		$this->SetRequest($oGithubRequest);
		
		$this->SetResponseType($this->_sResponseType);
	
		$this->AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		$this->MakeRequest();
		
		return $this->GetResponse();
	}
}


?>