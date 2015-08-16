<?php

require_once __DIR__ . '/../vendor/autoload.php';

$random = new \Molengo\RandomOrgClient();

// Get a API key: https://api.random.org/api-keys
$random->setApiKey('');

echo "generateIntegers (1-100)<br>\n";
$arrRandomInt = $random->generateIntegers(5, 1, 100);
var_dump($arrRandomInt);

// dice
echo "generateIntegers (dice)<br>\n";
$arrRandomInt = $random->generateIntegers(6, 1, 6, false);
var_dump($arrRandomInt);

// binary data
echo "generateIntegers<br>\n";
$arrRandomInt = $random->generateIntegers(10, 1, 255, true, 2);
var_dump($arrRandomInt);

echo "generateDecimalFractions (2)<br>\n";
$arrRandomDecimal = $random->generateDecimalFractions(1, 2);
var_dump($arrRandomDecimal);

echo "generateGaussians<br>\n";
$arrRandomGaussians = $random->generateGaussians(1, 0, 1, 10);
var_dump($arrRandomGaussians);

echo "generateStrings<br>\n";
$arrRandomStrings = $random->generateStrings(1, 12);
var_dump($arrRandomStrings);

echo "generateUUIDs<br>\n";
$arrRandomUUIDs = $random->generateUUIDs(3);
var_dump($arrRandomUUIDs);

echo "generateBlobs (base64)<br>\n";
$arrRandomBlobs = $random->generateBlobs(1, 256);
var_dump($arrRandomBlobs);

echo "generateBlobs (hex)<br>\n";
$arrRandomBlobs = $random->generateBlobs(1, 128, 'hex');
var_dump($arrRandomBlobs);

echo "getUsage<br>\n";
$arrUsage = $random->getUsage();
var_dump($arrUsage);
