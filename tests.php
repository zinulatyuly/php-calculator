<?php
include('service.php');

$tests = [
    "-5" => -5,
    "+5" => 5,
    "5" => 5,
    "5+3" => 8,
    "-5+3" => -2,
    "5-4" => 1,
    "6/2" => 3,
    "8*3" => 24,
    "5+5*5" => 30,
    "5-5^2" => -20,
    "5+5*5-5/2+3*8" => 51.5,
    "5-2*3+5^2+5-2-3-3-4-5-8*10" => -68,
    "5*(2+3)" => 25,
    "5+3^6+9*(5*(6+8))-(6+8*4)" => 1326,
    "6+2*(4-3)-5^5+2*(43-21*1)+43*0" => -3073
];

foreach ($tests as $expression => $expected) {
    echo "$expression started \n";
    $result = solve($expression);
    if ($result !== floatval($expected)) {
        echo "$expression expected $expected, got $result \n";
    }
    echo "$expression done \n";
}
