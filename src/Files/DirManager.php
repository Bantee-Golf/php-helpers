<?php


namespace EMedia\PHPHelpers\Files;


use EMedia\PHPHelpers\Exceptions\FIleSystem\DirectoryNotCreatedException;

class DirManager
{

	/**
	 * Create a directory if it doesn't exist
	 *
	 * @param      $dirPath
	 * @param int  $permissions
	 * @param bool $recursive
	 *
	 * @throws DirectoryNotCreatedException
	 */
	public static function makeDirectoryIfNotExists($dirPath, $permissions = 0775, $recursive = true)
	{
		if (is_dir($dirPath) ) {
			return true;
		}

		if (!mkdir($dirPath, $permissions, $recursive) && !is_dir($dirPath)) {
			throw new DirectoryNotCreatedException(sprintf('Directory "%s" was not created', $dirPath));
		}

		if (is_dir($dirPath)) return true;

		return false;
	}

}