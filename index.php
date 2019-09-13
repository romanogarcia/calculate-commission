<?php 

use Roman\Utility\Helper as Helper;

require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2 )
{
    exit( "Usage: program <csv file>\n" );
}

$input_file = $argv[1];
$helper = new Helper();
$rows = $helper->getCsv($input_file);

foreach ($rows as $row)
{
    echo $helper->getCommission($row) . PHP_EOL;
}