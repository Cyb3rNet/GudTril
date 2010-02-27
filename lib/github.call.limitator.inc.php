<?php


////
//// CLASS - LIMIT EXCEPTION
////
//
class LimitException extends Exception
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
	private static $_iCounter = 0;
	private static $_iStartTime = 0;
	private static $_iElapsedTime = 0;

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
			throws new LimitException("Exceeded limit requests (".$iCallLimit." per minute)");
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