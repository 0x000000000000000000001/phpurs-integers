<?php

$fromNumberImpl = function($just, $nothing = null, $n = null) use (&$fromNumberImpl) {
    if (\func_num_args() < 3) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$fromNumberImpl) {

            return $fromNumberImpl(...\array_merge($__args, $more));
        };
    }
    // JS bitwise OR 0 limits to 32-bit signed integer. 
    // PHP integers are typically 64-bit, but to match JS semantics we can just cast to int.
    return (intval($n) == $n) ? $just(intval($n)) : $nothing;
};

$toNumber = function($n) {
    return floatval($n);
};

$fromStringAsImpl = function($just, $nothing = null, $radix = null, $s = null) use (&$fromStringAsImpl) {
    if (\func_num_args() < 4) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$fromStringAsImpl) {

            return $fromStringAsImpl(...\array_merge($__args, $more));
        };
    }
    
    if ($radix < 11) {
        $digits = "[0-" . ($radix - 1) . "]";
    } else if ($radix === 11) {
        $digits = "[0-9a]";
    } else {
        $digits = "[0-9a-" . chr(86 + $radix) . "]";
    }
    $pattern = "/^[\+\-]?" . $digits . "+$/i";

    if (preg_match($pattern, $s)) {
        $i = intval(base_convert($s, $radix, 10));
        return $just($i);
    } else {
        return $nothing;
    }
};

$toStringAs = function($radix, $i = null) use (&$toStringAs) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$toStringAs) {

            return $toStringAs(...\array_merge($__args, $more));
        };
    }
    return base_convert($i, 10, $radix);
};

$quot = function($x, $y = null) use (&$quot) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$quot) {

            return $quot(...\array_merge($__args, $more));
        };
    }
    return intdiv($x, $y);
};

$rem = function($x, $y = null) use (&$rem) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$rem) {

            return $rem(...\array_merge($__args, $more));
        };
    }
    return $x % $y;
};

$pow = function($x, $y = null) use (&$pow) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$pow) {

            return $pow(...\array_merge($__args, $more));
        };
    }
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
