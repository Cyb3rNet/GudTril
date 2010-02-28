<?php


// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.object.inc.php");

$sTitle = "Test Github Object API classes";
$sFileName = "lib/github.api.object.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = false;


$sUser = "Cyb3rWeb";
$sRepoName = "GudTril";


// TEST CGithubObject - GET
_printHTMLSubSectionHeader("GET Test");


$oTCH = new CTestClassHelper("CGithubObject", array($sResponseType, $bAuthenticate));

$sTreeSHA = "7713cdad2d88f434d1302145193127905a92be42";
$oTCH->RegisterMethodWithReturn("ShowTree", array($sUser, $sRepoName, $sTreeSHA));


//$oTCH->RegisterMethodWithReturn("GetURL", array());

$sTreeSHA = "f691d1833468afa33af8078a421d09b275eb339b";
$sPath = "lib/http.requester.inc.php";
$oTCH->RegisterMethodWithReturn("BlobByTreeSHA", array($sUser, $sRepoName, $sTreeSHA, $sPath));

$sTreeSHA = "2734e62d8efb7abe79fc6e4be05740b747f6d327";
$oTCH->RegisterMethodWithReturn("ListBlobs", array($sUser, $sRepoName, $sTreeSHA));

$sSHA = "f691d1833468afa33af8078a421d09b275eb339b";
$oTCH->RegisterMethodWithReturn("ShowBlob", array($sUser, $sRepoName, $sSHA));


$oTCH->RunTestMap();


// TEST CGithubObject - POST
_printHTMLSubSectionHeader("POST Test");


$oTCH = new CTestClassHelper("CGithubObject", array($sResponseType, $bAuthenticate));

$sTreeSHA = "7713cdad2d88f434d1302145193127905a92be42";
$oTCH->RegisterMethodWithReturn("ShowTree", array($sUser, $sRepoName, $sTreeSHA));

$sTreeSHA = "577d65ad91840cb5fdf70f5b8f20d8e67fc13ea6";
$sPath = "lib/github.connect.inc.php";
$oTCH->RegisterMethodWithReturn("BlobByTreeSHA", array($sUser, $sRepoName, $sTreeSHA, $sPath));

$sTreeSHA = "d76f045fe37c481c9add0aa16df9bc9cee2d812a";
$oTCH->RegisterMethodWithReturn("ListBlobs", array($sUser, $sRepoName, $sTreeSHA));

$sSHA = "2734e62d8efb7abe79fc6e4be05740b747f6d327";
$oTCH->RegisterMethodWithReturn("ShowBlob", array($sUser, $sRepoName, $sSHA));

$oTCH->RunTestMap();


?>