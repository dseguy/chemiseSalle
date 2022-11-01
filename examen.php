<?php

$e = (int) $argv[1];
$n = (int) $argv[2];
$s = (int) $argv[3];

print "$e examens, $n eleves, $s salles. \n";

// preparation des examens
$examens = array();
for($i = 0; $i < $e; ++$i) {
	$examens[] = "E$i";
}

// preparation des eleves
$eleves = array();
for($i = 0; $i < $n; ++$i) {
	$x = rand(1, $e);
	shuffle($examens);
	$eleves["N$i"] = array_slice($examens, 0, $x);
}

// preparation des salles
$salles = array();
for($i = 0; $i < $s; ++$i) {
	$salles["S$i"] = rand(1, $n);
}

$hypotheses = ['examens' => $examens,
			   'eleves' => $eleves,
			   'salles' => $salles,
				];
				
print json_encode($hypotheses, JSON_PRETTY_PRINT);

$d = count(glob("cas/$e-$n-$s-*.json")) + 1;
file_put_contents("cas/$e-$n-$s-$d.json", json_encode($hypotheses, JSON_PRETTY_PRINT));

?>