<?php
$just = function($x) { return ["Just", $x]; };
$nothing = ["Nothing"];
$fromStringAsImpl = function($just, $nothing, $radix, $s) {
    if ($radix < 11) { $digits = "[0-" . ($radix - 1) . "]"; }
    else if ($radix === 11) { $digits = "[0-9a]"; }
    else { $digits = "[0-9a-" . chr(86 + $radix) . "]"; }
    $pattern = "/^([\+\-]?)(" . $digits . "+)$/i";
    if (preg_match($pattern, $s, $matches)) {
        $sign = $matches[1];
        $unsignedS = $matches[2];
        $i = floatval(base_convert($unsignedS, $radix, 10));
        if ($sign === '-') { $i = -$i; }
        if ($i < -2147483648 || $i > 2147483647) { return $nothing; }
        return $just((int)$i);
    } else { return $nothing; }
};
var_dump($fromStringAsImpl($just, $nothing, 10, "2147483648"));
var_dump($fromStringAsImpl($just, $nothing, 10, "-2147483649"));
