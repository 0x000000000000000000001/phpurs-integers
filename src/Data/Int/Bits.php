<?php

$and = function($n1, $n2) use (&$and) {
    return $n1 & $n2;
};

$or = function($n1, $n2) use (&$or) {
    return $n1 | $n2;
};

$xor = function($n1, $n2) use (&$xor) {
    return $n1 ^ $n2;
};

$shl = function($n1, $n2) use (&$shl) {
    return $n1 << $n2;
};

$shr = function($n1, $n2) use (&$shr) {
    return $n1 >> $n2;
};

$zshr = function($n1, $n2) use (&$zshr) {
    // PHP doesn't have >>> operator. Emulate 32-bit zero-fill right shift.
    return ($n1 >> $n2) & (0x7fffffff >> ($n2 - 1));
};

$complement = function($n) {
    return ~$n;
};

$exports['and'] = $and;
$exports['or'] = $or;
$exports['xor'] = $xor;
$exports['shl'] = $shl;
$exports['shr'] = $shr;
$exports['zshr'] = $zshr;
$exports['complement'] = $complement;
return $exports;
