<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/http.requester.inc.php");

$sTitle = "Test HTTP requester classe";
$sFileName = "lib/http.requester.inc.php";

_printTestFileHeader($sTitle, $sFileName);

//
//
// TEST CHTTPRequest - GET
_printHTMLSectionHeader("GET Test");

$sURL = "";

$oTCH = new CTestClassHelper("CHTTPRequester", array($sURL, CHTTPRequestMethods::iGet));

$oTCH->RegisterMethodWithReturn("Request", array());

$oTCH->RunTestMap();


//
//
// TEST CHTTPRequest - POST

_printHTMLSectionHeader("POST Test");

$sURL = "";
$sPostString = "";

$oTCH = new CTestClassHelper("CHTTPRequester", array($sURL, CHTTPRequestMethods::iPost, $sPostString));

$oTCH->RegisterMethodWithReturn("Request", array());

$oTCH->RunTestMap();

?>