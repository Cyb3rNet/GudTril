<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/curl.inc.php");

$sTitle = "Test curl base classes";
$sFileName = "lib/curl.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// TEST CCurlBaseGet

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.get.html";

$oTCH = new CTestClassHelper("CCurlBaseGet", array($sURL));

$oTCH->RegisterMethodNoReturn("PrepareOptions", array());

$oTCH->RegisterMethodWithReturn("Execute", array());

$oTCH->RunTestMap();

// TEST CCurlBasePost

$sURL = "http://gudtril.cyb3r.ca/test/utils/test.post.php";
$sPost = "name=Cyb3r&project=GudTril&test=1";

$oTCH = new CTestClassHelper("CCurlBasePost", array($sURL));

$oTCH->RegisterMethodNoReturn("PrepareOptions", array());

$oTCH->RegisterMethodNoReturn("SetPostString", array($sPost));

$oTCH->RegisterMethodWithReturn("Execute", array());

$oTCH->RunTestMap();

?>