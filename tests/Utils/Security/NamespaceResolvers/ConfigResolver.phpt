<?php
/**
 * Test: ConfigResolver
 *
 * @author Tomáš Blatný
 */

use DevPortal\Utils\Security\NamespaceResolvers\ConfigResolver;
use Tester\Assert;

require __DIR__ . "/../../../bootstrap.php";

$resolver = new ConfigResolver('abc');

Assert::equal('abc', $resolver->resolve());
