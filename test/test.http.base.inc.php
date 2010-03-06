<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/curl.inc.php");

$sTitle = "Test http base classes";
$sFileName = "lib/http.base.inc.php";

_printTestFileHeader($sTitle, $sFileName);

// START CHTTPBaseGet GET TEST
//
_printHTMLSubSectionHeader("GET Test");

$sURL = "http://gudtril.cyb3r.ca/test.html";

$oTCH = new CTestClassHelper("CHTTPBaseGet", array($sURL));

$oTCH->RegisterMethodNoReturn("PrepareOptions", array());

$oTCH->RegisterMethodWithReturn("Execute", array());

$oTCH->RunTestMap();
//
// END CHTTPBasePost GET TESTS


// START CHTTPBaseGet POST TESTS
//
_printHTMLSubSectionHeader("POST Test");

//$sURL = "http://gudtril.cyb3r.ca/test/utils/test.post.php";
//$sPost = "name=Cyb3r&project=GudTril&test=1";

//$oTCH = new CTestClassHelper("CHTTPBasePost", array($sURL));

//$oTCH->RegisterMethodNoReturn("PrepareOptions", array());

//$oTCH->RegisterMethodNoReturn("SetPostString", array($sPost));

//$oTCH->RegisterMethodWithReturn("Execute", array());

//$oTCH->RunTestMap();
//
// END CHTTPBasePost POST TESTS


?>