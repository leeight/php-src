--TEST--
jump 03: jump inside control structures
--FILE--
<?php
do {
	if (1) {
		echo "1: ok\n";
		jump L1;
	} else {
	    echo "bug\n";
L1:
		echo "2: ok\n";
	}
} while (0);
?>
--EXPECT--
1: ok
2: ok
