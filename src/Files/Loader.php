<?php


namespace EMedia\PHPHelpers\Files;


class Loader
{

	public static function includeAllFilesFromDir($dirPath)
	{
		foreach (glob($dirPath . "/*.php") as $filename)
		{
			include $filename;
		}
	}

}