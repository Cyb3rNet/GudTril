<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.repository.inc.php");

$sTitle = "Test Github Repository API classes";
$sFileName = "lib/github.api.repository.inc.php";

_printTestFileHeader($sTitle, $sFileName);


$sResponseType = CGithubResponseTypes::sXML;
$bAuthenticate = true;

$sUser = "Cyb3rWeb";
$sRepo = "GudTril";


// TEST CGithubRepository - GET
_printHTMLSubSectionHeader("GET Test");


//$oTCH = new CTestClassHelper("CGithubRepository", array($sResponseType, $bAuthenticate));

//$sSearchTerm = "API";
//$oTCH->RegisterMethodWithReturn("SearchRepos", array($sSearchTerm));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoInfo", array($sUser, $sRepo));

//$sUser
//$oTCH->RegisterMethodWithReturn("ShowUserRepos", array($sUser));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ListRepoNetwork", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoLanguages", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoTags", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoBranches", array($sUser, $sRepo));


//$oTCH->RunTestMap();




// TEST CGithubRepository - POST
_printHTMLSubSectionHeader("POST Test");


$oTCH = new CTestClassHelper("CGithubRepository", array($sResponseType, $bAuthenticate));

//$sSearchTerm = "jQuery";
//$oTCH->RegisterMethodWithReturn("SearchRepos", array($sSearchTerm));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoInfo", array($sUser, $sRepo));

//$sUser
//$oTCH->RegisterMethodWithReturn("ShowUserRepos", array($sUser));

//$sUser = "toutix";
//$sRepo = "WebFW";
//$oTCH->RegisterMethodWithReturn("WatchRepo", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("UnWatchRepo", array($sUser, $sRepo));

//$sUser = "toutix";
//$sRepo = "git-close";
//$oTCH->RegisterMethodWithReturn("ForkRepo", array($sUser, $sRepo));

//$sRepoName = "Test-REPO-API";
//$sDescription = "Repo generated with API";
//$sHomepage = "";
//$iVisibility = CGithubRepositoryVisibility::iPublic;
//$oTCH->RegisterMethodWithReturn("CreateRepo", array($sRepoName, $sDescription, $sHomepage, $iVisibility));

// TRY DELETE AFTER

//$sRepo = "git-close";
//$oTCH->RegisterMethodWithReturn("DeleteRepo", array($sRepo));
//$oTCH->RegisterMethodWithReturn("GetURL", array());

//$sRepo, $sDeleteToken
//$oTCH->RegisterMethodWithReturn("ConfirmDeleteRepo", array($sRepo, $sDeleteToken));

//$sRepo = "Pydj";
//$oTCH->RegisterMethodWithReturn("SetRepoPrivate", array($sRepo));

//$sRepo = "PHPWebLib";
//$oTCH->RegisterMethodWithReturn("SetRepoPublic", array($sRepo));

$sRepo = "GudTril";
$sTitle = "test key";
$sKey = "ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEA/Lvj9u03CPiLfJnB0JiNsSRs+ZWUcxn7T07lh1Z+Iej39FQfN1lnmqtgrxIX8gvsHizGL0Zv6E4KV2sC5YPxu+jwQQPSW181Asp0plfk9Md8dvXfSbdCQTUzXlZTZeZz/DEr9csUTHJMqWND3Pp0RLxE5V8ue+gq0fUz1OEDIAzA8B3yIxf43nn4xKuEqA0U33/m8OVMkbAcWV5MzyQYcdH0u1Er+tFPVPcP54mVOAP2APkltQiUYeLEaZ3LtW/iVHoyXo0YeSjaW1AWXgHA1mzMfx62zkRbwFNjylP6vCCTIdve9VQ8by9jRLJOqIQI2kwk4rxzLCi/PxP/M2huPQ== toutix@junior-upzwacdv";
$oTCH->RegisterMethodWithReturn("AddRepoDeployKey", array($sRepo, $sTitle, $sKey));

//$sRepo = "GudTril";
//$oTCH->RegisterMethodWithReturn("GetRepoDeployKeys", array($sRepo));

// DELETE ADDED KEY AFTER
//$sRepo = "GudTril";
//$sKeyId = "266124";
//$oTCH->RegisterMethodWithReturn("RemoveRepoDeployKey", array($sRepo, $sKeyId));

//$sUser = "asantos";
//$sRepo = "master";
//$oTCH->RegisterMethodWithReturn("ListRepoCollaborators", array($sUser, $sRepo));

//$sRepo = "GudTril";
//$sCollaborator = "toutix";
//$oTCH->RegisterMethodWithReturn("AddRepoCollaborator", array($sRepo, $sCollaborator));

//$sRepo = "Pydj";
//$sCollaborator = "toutix";
//$oTCH->RegisterMethodWithReturn("RemoveRepoCollaborator", array($sRepo, $sCollaborator));

//$sUser = "Cyb3rWeb";
//$sRepo = "GudTril";
//$oTCH->RegisterMethodWithReturn("ListRepoNetwork", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoLanguages", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoTags", array($sUser, $sRepo));

//$sUser, $sRepo
//$oTCH->RegisterMethodWithReturn("ShowRepoBranches", array($sUser, $sRepo));


$oTCH->RunTestMap();


?>