<?php
// Basic test for index.php
$index = __DIR__ . '/../index.php';
if (!file_exists($index)) {
    fwrite(STDERR, "Cannot find index.php\n");
    exit(1);
}

ob_start();
include $index;
$output = ob_get_clean();

$data = json_decode($output, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    fwrite(STDERR, "Output is not valid JSON\n");
    exit(1);
}

if (!isset($data['user']) || !isset($data['token'])) {
    fwrite(STDERR, "Required keys missing\n");
    exit(1);
}

echo "Tests passed\n";

