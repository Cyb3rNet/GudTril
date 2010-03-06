<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.repository.inc.php");

$sTitle = "Test Github Repository API classes";
$sFileName = "lib/github.api.repository.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = true;

$sUser = "Cyb3rNet";
$sRepo = "GudTril";


// START CGithubRepository GET TESTS
//
_printHTMLSubSectionHeader("GET Test");

//$oTCH = new CTestClassHelper("CGithubRepository", array($sResponseType, $bAuthenticate));

//$sSearchTerm = "";
//$oTCH->RegisterMethodWithReturn("SearchRepos", array($sSearchTerm));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ShowRepoInfo", array($sUser, $sRepo));

//$sUser
//$oTCH->RegisterMethodWithReturn("ShowUserRepos", array($sUser));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ListRepoNetwork", array($sUser, $sRepo));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ShowRepoLanguages", array($sUser, $sRepo));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ShowRepoTags", array($sUser, $sRepo));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ShowRepoBranches", array($sUser, $sRepo));


//$oTCH->RunTestMap();


//echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
//echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";
//
// END CGithubRepository GET TESTS


// START CGithubRepository POST TESTS
//
_printHTMLSubSectionHeader("POST Test");


$oTCH = new CTestClassHelper("CGithubRepository", array($sResponseType, $bAuthenticate));

//$sSearchTerm = "";
//$oTCH->RegisterMethodWithReturn("SearchRepos", array($sSearchTerm));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ShowRepoInfo", array($sUser, $sRepo));

//$sUser = "";
//$oTCH->RegisterMethodWithReturn("ShowUserRepos", array($sUser));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("WatchRepo", array($sUser, $sRepo));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("UnWatchRepo", array($sUser, $sRepo));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ForkRepo", array($sUser, $sRepo));

//$sRepoName = "TestREPOAPI";
//$sDescription = "Repo generated with API";
//$sHomepage = "";
//$iVisibility = CGithubRepositoryVisibility::iPublic;
//$oTCH->RegisterMethodWithReturn("CreateRepo", array($sRepoName, $sDescription, $sHomepage, $iVisibility));

$sRepo = "TestREPOAPI";
$oTCH->RegisterMethodWithReturn("DeleteRepo", array($sRepo));
$oTCH->RegisterMethodWithReturn("GetURL", array());
$oTCH->RegisterMethodWithReturn("GetPostString", array());

//$sRepo = "";
//$sDeleteToken = "";
//$oTCH->RegisterMethodWithReturn("ConfirmDeleteRepo", array($sRepo, $sDeleteToken));

//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("SetRepoPrivate", array($sRepo));

//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("SetRepoPublic", array($sRepo));

//$sRepo = "";
//$sTitle = "";
//$sKey = "";
//$oTCH->RegisterMethodWithReturn("AddRepoDeployKey", array($sRepo, $sTitle, $sKey));

//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("GetRepoDeployKeys", array($sRepo));

//$sRepo = "";
//$sKeyId = "";
//$oTCH->RegisterMethodWithReturn("RemoveRepoDeployKey", array($sRepo, $sKeyId));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ListRepoCollaborators", array($sUser, $sRepo));

//$sRepo = "";
//$sCollaborator = "";
//$oTCH->RegisterMethodWithReturn("AddRepoCollaborator", array($sRepo, $sCollaborator));

//$sRepo = "";
//$sCollaborator = "";
//$oTCH->RegisterMethodWithReturn("RemoveRepoCollaborator", array($sRepo, $sCollaborator));

//$sUser = "";
//$sRepo = "";
//$oTCH->RegisterMethodWithReturn("ListRepoNetwork", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoLanguages", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoTags", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoBranches", array($sUser, $sRepo));


$oTCH->RunTestMap();


echo "Number of API requests: ".CGithubAPICallLimitator::$_iCounter."<br />";
echo "Elapsed time since first request: ".CGithubAPICallLimitator::$_iElapsedTime."<br />";
//
// END CGithubRepository POST TESTS

?>