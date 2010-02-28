<?php


include("github.api.services.inc.php");


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
//// CLASS - GITHUB ISSUES API SERVICES
////
//   Class implementing the Github Issues API services
//
class CGithubIssues extends CGithubAPIRequestServices
{

	public function __constructor(CGithubResponseTypes $sResponseType, $bAuthenticate = false)
	{
		parent::__construct($sResponseType, $bAuthenticate);
	}

	
////
//// METHOD - SEARCH ISSUES
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
	public function SearchIssues($sUser, $sRepo, CGithubStateIssues $sState, $sSearchTerm)
	{
		$sAPIPathURL = "/issues/search/".$sUser."/".$sRepo."/".$sState."/".$sSearchTerm;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - PROJECT ISSUES LIST
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
	public function ListIssues($sUser, $sRepo, CGithubStateIssues $sState)
	{
		$sAPIPathURL = "/issues/list/".$sUser."/".$sRepo."/".$sState;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - VIEW ISSUE
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
	public function ViewIssue($sUser, $sRepo, $iNumber)
	{
		$this->_sAPIPathURL = "/issues/show/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - LIST ISSUE COMMENTS
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
	public function ListCommentsByIssue($sUser, $sRepo, $iNumber)
	{
		$sAPIPathURL = "/issues/comments/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - OPEN ISSUE
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
	public function OpenIssue($sUser, $sRepo, $sTitle, $sBody)
	{
		$sPost = "title=".$sTitle."&body=".$sBody;
		
		$sAPIPathURL = "/issues/open/".$sUser."/".$sRepo;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iPost;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $sPost);
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
	public function CloseIssue($sUser, $sRepo, $iNumber)
	{
		$sAPIPathURL = "/issues/close/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - REOPEN ISSUE
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
	public function ReOpenIssue($sUser, $sRepo, $iNumber)
	{
		$sAPIPathURL = "/issues/reopen/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - EDIT ISSUE
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
	public function EditIssue($sUser, $sRepo, $iNumber, $sTitle, $sBody)
	{
		$sPost = "title=".$sTitle."&body=".$sBody;
		
		$sAPIPathURL = "/issues/edit/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iPost;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $sPost);
	}


////
//// METHOD - LIST LABELS
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
	public function ListLabels($sUser, $sRepo)
	{
		$sAPIPathURL = "/issues/labels/".$sUser."/".$sRepo;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - ADD LABEL
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
	public function AddLabel($sUser, $sRepo, $sLabel, $iNumber)
	{
		$sAPIPathURL = "/issues/label/add/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - REMOVE LABEL
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
	public function RemoveLabel($sUser, $sRepo, $sLabel, $iNumber)
	{
		$sAPIPathURL = "/issues/label/remove/".$sUser."/".$sRepo."/".$sLabel."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iGet;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod);
	}


////
//// METHOD - COMMENT
////
//   Comment on Issues
//   /issues/comment/:user/:repo/:id
//   POST
//   Authenticated
/*

comment

*/
	public function CommentOnIssue($sUser, $sRepo, $iNumber, $sComment)
	{
		$sPost = "comment=".$sComment;
		
		$sAPIPathURL = "/issues/comment/".$sUser."/".$sRepo."/".$iNumber;
		
		$sDefaultMethod = CHTTPRequestMethodTypes::iPost;
		
		return $this->RequestService($sAPIPathURL, $sDefaultMethod, $sPost);
	}
}





?>