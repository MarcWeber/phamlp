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

$blue: #3bbfce;
$margin: 16px;

.content-navigation {
  border-color: $blue;
  color:
    darken($blue, 9%);
}

.border {
  padding:0;
  margin: $margin / 2;
  border-color: $blue;
}

';

$sass = new SassParser(array(
    'extensions' => array('compass'=>array()),
    'style' => SassRenderer::STYLE_EXPANDED,
    'syntax' => SassFile::SCSS,
));

echo '<pre>'.$sass->toCss($source, false).'</pre>';