<?php
include('service.php');

if (!isset($argv[1]) || !$argv[1]) throw new Exception('Not enough data');

print_r(solve($argv[1]) . "\n");
