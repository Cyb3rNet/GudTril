<?php


////
//// CLASS - LIMIT EXCEPTION
////
//
class GitHubLimitException extends Exception
{
	public function __construct($sMsg)
	{
		parent::__construct($sMsg);
	}
}


////
//// CLASS - GITHUB API CALL LIMITATOR
////
//   60 calls per minute max
//
class CGithubAPICallLimitator
{
	// rendered public for testing
	public static $_iCounter = 0;
	public static $_iStartTime = 0;
	public static $_iElapsedTime = 0;

	const iSecondsPerMinute = 60;
	
	public function __construct()
	{
		$iCallLimit = GITHUB_API_CALL_LIMIT;
		$iNow = time();
		
		if (self::$_iStartTime == 0)
		{
			self::$_iStartTime = time();
		}
		else if
		(
			(
				$iNow - self::$_iStartTime < $iCallLimit
				&&
				self::$_iCounter >= $iCallLimit
			)
			||
			self::$_iCounter >= $iCallLimit
		)
		{
			throw new GitHubLimitException("Exceeded limit requests (".$iCallLimit." per minute)");
		}
		else if ($iNow - self::$_iStartTime > self::iSecondsPerMinute)
		{
			self::$_iCounter = 0;
			self::$_iStartTime = time();
		}

		self::$_iCounter++;
		self::$_iElapsedTime = $iNow - self::$_iStartTime;
	}
	
	public function GetCounter()
	{
		return self::$_iCounter;
	}
	
	public function GetElapsedTime()
	{
		return self::$_iElapsedTime;
	}
}

?>