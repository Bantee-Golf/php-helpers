<?php


namespace EMedia\PHPHelpers\Files;


class Loader
{

	public static function includeAllFilesFromDir($dirPath)
	{
		$includedFiles = get_included_files();

		foreach (glob($dirPath . "/*.php") as $filename)
		{
			if (!in_array($filename, $includedFiles)) {
				include $filename;
			}
		}
	}

}