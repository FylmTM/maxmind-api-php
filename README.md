Maxmind API
===============

# About
**Author**: Dmitry Vrublevskis
**Contact**: d.vrublevskis@gmail.com

# Installation
### Composer
Recommended way of installation is through [composer](http://getcomposer.org/).
Add to your composer.json:
```javascript
"repositories": [
    { "type": "git", "url": "https://github.com/FylmTM/maxmind-api-php.git" }
],
"require": {
    "fylmtm/maxmind-api": "master",
}
```
And then install with:
```bash
$ composer.phar install
```

### Manual
You can manually download library and use autoloader.
```php
require_once 'lib/autoloader.php'
```

# Usage
**TODO**

# Tests
If you wish to run tests, you need to install development dependencies:
```bash
$ composer.phar install --dev
```
And then run them with:
```bash
$ vendor/bin/phpunit
```