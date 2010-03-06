<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.issues.inc.php");

$sTitle = "Test Github Issues API classes";
$sFileName = "lib/github.api.issues.inc.php";

_printTestFileHeader($sTitle, $sFileName);


// TEST CGithubIssues - GET
_printHTMLSubSectionHeader("GET Test");


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = true;

$sUser = "Cyb3rNet";
$sRepo = "GudTril";


$oTCH = new CTestClassHelper("CGithubIssues", array($sResponseType, $bAuthenticate));

$sState = CGithubIssueStates::sOpen;
$sSearchTerm = "opening test";
$oTCH->RegisterMethodWithReturn("SearchIssues", array($sUser, $sRepo, $sState, $sSearchTerm));

$sState = CGithubIssueStates::sOpen;
$oTCH->RegisterMethodWithReturn("ListIssues", array($sUser, $sRepo, $sState));

//$iNumber = 1;
//$oTCH->RegisterMethodWithReturn("ViewIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 5;
//$oTCH->RegisterMethodWithReturn("ListCommentsByIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 8;
//$oTCH->RegisterMethodWithReturn("CloseIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 4;
//$oTCH->RegisterMethodWithReturn("ReOpenIssue", array($sUser, $sRepo, $iNumber));


//$oTCH->RegisterMethodWithReturn("ListLabels", array($sUser, $sRepo));

//$sLabel = "Label2";
//$iNumber = "2";
//$oTCH->RegisterMethodWithReturn("AddLabel", array($sUser, $sRepo, $sLabel, $iNumber));

//$sLabel = "Label1";
//$iNumber = "1";
//$oTCH->RegisterMethodWithReturn("RemoveLabel", array($sUser, $sRepo, $sLabel, $iNumber));


$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";


// TEST CGithubAPIRequester - POST
_printHTMLSubSectionHeader("GET Test");


$oTCH = new CTestClassHelper("CGithubIssues", array($sResponseType, $bAuthenticate));

//$sState = CGithubIssueStates::sClosed;
//$sSearchTerm = "opening";
//$oTCH->RegisterMethodWithReturn("SearchIssues", array($sUser, $sRepo, $sState, $sSearchTerm));

$sState = CGithubIssueStates::sOpen;
$oTCH->RegisterMethodWithReturn("ListIssues", array($sUser, $sRepo, $sState));

//$iNumber = 2;
//$oTCH->RegisterMethodWithReturn("ViewIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 5;
//$oTCH->RegisterMethodWithReturn("ListCommentsByIssue", array($sUser, $sRepo, $iNumber));

$sTitle = "Test open issue Title";
$sBody = "Test open issue Body";
$oTCH->RegisterMethodWithReturn("OpenIssue", array($sUser, $sRepo, $sTitle, $sBody));

//$iNumber = 10;
//$oTCH->RegisterMethodWithReturn("CloseIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 6;
//$oTCH->RegisterMethodWithReturn("ReOpenIssue", array($sUser, $sRepo, $iNumber));

//$iNumber = 7;
//$sTitle = "Editing test";
//$sBody = "TestEditingTestEditingTestEditingTestEditingTestEditing";
//$oTCH->RegisterMethodWithReturn("EditIssue", array($sUser, $sRepo, $iNumber, $sTitle, $sBody));


$oTCH->RegisterMethodWithReturn("ListLabels", array($sUser, $sRepo));

//$sLabel = "Label12";
//$iNumber = 12;
//$oTCH->RegisterMethodWithReturn("AddLabel", array($sUser, $sRepo, $sLabel, $iNumber));

//$sLabel = "Label3";
//$iNumber = "3";
//$oTCH->RegisterMethodWithReturn("RemoveLabel", array($sUser, $sRepo, $sLabel, $iNumber));

//$iNumber = 12;
//$sComment = "Test Comment";
//$oTCH->RegisterMethodWithReturn("CommentOnIssue", array($sUser, $sRepo, $iNumber, $sComment));


//$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";


?>