<?php

include "test_inc.php";

//test for issue 78
$source = '


@debug lighten(#B8860B, 3%) "expected: #c6910c";
@debug darken(#b8860b, 3%) "expected: #aa7b0a";
@debug lighten(#99FF99, 8%) "expected: #c2ffc2";
@debug darken(#99FF99, 8%) "expected: #70ff70";
@debug lighten(#A4D9E4, 6%) "expected: #bce3eb";
@debug darken(#A4D9E4, 6%) "expected: #8ccfdd";
@debug lighten(#806918, 26%) "expected: #dbb941";
@debug darken(#806918, 8%) "expected: #5e4d12";


';

echo '<pre>'.$sass->toCss($source, false).'</pre>';