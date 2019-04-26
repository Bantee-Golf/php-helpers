<?php


namespace EMedia\PHPHelpers\Util;


class Arr
{


	/**
	 *
	 * Is the array an associative array?
	 *
	 * @param array $arr
	 *
	 * @return bool
	 */
	public static function isAssocArray(array $arr)
	{
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}


	/**
	 *
	 * Find matching structure on a nested array recursively
	 *
	 * @param       $subset
	 * @param       $array
	 * @param array $results
	 *
	 * @return array
	 */
	public static function intersectRecursive($array, $subset, $results = [])
	{
		$isAssocArray = self::isAssocArray($subset);

		if ($isAssocArray) {
			// loop each row of array
			// iterating through parents
			foreach ($subset as $key => $value) {
				if ($key) {
					if (isset($array[$key])) {
						$filteredSource = $array[$key];

						//if the value is array, it will do the recursive
						if (is_array($value)) {
							$loopResults = self::intersectRecursive($subset[$key], $filteredSource, $results);
							$results[$key] = $loopResults;
						}
					}
				}
			}
		} else {
			// iterate through final leaf nodes
			foreach ($subset as $subsetRow) {
				foreach ($array as $sourceRow) {
					if (array_intersect($sourceRow, $subsetRow) == $subsetRow) {
						$results[] = $subsetRow;
					}
				}
			}
		}

		return $results;
	}


}
