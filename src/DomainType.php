<?php declare(strict_types=1);

namespace App;

use Exception;

class DomainType
{
    /**
     * @var array
     */
    public $domains;

    /**
     * DomainType constructor.
     * @param array $domains
     */
    public function __construct(array $domains = [])
    {
        $this->domains = $domains;
    }

    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return [
            "org" => "organizacion",
            "com" => "comercial",
            "net" => "red",
            "info" => "informacion"
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function show()
    {
        if(!Validator::arrayLength($this->domains, 4,25)) {
            throw new Exception("Restriccion: 4 <= domains.length <= 25.");
        }

        $types = [];
        $dictionary = $this->getDictionary();

        foreach ($this->domains as $domain) {

            if(!Validator::stringLength($domain, 5,20)) {
                throw new Exception("Restriccion: longirud del dominio,  5 <= domains[i].length <= 20");
            }

            $d = new Domain($domain);
            $suffix = $d->getPublicSuffix();

            if (array_key_exists($suffix, $dictionary)) {

               $types[] = $dictionary[$suffix];

            } else {

               throw new Exception("La clave: $suffix no se encuentra en nuestro diccionario.");

            }

        }

        return $types;

    }

}