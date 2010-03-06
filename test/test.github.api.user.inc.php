<?php


// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.commit.inc.php");

$sTitle = "Test Github Users API classes";
$sFileName = "lib/github.api.user.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = false;


$sUser = "Cyb3rNet";
$sRepoName = "GudTril";


// START CGithubUsers GET TESTS
//
_printHTMLSubSectionHeader("GET Test");


//$oTCH = new CTestClassHelper("CGithubUser", array($sResponseType, $bAuthenticate));

//$sSearch = "";
//$oTCH->RegisterMethodWithReturn("SearchUsers", array($sSearch));

//$sUser = "";
//$oTCH->RegisterMethodWithReturn("GetUserInfo", array($sUser));


//$oTCH->RegisterMethodWithReturn("GetURL", array());

//$sUser = "";
//$oTCH->RegisterMethodWithReturn("ShowWhoUserFollowing", array($sUser));

//$sUser = "";
//$oTCH->RegisterMethodWithReturn("ShowWhoUserFollowers", array($sUser));

//$sUser = "";
//$oTCH->RegisterMethodWithReturn("ShowWatchedRepos", array($sUser));


//$oTCH->RunTestMap();


//echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
//echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";
//
// END CGithubUsers GET TESTS


// START CGithubUsers POST TESTS
//
_printHTMLSubSectionHeader("POST Test");


$oTCH = new CTestClassHelper("CGithubUser", array($sResponseType, $bAuthenticate));

//$sSearch = "pete";
//$oTCH->RegisterMethodWithReturn("SearchUsers", array($sSearch));

//$sUser = "Cyb3rWeb";
//$oTCH->RegisterMethodWithReturn("GetUserInfo", array($sUser));

$sUser = "Cyb3rNet";
$sName = "Serafim Junior Dos Santos - Test";
//$sName = "";
$sEmail = "";
$sBlog = "http://www.cyb3r.ca/test";
//$sCompany = "Serafim Junior Dos Santos Fagundes Cyb3r Web - Test";
$sCompany = "";
//$sLocation = "Montréal, Québec, Canada";
$sLocation = "";
$oTCH->RegisterMethodWithReturn("SetUserInfo", array($sUser, $sName, $sEmail, $sBlog, $sCompany, $sLocation));


$oTCH->RegisterMethodWithReturn("IsAuthenticated", array());

//$sUser = "toutix";
//$oTCH->RegisterMethodWithReturn("FollowUser", array($sUser));

//$sUser = "Cyb3rWeb";
//$oTCH->RegisterMethodWithReturn("ShowWhoUserFollowing", array($sUser));

//$sUser = "Cyb3rWeb";
//$oTCH->RegisterMethodWithReturn("ShowWhoUserFollowers", array($sUser));

//$sUser = "toutix";
//$oTCH->RegisterMethodWithReturn("UnFollowUser", array($sUser));


//$oTCH->RegisterMethodWithReturn("ShowWatchedRepos", array($sUser));


//$oTCH->RegisterMethodWithReturn("GetPublicKeys", array());

//$sKeyName = "Test key";
//$sKey = "ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEA/Lvj9u03CPiLfJnB0JiNsSRs+ZWUcxn7T07lh1Z+Iej39FQfN1lnmqtgrxIX8gvsHizGL0Zv6E4KV2sC5YPxu+jwQQPSW181Asp0plfk9Md8dvXfSbdCQTUzXlZTZeZz/DEr9csUTHJMqWND3Pp0RLxE5V8ue+gq0fUz1OEDIAzA8B3yIxf43nn4xKuEqA0U33/m8OVMkbAcWV5MzyQYcdH0u1Er+tFPVPcP54mVOAP2APkltQiUYeLEaZ3LtW/iVHoyXo0YeSjaW1AWXgHA1mzMfx62zkRbwFNjylP6vCCTIdve9VQ8by9jRLJOqIQI2kwk4rxzLCi/PxP/M2huPQ== toutix@junior-upzwacdv";
//$oTCH->RegisterMethodWithReturn("AddPublicKey", array($sKeyName, $sKey));


//$oTCH->RegisterMethodWithReturn("GetPostString", array());


//$sKeyId = "266373";
//$oTCH->RegisterMethodWithReturn("RemovePublicKey", array($sKeyId));


//$oTCH->RegisterMethodWithReturn("GetEmails", array());


//$oTCH->RegisterMethodWithReturn("AddEmail", array($sEmail));


//$oTCH->RegisterMethodWithReturn("GetPostString", array());


//$oTCH->RegisterMethodWithReturn("RemoveEmail", array($sEmail));


$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";
//
// END CGithubUsers GET TESTS


?>