<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\DomainForwarding;

/**
 * Ejercicio 2b
 */
$redirects = [
    ["godaddy.net", "godaddy.com"],
    ["godaddy.org", "godaddycares.com"],
    ["godady.com", "godaddy.com"],
    ["godaddy.ne", "godaddy.net"]
];

$df = new DomainForwarding($redirects);

try {

    print_r($df->generateGroupsDomains());

} catch (Exception $e) {

    echo $e->getMessage();

}

//domainForwarding(redirects) = [
//    ["godaddy.com", "godaddy.ne", "godaddy.net", "godady.com"],
//    ["godaddy.org", "godaddycares.com"]
//];


