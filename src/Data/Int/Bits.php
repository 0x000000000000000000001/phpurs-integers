<?php

$and = function($n1, $n2 = null) use (&$and) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$and) {

            return $and(...\array_merge($__args, $more));
        };
    }
    return $n1 & $n2;
};

$or = function($n1, $n2 = null) use (&$or) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$or) {

            return $or(...\array_merge($__args, $more));
        };
    }
    return $n1 | $n2;
};

$xor = function($n1, $n2 = null) use (&$xor) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$xor) {

            return $xor(...\array_merge($__args, $more));
        };
    }
    return $n1 ^ $n2;
};

$shl = function($n1, $n2 = null) use (&$shl) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$shl) {

            return $shl(...\array_merge($__args, $more));
        };
    }
    return $n1 << $n2;
};

$shr = function($n1, $n2 = null) use (&$shr) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$shr) {

            return $shr(...\array_merge($__args, $more));
        };
    }
    return $n1 >> $n2;
};

$zshr = function($n1, $n2 = null) use (&$zshr) {
    if (\func_num_args() < 2) {
        $__args = \func_get_args();
        return function(...$more) use ($__args, &$zshr) {

            return $zshr(...\array_merge($__args, $more));
        };
    }
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
