# Dev Portal / Utils

## Installation

Install using composer

```sh
$ composer require dev-portal/utils
```

## Modules

### Namespace for UserStorage
 
This module provides easy configuration of namespace for IUserStorage for Nette Framework.

First enable it by registering extension into your config neon:

```yml
extensions:
	userNamespace: DevPortal\Utils\DI\UserNamespaceExtension
```

You can then configure it:

```yml
userNamespace:
	type: auto
	namespace: foo.bar
```

`type` attribute can be:

- `config` or `value` - uses directly namespace from `namespace` attribute
- `dir` or `directory` - uses namespace dependent on absolute path of your project (`%wwwDir%`)
- `auto` - if `namespace` is set, uses it, otherwise uses absolute path of your project

You can also write your own `IUserNamespaceResolver` and register it under `resolverClass` attribute.
This overrides predefined resolvers.
