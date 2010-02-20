<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.connect.inc.php");

$sTitle = "Test Github connection classes";
$sFileName = "lib/github.connect.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CGithubConnect - GET

_printHTMLSubSectionHeader("GET Test");

$sBaseURL = "http://gudtril.cyb3r.ca/test/utils";

$sResponseType = "/".CGithubResponseTypes::sXML;

$sAPIRequest = "/hello_world";

$oTCH = new CTestClassHelper("CGithubConnect", array($sBaseURL, CHTTPRequestMethods::iGet));

$oTCH->RegisterMethodNoReturn("SetResponseType", array($sResponseType));

$oTCH->RegisterMethodNoReturn("SetAPIRequest", array($sAPIRequest));

$oTCH->RegisterMethodWithReturn("GetURL", array());

$oTCH->RegisterMethodWithReturn("Connect", array());

$oTCH->RunTestMap();


// TEST CGithubConnect - POST

_printHTMLSubSectionHeader("POST Test");

$sBaseURL = "http://gudtril.cyb3r.ca";

$sResponseType = "/test/utils";

$sAPIRequest = "/test.post.php";

$sPostString = "name=Cyb3r&project=GudTril&test=1";

$oTCH = new CTestClassHelper("CGithubConnect", array($sBaseURL, CHTTPRequestMethods::iPost));

$oTCH->RegisterMethodNoReturn("SetResponseType", array($sResponseType));

$oTCH->RegisterMethodNoReturn("SetAPIRequest", array($sAPIRequest));

$oTCH->RegisterMethodNoReturn("SetPostString", array($sPostString));

$oTCH->RegisterMethodWithReturn("GetURL", array());

$oTCH->RegisterMethodWithReturn("Connect", array());

$oTCH->RunTestMap();

?>