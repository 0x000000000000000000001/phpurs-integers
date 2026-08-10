<?php
try {
    require_once "output/Test.Main/main.mod.php";
} catch (Exception $e) {
    echo "CAUGHT EXCEPTION: " . $e->getMessage() . "\n";
}
