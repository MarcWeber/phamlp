<?php

include "test_inc.php";

//test for issue 80
$source = <<<END
.test {
	color: green;
	&:hover { color: red; }
}
.test2 {
    @extend .test;
}

/*
test for issue 80
expected:
.test, .test2 {color:green;}
.test:hover, .test2:hover {color:red;}
*/

END;

echo '<pre>'.$sass->toCss($source, false).'</pre>';