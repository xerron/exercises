<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\DomainForwarding;

/**
 * Ejercicio 2
 */

$redirects = [
    ["a-b.c", "a.c"],
    ["aa-b.c", "a-b.c"],
    ["bb-b.c", "a-b.c"],
    ["cc-b.c", "a-b.c"],
    ["d-cc-b.c", "bb-b.c"],
    ["e-cc-b.c", "bb-b.c"]
];


$df = new DomainForwarding($redirects);

try {

    print_r($df->generateGroupsDomains());

} catch (Exception $e) {

    echo $e->getMessage();

}
//domainForwarding(redirects) = [
//    ["a-b.c","a.c","aa-b.c","bb-b.c","cc-b.c","d-cc-b.c","e-cc-b.c"]
//];
