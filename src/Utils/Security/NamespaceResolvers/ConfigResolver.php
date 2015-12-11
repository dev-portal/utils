<?php
/**
 * @author Tomáš Blatný
 */

namespace DevPortal\Utils\Security\NamespaceResolvers;

use DevPortal\Utils\Security\IUserNamespaceResolver;


class ConfigResolver implements IUserNamespaceResolver
{


	/** @var string */
	private $namespace;


	public function __construct($namespace)
	{
		$this->namespace = (string) $namespace;
	}


	/** @return string */
	public function resolve()
	{
		return $this->namespace;
	}

}
