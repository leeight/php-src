--TEST--
Test 3: Exception Test
--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php

$dom = new domdocument;
$dom->load(dirname(__FILE__)."/book.xml");
$rootNode = $dom->documentElement;
print "--- Catch exception with try/catch\n";
try {
    $rootNode->appendChild($rootNode);
} catch (domexception $e) {
    var_dump($e);
}
print "--- Don't catch exception with try/catch\n";
$rootNode->appendChild($rootNode);


?>
--EXPECTF--
--- Catch exception with try/catch
object(domexception)#3 (7) {
  ["code"]=>
  int(3)
  ["trace"]=>
  array(0) {
  }
}
--- Don't catch exception with try/catch

Fatal error: Uncaught exception 'domexception' with message 'Hierarchy Request Error' in %sdom003.php:%d
Stack trace:
#0 {main}
  thrown in %sdom003.php on line %d
