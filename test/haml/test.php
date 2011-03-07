<?php

/* run tests in test/haml/ruby-haml-3.0.24-tests.json
 */

require_once('../../Phamlp.php');
require_once('../..//haml/HamlParser.php');

function render($template){
	$args = func_get_args();

	$haml = new HamlParser(array('style' => 'nested', 'ugly' => false, 'debug' => false, 'escapeHtml' => true));
	$php = $haml->parse($template);
	file_put_contents('/tmp/tmpl.php', $php);
	foreach (array_slice($args, 1) as $arr) {
		extract($arr);
	}
	ob_implicit_flush(false);
	ob_start();
	require '/tmp/tmpl.php';
	return ob_get_clean();
}

$tests = json_decode(file_get_contents(dirname(__FILE__).'/ruby-haml-3.0.24-tests.json'), true);

$nr = 0;

function strip($s)
{
  // dropping / to ignore HTML vs XHTML
  return preg_replace('/[ \t\n\/]*/',"",$s);
}

$ok = 0;
$skip_parse_error = array(44, 54, 74, 76, 77);

foreach ($tests as $groupheader => $group) {
  echo "===> $groupheader\n";
  foreach ($group as $name => $test) {
    $nr ++;
    if (in_array($nr, $skip_parse_error))
      continue;
    $haml = $test['haml'];
    $expected = $test['html'];

    file_put_contents('/tmp/tmp.haml', $haml);
    echo "$nr: $name\n";
    try {
      $rendered = render('/tmp/tmp.haml', isset($test['locals']) ? $test['locals'] : array());
    } catch (Exception $e){
      $rendered = "Exception: ".$e->getMessage();
    }

    list($e_s, $got_s) = array_map('strip', array($expected, $rendered));

    echo "haml: $haml\n";
    if ($e_s === $got_s){
      $ok ++;
      echo "ok $nr\n";
    }else{
      echo "failed:\n";
      echo "expected: $e_s\n";
      echo "got: $got_s\n";
    }
    echo "\n";
  }
}

echo "$ok of $nr \n";
