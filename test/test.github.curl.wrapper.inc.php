<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.curl.wrapper.inc.php");

$sTitle = "Test Github curl wrapper classes";
$sFileName = "lib/github.curl.wrapper.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CGithubCurlWrapper - GET

_printHTMLSubSectionHeader("GET Test");

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.get.html";

$oHTTPRequest = new CHTTPRequest($sURL, CHTTPRequestMethodTypes::iGet);

$oTCH = new CTestClassHelper("CGithubCurlWrapper", array($oHTTPRequest));

$oTCH->RegisterMethodWithReturn("Connect", array());

$oTCH->RunTestMap();

// TEST CGithubCurlWrapper - POST

_printHTMLSubSectionHeader("POST Test");

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.post.php";
$sPost = "name=Cyb3r&project=GudTril&test=1";

$oHTTPRequest = new CHTTPRequest($sURL, CHTTPRequestMethodTypes::iPost);

$oHTTPRequest->SetPost($sPost);

$oTCH = new CTestClassHelper("CGithubCurlWrapper", array($oHTTPRequest));

$oTCH->RegisterMethodWithReturn("Connect", array());

$oTCH->RunTestMap();

?>