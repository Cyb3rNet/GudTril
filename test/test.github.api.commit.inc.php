<?php


// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.commit.inc.php");

$sTitle = "Test Github Commit API classes";
$sFileName = "lib/github.api.commit.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = false;


$sUser = "Cyb3rNet";
$sRepoName = "GudTril";


// TEST CGithubCommit - GET
_printHTMLSubSectionHeader("GET Test");


$oTCH = new CTestClassHelper("CGithubCommit", array($sResponseType, $bAuthenticate));

$sBranch = "0.3.1";
$oTCH->RegisterMethodWithReturn("ListOnBranch", array($sUser, $sRepoName, $sBranch));

$oTCH->RegisterMethodWithReturn("GetURL", array());

$sBranch = "0.3.1";
$sFilePath = "lib/curl.inc.php";
$oTCH->RegisterMethodWithReturn("ListOnFile", array($sUser, $sRepoName, $sBranch, $sFilePath));

$sSHA = "f2ace7d6083881331e93732a1ace801e5e870225";
$oTCH->RegisterMethodWithReturn("ShowSpecific", array($sUser, $sRepoName, $sSHA));


$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";


// TEST CGithubCommit - POST
_printHTMLSubSectionHeader("POST Test");


$oTCH = new CTestClassHelper("CGithubCommit", array($sResponseType, $bAuthenticate));

$sBranch = "0.4.1";
$oTCH->RegisterMethodWithReturn("ListOnBranch", array($sUser, $sRepoName, $sBranch));

$sBranch = "0.4.1";
$sFilePath = "lib/github.api.repositories.inc.php";
$oTCH->RegisterMethodWithReturn("ListOnFile", array($sUser, $sRepoName, $sBranch, $sFilePath));

$sSHA = "e5f495e7b5c028743b98a1e6f042a29d1fed901f";
$oTCH->RegisterMethodWithReturn("ShowSpecific", array($sUser, $sRepoName, $sSHA));


$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";


?>