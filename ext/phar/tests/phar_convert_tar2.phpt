--TEST--
Phar::convertToTar() gzipped
--SKIPIF--
<?php if (!extension_loaded("phar")) die("skip"); ?>
<?php if (!extension_loaded("zlib")) die("skip"); ?>
--INI--
phar.require_hash=0
phar.readonly=0
--FILE--
<?php

$fname = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.phar.php';
$pname = 'phar://' . $fname;
$fname2 = dirname(__FILE__) . '/' . basename(__FILE__, '.php') . '.2.phar.php';
$pname2 = 'phar://' . $fname;
$stub = '<?php echo "first stub\n"; __HALT_COMPILER(); ?>';
$file = $stub;

$files = array();
$files['a'] = 'a';
$files['b'] = 'b';
$files['c'] = 'c';

include 'files/phar_test.inc';

$phar = new Phar($fname);
var_dump($phar->isTar());
var_dump($phar->isCompressed());
var_dump($phar->getStub());

$phar->convertToTar(Phar::GZ);
var_dump($phar->isTar());
var_dump($phar->isCompressed());
var_dump($phar->getStub());

copy($fname, $fname2);

$phar = new Phar($fname2);
var_dump($phar->isTar());
var_dump($phar->isCompressed() == Phar::GZ);
var_dump($phar->getStub());

?>
===DONE===
--CLEAN--
<?php 
unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.phar.php');
unlink(dirname(__FILE__) . '/' . basename(__FILE__, '.clean.php') . '.2.phar.php');
__HALT_COMPILER();
?>
--EXPECT--
bool(false)
bool(false)
string(48) "<?php echo "first stub\n"; __HALT_COMPILER(); ?>"
bool(true)
int(4096)
string(60) "<?php // tar-based phar archive stub file
__HALT_COMPILER();"
bool(true)
bool(true)
string(60) "<?php // tar-based phar archive stub file
__HALT_COMPILER();"
===DONE===
