--TEST--
Phar::mapPhar truncated manifest (not enough for manifest length)
--SKIPIF--
<?php if (!extension_loaded("phar")) print "skip";?>
--FILE--
<?php
function cleanup() { unlink(dirname(__FILE__) . '/008_phar.php'); }
register_shutdown_function('cleanup');
$file = "<?php
Phar::mapPhar(5, 'hio', false);
__HALT_COMPILER(); ?>";
$file .= pack('V', 500) . 'notenough';
file_put_contents(dirname(__FILE__) . '/008_phar.php', $file);
include dirname(__FILE__) . '/008_phar.php';
?>
--EXPECTF--
Fatal error: Phar::mapPhar(): internal corruption of phar "%s" (truncated manifest) in %s on line %d