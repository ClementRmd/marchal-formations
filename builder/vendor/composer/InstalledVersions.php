<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;








class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '5ea58156787511c9e8239e161acb184e2de64579',
    'name' => '36pixels/firstpixel',
  ),
  'versions' => 
  array (
    '36pixels/firstpixel' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '5ea58156787511c9e8239e161acb184e2de64579',
    ),
    'composer/installers' => 
    array (
      'pretty_version' => 'v1.11.0',
      'version' => '1.11.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ae03311f45dfe194412081526be2e003960df74b',
    ),
    'rosell-dk/webp-convert' => 
    array (
      'pretty_version' => '1.3.9',
      'version' => '1.3.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '3680c278f08748054b4ab3ea7855be8984f008aa',
    ),
    'roundcube/plugin-installer' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'shama/baton' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '46cd95797e9df938fdd2b03693b5fca5e64b01ce',
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v2.6.7',
      'version' => '2.6.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b786088918a884258c9e3e27405c6a4cf2ee246e',
    ),
    'wp-sync-db/wp-sync-db' => 
    array (
      'pretty_version' => 'master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => 'master',
    ),
    'wp-sync-db/wp-sync-db-media-files' => 
    array (
      'pretty_version' => 'master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => 'master',
    ),
    'wpackagist-plugin/acf-theme-code' => 
    array (
      'pretty_version' => '2.5.0',
      'version' => '2.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'trunk',
    ),
    'wpackagist-plugin/akismet' => 
    array (
      'pretty_version' => '4.1.9',
      'version' => '4.1.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/4.1.9',
    ),
    'wpackagist-plugin/duplicate-post' => 
    array (
      'pretty_version' => '4.1.2',
      'version' => '4.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/4.1.2',
    ),
    'wpackagist-plugin/force-regenerate-thumbnails' => 
    array (
      'pretty_version' => '2.0.6',
      'version' => '2.0.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/2.0.6',
    ),
    'wpackagist-plugin/wordpress-seo' => 
    array (
      'pretty_version' => '16.5',
      'version' => '16.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/16.5',
    ),
    'wpackagist-plugin/wp-pagenavi' => 
    array (
      'pretty_version' => '2.94.0',
      'version' => '2.94.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'tags/2.94.0',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}

if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}





private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
