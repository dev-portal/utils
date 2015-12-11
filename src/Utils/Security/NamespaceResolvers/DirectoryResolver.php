<?php
/**
 * @author Tomáš Blatný
 */

namespace DevPortal\Utils\Security\NamespaceResolvers;

use DevPortal\Utils\Security\IUserNamespaceResolver;


class DirectoryResolver implements IUserNamespaceResolver
{

	/** @var string */
	private $wwwDir;


	public function __construct($wwwDir)
	{
		$this->wwwDir = $wwwDir;
	}


	/** @return string */
	public function resolve()
	{
		return str_replace(DIRECTORY_SEPARATOR, '.', $this->wwwDir);
	}

}
