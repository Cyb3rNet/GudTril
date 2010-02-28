<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/http.requester.inc.php");

$sTitle = "Test HTTP requester classe";
$sFileName = "lib/http.requester.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CHTTPRequest - GET

_printHTMLSectionHeader("GET Test");

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.get.html";

$oTCH = new CTestClassHelper("CHTTPRequester", array($sURL, CHTTPRequestMethods::iGet));

$oTCH->RegisterMethodWithReturn("Request", array());

$oTCH->RunTestMap();

// TEST CHTTPRequest - POST

_printHTMLSectionHeader("POST Test");

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.post.php";
$sPostString = "name=Cyb3r&project=GudTril&test=1";

$oTCH = new CTestClassHelper("CHTTPRequester", array($sURL, CHTTPRequestMethods::iPost, $sPostString));

$oTCH->RegisterMethodWithReturn("Request", array());

$oTCH->RunTestMap();

?>