<?php declare(strict_types=1);

require 'vendor/autoload.php';

use App\DomainType;

/**
 * Ejercicio 1
 */

$domains = ["es.wiki.org", "codefights.com", "happy.net", "code.info"];

$dt = new DomainType($domains);

echo implode(" , ", $dt->domains) . PHP_EOL;

try {

    echo implode(" , ", $dt->show());

} catch (Exception $e) {

    echo $e->getMessage();

}

// domainType(domains) = ["organizacion", "comercial", "red", "informacion"].

