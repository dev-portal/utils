<?php
/**
 * @author Tomáš Blatný
 */

namespace DevPortal\Utils\DI;

use DevPortal\Utils\Security\IUserNamespaceResolver;
use DevPortal\Utils\Security\NamespaceResolvers\ConfigResolver;
use DevPortal\Utils\Security\NamespaceResolvers\DirectoryResolver;
use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Nette\InvalidArgumentException;
use Nette\Security\IUserStorage;


class UserNamespaceExtension extends CompilerExtension
{

	private $defaults = [
		'type' => 'auto',
		'namespace' => NULL,
		'resolverClass' => NULL,
	];


	public function loadConfiguration()
	{
		$config = $this->validateConfig($this->defaults);

		if (isset($config['resolverClass']) && $config['resolverClass']) {
			$this->getContainerBuilder()
				->addDefinition($this->prefix('resolver'))
				->setClass($config['resolverClass']);
			return;
		}

		switch ($config['type']) {
			case 'auto':
				if (isset($config['namespace']) && $config['namespace']) {
					$this->registerConfigResolver($config['namespace']);
				} else {
					$this->registerDirectoryResolver();
				}
			break;
			case 'dir':
			case 'directory':
				$this->registerDirectoryResolver();
				break;
			case 'config':
			case 'value':
				if (!$config['namespace']) {
					throw new InvalidArgumentException('Set configuration value ' . $this->name . '.namespace to use ConfigResolver.');
				}
				$this->registerConfigResolver($config['namespace']);
				break;
			default:
				throw new InvalidArgumentException('Invalid configuration value ' . $this->name . '.type: ' . $config['type']);
		}
	}


	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();

		if ($name = $builder->getByType(IUserStorage::class)) {
			$builder->getDefinition($name)
				->addSetup('setNamespace', [$builder->getByType(IUserNamespaceResolver::class), 'resolve']);
		}
	}


	/**
	 * @param string $namespace
	 * @return ServiceDefinition
	 */
	private function registerConfigResolver($namespace)
	{
		return $this->getContainerBuilder()
			->addDefinition($this->prefix('resolver'))
			->setClass(ConfigResolver::class)
			->setArguments([$namespace]);
	}


	/**
	 * @return ServiceDefinition
	 */
	private function registerDirectoryResolver()
	{
		return $this->getContainerBuilder()
			->addDefinition($this->prefix('resolver'))
			->setClass(DirectoryResolver::class)
			->setArguments(['%wwwDir%']);
	}

}
