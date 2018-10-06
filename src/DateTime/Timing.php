<?php


namespace EMedia\PHPHelpers\DateTime;

use \Carbon\Carbon;

class Timing
{

	/**
	 * Get the micro-timestamp of current time
	 *
	 * @return string
	 */
	public static function microTimestamp()
	{
		// get microtime of file generation to preserve migration sequence
		$time = explode(" ", microtime());

		// change the format to 2008_07_14_010813.98232
		return date("Y_m_d_His", $time[1]) . '.' . substr((string)$time[0], 2, 5);
	}


	/**
	 * Convert an incoming string to a database compatible time format
	 *
	 * @param $string
	 *
	 * @return bool|string
	 */
	public static function convertToDbTime($string)
	{
		return date('Y-m-d H:i:s', strtotime(trim($string)));
	}

	/**
	 *
	 * Convert a UTC time-string to the applications timezone.
	 * Useful to convert JavaScript date strings to Carbon dates.
	 *
	 * @param $UTCTimeString
	 *
	 * @return Carbon
	 */
	public static function toServerTimezone($UTCTimeString, $onlyDate = false)
	{
		// convert the UTC date sent by client to our format
		$reportDate = new \Carbon\Carbon($UTCTimeString);
		$reportDate->setTimezone(config('app.timezone', 'UTC'));
		if ($onlyDate) $reportDate->startOfDay();
		return $reportDate;
	}

	public static function toUTCTimezone($serverTimeString)
	{
		$serverTime = new \Carbon\Carbon($serverTimeString);
		$serverTime->setTimezone('UTC');
		return $serverTime;
	}

}