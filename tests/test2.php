<?php

include "test_inc.php";

//test for issue 78
$source = '

.test { color: darken(#b8860b, 3%); }

';

echo '<pre>'.$sass->toCss($source, false).'</pre>';