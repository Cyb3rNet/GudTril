<?php

include("github.connect.inc.php");

include("github.api.service.inc.php");


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
//   /issues/search/:user/:repo/:state/:search_term
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
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - PROJECT ISSUES LIST
////
//   List a Projects Issues
//   issues/list/:user/:repo/:state
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/list/".$sUser."/".$sRepo."/".$sState;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
	
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - VIEW ISSUE
////
//   View an Issue
//   issues/show/:user/:repo/:number
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/show/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();();
	}
}


////
//// CLASS - GITHUB ISSUES - LIST ISSUE COMMENTS
////
//   List an Issue’s Comments
//   issues/comments/:user/:repo/:number
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/comments/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - OPEN ISSUE
////
//   Open's an Issue
//   issues/open/:user/:repo
//   POST
//   Authenticated
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
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/open/".$sUser."/".$sRepo;
	}
	
	public function AssembleRequest()
	{
	
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
		
		parent::SetAuthentication();
		
		parent::SetPostString($this->_sPost);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - CLOSE ISSUE
////
//   Close's an Issue
//   issues/close/:user/:repo/:number
//   GET
//   Authenticated
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/close/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetAuthentication();
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - REOPEN ISSUE
////
//   Reopen's an Issue
//   issues/reopen/:user/:repo/:number
//   GET
//   Authenticated
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/reopen/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{

		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetAuthentication();
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - EDIT ISSUE
////
//   Edit Existing Issues
//   issues/edit/:user/:repo/:number
//   POST
//   Autheticated
//
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
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/edit/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
	
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
	
		parent::SetAuthentication();
	
		parent::SetPostString($this->_sPost);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - LIST LABELS
////
//   Listing Labels
//   issues/labels/:user/:repo
//   GET
//   Authenticated
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/labels/".$sUser."/".$sRepo;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetAuthentication();
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - ADD LABEL
////
//   Add Labels
//   issues/label/add/:user/:repo/:label/:number
//   GET
//   Authenticated
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/label/add/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetAuthentication();
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - REMOVE LABEL
////
//   Remove's Labels
//   issues/label/remove/:user/:repo/:label/:number
//   GET
//   Authenticated
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
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/label/remove/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iGet);
		
		parent::SetAuthentication();
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::SetAPIRequest($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


////
//// CLASS - GITHUB ISSUES - ADD LABEL
////
//   Comment on Issues
//   /issues/comment/:user/:repo/:id
//   POST
//   Authenticated
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
		
		$this->_sResponseType = $sResponseType;
		
		$this->_sAPIPathURL = "/issues/comment/".$sUser."/".$sRepo."/".$iNumber;
	}
	
	public function AssembleRequest()
	{
	
		parent::__construct(GITHUB_BASEURL, CHTTPRequestMethodTypes::iPost);
	
		parent::SetAuthentication();
	
		parent::SetPostString($this->_sPost);
		
		parent::SetResponseType($this->_sResponseType);
	
		parent::AppendAPIURL($this->_sAPIPathURL);
	}
	
	public function RequestService()
	{
		return parent::Connect();
	}
}


?>