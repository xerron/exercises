<?php

declare(strict_types=1);

namespace App;

use Exception;

class Domain
{
    /**
     * @var string
     */
    public $domain;

    /**
     * Domain constructor.
     * @param string $domain
     */
    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $this->domain)) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getPublicSuffix(): string
    {
        if(!$this->isValid()) {
            throw new Exception("El formato del dominio no es valido.");
        }
        $parts = explode(".", $this->domain);
        return (string) end($parts);
    }

}