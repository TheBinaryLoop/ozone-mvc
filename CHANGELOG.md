# Changelog

All notable changes to the `Ozone Framework` will be documented in this file

## 0.0.4 - ????-??-??

### Added
- Added interface `ITemplateEngine`
- Added abstract class `TemplateEngine`
- Added Markdown Template Engine
- Added `PHPUnit` tests
- Added logging manager `Logger.php`
- Added `Constants.php`
- Added `Exception.php`
- Added some documentation
- Added `DatabaseProxy.php`
- Added `MySQLEngine.php`
- Added `PostgreSQLEngine.php`
- Added `ControllerNotFoundException.php`
- Added `MethodNotFoundException.php`
- Added `MisconfigurationException.php`
- Added `j4mie/paris` and `j4mie/idiorm` for easier database access
- Added PHPUnitTests for `Bootstrap.php`


### Changed
- Splitted the `Loader` into Template Engines
- Reorganized the folder structure
- Changed autoloading to psr-4
- Moved `core\Ozone.php` to `Ozone\Core\App.php`
- Moved `core\classes\Bootstrap.php` to `Ozone\Core\Bootstrap.php`
- Moved `core\classes\HookManager.php` to `Ozone\Core\HookManager.php`
- Moved `core\classes\URL.php` to `Ozone\Core\Helpers\URLHelper.php`
- Moved `core\interfaces\IController.php` to `Ozone\App\Controllers\IAppController.php`
- Moved `core\abstracts\AppController.php` to `Ozone\App\Controllers\AppController.php`
- Moved `core\abstracts\Model.php` to `Ozone\Base\OzoneModel.php`
- Changed the `Bootstrap->createController()` to use the reflection api

### Fixed

### Removed


## 0.0.3 - 2018-04-02

### Added
- Added support for packages that are installed with the `composer` packet manager
- Added `phpmailer/phpmailer` via `composer`
- Added `dwoo/dwoo` template engine via `composer`

### Changed
- Re-added `hassankhan/config` via `composer`
- Re-added `xamin/handlebars.php` via `composer`
- Re-added `michelf/php-markdown` via `composer`

## 0.0.2 - 2018-03-09

### Added
- Added support for third-party library loading to `autoloader`
- Added `xamin/handlebars.php` template engine
- Added `michelf/php-markdown` template engine
- Added `hassankhan/config` as config manager

### Changed
- Moved app logic into own file

## 0.0.1 - 2018-02-18

### Added
- Base components of the framework
- Uses PSR-0 for autoloading