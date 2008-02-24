--TEST--
Phar::convertToPhar() from zip
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
--INI--
phar.require_hash=0
phar.readonly=0
--FILE--
<?php

$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar';
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '2.phar';

$phar = new Phar($fname);
$phar->stopBuffering();
var_dump($phar->isZip());
var_dump(strlen($phar->getStub()));

$phar->convertToZip();
var_dump($phar->isZip());
var_dump($phar->getStub());

$phar['a'] = 'hi there';

$phar->convertToPhar();
var_dump($phar->isPhar());
var_dump(strlen($phar->getStub()));

copy($fname, $fname2);

$phar = new Phar($fname2);
var_dump($phar->isPhar());
var_dump(strlen($phar->getStub()));

?>
===DONE===
--CLEAN--
<?php 
unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar');
unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '2.phar');
__HALT_COMPILER();
?>
--EXPECT--
bool(false)
int(6573)
bool(true)
string(60) "<?php // zip-based phar archive stub file
__HALT_COMPILER();"
bool(true)
int(6573)
bool(true)
int(6573)
===DONE===
