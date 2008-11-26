--TEST--
Test fopen() function : variation: use include path (path is bad) create a file (relative)
--XFAIL--
Pending completion of Unicode streams
--CREDITS--
Dave Kelsey <d_kelsey@uk.ibm.com>
--FILE--
<?php
/* Prototype  : resource fopen(string filename, string mode [, bool use_include_path [, resource context]])
 * Description: Open a file or a URL and return a file pointer 
 * Source code: ext/standard/file.c
 * Alias to functions: 
 */

echo "*** Testing fopen() : variation ***\n";
set_include_path("rubbish");
testme();
restore_include_path();


function testme() {
	$tmpfile = 'fopen_variation12.tmp';
	$h = fopen($tmpfile, "w", true);
	fwrite($h, "This is the test file");
	fclose($h);
	
	
	$h = @fopen($tmpfile, "r");
	if ($h === false) {
	   echo "Not created in working dir\n";
	}
	else {
	   echo "created in working dir\n";
	   fclose($h);
	   unlink($tmpfile);
	}
	
	$scriptDirFile = dirname(__FILE__).'/'.$tmpfile; 
	$h = fopen($scriptDirFile, "r");
	if ($h === false) {
	   echo "Not created in script dir\n";
	}
	else {
	   echo "created in script dir\n";
	   fclose($h);
	   unlink($scriptDirFile);   
	}
}
?>
===DONE===
--EXPECT--
*** Testing fopen() : variation ***
Not created in working dir
created in script dir
===DONE===
