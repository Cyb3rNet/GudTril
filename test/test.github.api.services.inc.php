<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.issues.inc.php");

$sTitle = "Test Github Services API classes";
$sFileName = "lib/github.api.services.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CGithubAPIRequester - GET

$sUser = "Cyb3rNet";
$sRepo = "GudTril";
$sState = CGithubIssueStates::sOpen;

_printHTMLSubSectionHeader("GET Test");

$sResponseType = CGithubResponseTypes::sXML;

$sAPIRequest = "/issues/list/".$sUser."/".$sRepo."/".$sState;

$oTCH = new CTestClassHelper("CGithubAPIRequester", array($sAPIRequest, CHTTPRequestMethods::iGet, $sResponseType, true));

$oTCH->RegisterMethodNoReturn("AssembleRequest", array());

$oTCH->RegisterMethodWithReturn("GetURL", array());

$oTCH->RegisterMethodWithReturn("RequestService", array());

$oTCH->RunTestMap();


// TEST CGithubAPIRequester - POST

$sTitle = "Testing API opening issue";
$sBody = rand(0, time());

_printHTMLSubSectionHeader("POST Test");

$sResponseType = CGithubResponseTypes::sJSON;

$sAPIRequest = "/issues/open/".$sUser."/".$sRepo;

$sPostString = "title=".$sTitle."&body=".$sBody;

$oTCH = new CTestClassHelper("CGithubAPIRequester", array($sAPIRequest, CHTTPRequestMethods::iPost, $sResponseType, true));

$oTCH->RegisterMethodNoReturn("AssembleRequest", array($sPostString));

$oTCH->RegisterMethodWithReturn("GetURL", array());

$oTCH->RegisterMethodWithReturn("RequestService", array());

$oTCH->RunTestMap();

$sTitle = "Test Github Services API classes";
$sFileName = "lib/github.api.services.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CGithubAPIRequestServices - GET

$sUser = "Cyb3rNet";
$sRepo = "GudTril";
$bForceAuthenticate = true;

_printHTMLSubSectionHeader("GET Test");

$sResponseType = CGithubResponseTypes::sXML;

$sAPIRequest = "/issues/labels/".$sUser."/".$sRepo;

$oTCH = new CTestClassHelper("CGithubAPIRequestServices", array($sResponseType, $bForceAuthenticate));

$oTCH->RegisterMethodWithReturn("RequestService", array($sAPIRequest, CHTTPRequestMethods::iGet, false));

$oTCH->RunTestMap();


// TEST CGithubAPIRequestServices - POST

$sComment = rand(0, time());
$iNumber = 6;
$bForceAuthenticate = true;

_printHTMLSubSectionHeader("POST Test");

$sResponseType = CGithubResponseTypes::sYAML;

$sAPIRequest = "/issues/comment/".$sUser."/".$sRepo."/".$iNumber;

$sPostString = "comment=".$sComment;

$oTCH = new CTestClassHelper("CGithubAPIRequestServices", array($sResponseType, $bForceAuthenticate));

$oTCH->RegisterMethodWithReturn("RequestService", array($sAPIRequest, CHTTPRequestMethods::iPost, false, $sPostString));

$oTCH->RunTestMap();

?>