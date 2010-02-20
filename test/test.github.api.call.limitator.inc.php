<?php

// INCLUDED VIA github.api.inc.php
//
//include("lib/github.api.call.limitator.inc.php");

$sTitle = "Test curl base classes";
$sFileName = "lib/github.api.call.limitator.inc.php";

_printTestFileHeader($sTitle, $sFileName);
////
//// CLASS - FOR SIMULATION OF USAGE
////
//
class CInheritanceTest extends CGithubAPICallLimitator
{
	public function __construct()
	{
		parent::__construct();
	}
}

////
//// CLASS - TEST CLASS FOR LIMITATOR
////
//
class CCTestLimitator
{
	public function __construct()
	{
		//
	}
	
	public function RunTest()
	{
		$iNow = time();
		$iStartTime = $iNow ;
		$iElapsed = $iNow - $iStartTime;
		
		while ($iElapsed < 30)
		{
			$o = new CInheritanceTest();
			
			echo $o->GetCounter()."<br />";
			echo $o->GetElapsedTime()."<br />";
			
			$iElapsed = $iNow - $iStartTime;
		}
	}
}

//// TEST

$oTCH = new CTestClassHelper("CCTestLimitator", array());

$oTCH->RegisterMethodNoReturn("RunTest", array());

$oTCH->RunTestMap();


?>