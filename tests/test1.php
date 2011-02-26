<?php

function p(){
    $args = func_get_args();
    $n = sizeof($args);
    for($i = 0; $i < $n; $i++){
        $out = print_r($args[$i], true);
        $s1 = array(" ", "\n");
        $s2 = array("&nbsp;", "<br>");
        echo str_replace($s1,$s2,$out);
        echo "<br />\n";
    }
}

require_once(dirname(__FILE__).'/../sass/SassParser.php');

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

$sass = new SassParser(array(
    'extensions' => array('compass'=>array()),
    'style' => SassRenderer::STYLE_EXPANDED,
    'syntax' => SassFile::SCSS,
));

echo '<pre>'.$sass->toCss($source, false).'</pre>';