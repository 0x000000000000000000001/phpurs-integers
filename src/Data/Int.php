<?php

$fromNumberImpl = function($just, $nothing, $n) use (&$fromNumberImpl) {
    // JS bitwise OR 0 limits to 32-bit signed integer. 
    // PHP integers are typically 64-bit, but to match JS semantics we can just cast to int.
    return (intval($n) == $n) ? $just(intval($n)) : $nothing;
};

$toNumber = function($n) {
    return floatval($n);
};

$fromStringAsImpl = function($just, $nothing, $radix, $s) use (&$fromStringAsImpl) {
    
    if ($radix < 11) {
        $digits = "[0-" . ($radix - 1) . "]";
    } else if ($radix === 11) {
        $digits = "[0-9a]";
    } else {
        $digits = "[0-9a-" . chr(86 + $radix) . "]";
    }
    $pattern = "/^([\+\-]?)(" . $digits . "+)$/i";
    
    if (preg_match($pattern, $s, $matches)) {
        $sign = $matches[1];
        $unsignedS = $matches[2];
        
        // Use floatval here because base_convert can return values larger than PHP's int max
        // on 32-bit systems, and we want to correctly reject them.
        $i = floatval(base_convert($unsignedS, $radix, 10));
        if ($sign === '-') {
            $i = -$i;
        }
        if ($i < -2147483648 || $i > 2147483647) {
            return $nothing;
        }
        return $just((int)$i);
    } else {
        return $nothing;
    }
};

$toStringAs = function($radix, $i) use (&$toStringAs) {
    if ($i < 0) {
        return "-" . base_convert(-$i, 10, $radix);
    }
    return base_convert($i, 10, $radix);
};

$quot = function($x, $y) use (&$quot) {
    return intdiv($x, $y);
};

$rem = function($x, $y) use (&$rem) {
    return $x % $y;
};

$pow = function($x, $y) use (&$pow) {
    return intval(pow($x, $y));
};

$exports['fromNumberImpl'] = $fromNumberImpl;
$exports['toNumber'] = $toNumber;
$exports['fromStringAsImpl'] = $fromStringAsImpl;
$exports['toStringAs'] = $toStringAs;
$exports['quot'] = $quot;
$exports['rem'] = $rem;
$exports['pow'] = $pow;
return $exports;
