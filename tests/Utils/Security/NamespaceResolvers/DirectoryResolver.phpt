<?php
/**
 * Test: DirectoryResolver
 *
 * @author Tomáš Blatný
 */

use DevPortal\Utils\Security\NamespaceResolvers\DirectoryResolver;
use Tester\Assert;


require __DIR__ . "/../../../bootstrap.php";

$resolver = new DirectoryResolver(__DIR__);

Assert::equal(str_replace(DIRECTORY_SEPARATOR, '.', __DIR__), $resolver->resolve());
