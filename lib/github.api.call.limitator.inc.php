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
		$iNow = time();
		
		if (self::$_iStartTime == 0)
		{
			self::$_iStartTime = time();
		}
		else if ($iNow - self::$_iStartTime < 60 && self::$_iCounter >= 60)
		{
			$iSleep = 60 - ($iNow - self::$_iStartTime);
			
			if ($iSleep > 0)
				sleep($iSleep);
		}
		else if ($iNow - self::$_iStartTime > 60)
		{
			self::$_iCounter = 0;
			self::$_iStartTime = time();
		}

		self::$_iCounter++;
	}
}

?>