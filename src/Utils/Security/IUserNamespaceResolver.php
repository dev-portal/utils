<?php
/**
 * @author Tomáš Blatný
 */

namespace DevPortal\Utils\Security;

interface IUserNamespaceResolver
{

	/** @return string */
	function resolve();

}
