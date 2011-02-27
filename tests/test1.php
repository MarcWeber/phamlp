<?php

include "test_inc.php";


$source = '


@mixin test-a($testsel) {
  #{$testsel} {
    width: 900px;
  }
}
@include test-a("body");


$var1: 4px;
$var2: 3px;
@mixin test-b($var) {
  .galleria {
    width: $var;
  }
}
@include test-b($var1 unquote("/") $var2);


@import "compass/css3/border-radius";

.simple   { @include border-radius(4px, 4px); }


';

echo '<pre>'.$sass->toCss($source, false).'</pre>';