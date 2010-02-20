<?php

////
//// CLASS - GITHUB API CALL LIMITATOR
////
//   60 calls per minute max
//
class CGithubAPICallLimitator
{
	private static $_iCounter = 0;
	private static $_iStartTime = 0;

	public function __constructor()
	{
		$iCallLimit = 60;
		$iNow = time();
		
		if (self::$_iStartTime == 0)
		{
			self::$_iStartTime = time();
		}
		else if ($iNow - self::$_iStartTime < $iCallLimit && self::$_iCounter >= $iCallLimit)
		{
			exit(1);
		}
		else if ($iNow - self::$_iStartTime > $iCallLimit)
		{
			self::$_iCounter = 0;
			self::$_iStartTime = time();
		}

		self::$_iCounter++;
	}
}

?>