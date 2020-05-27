<?php declare(strict_types=1);

namespace App;

use Exception;

class DomainForwarding
{
    /**
     * @var array
     */
    public $redirects;

    /**
     * @var array
     */
    public $groups;

    /**
     * DomainForwarding constructor.
     * @param array $redirects
     */
    public function __construct(array $redirects = [])
    {
        $this->redirects = $redirects;
        $this->groups = [];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function generateGroupsDomains(): array
    {
        $redirects = $this->redirects;

        if(!Validator::arrayLength($redirects, 1,15)){
            throw new Exception("Restriccion: 1 <= redirects.length <= 15");
        }

        if(!Validator::arrayContainsTupleString($redirects)) {
            throw new Exception("Restriccion: Los elementos del array deben ir en pares de strings.");
        }

        if(!Validator::arrayNotRepeatFirstTupleItem($redirects)) {
            throw new Exception("Restriccion: Un dominio solo se redirige a un dominio. i ≠ j redirects[i][0] ≠ redirects[j][0].");
        }

        $domains = $this->getDomains($redirects);
        foreach ($domains as $domain) {
            $d = new Domain($domain);
            if(!$d->isValid()){
                throw new Exception("Restriccion: El dominio: $domain, no es valido.");
            }
            if(!Validator::stringLength($domain, 1, 25)){
                throw new Exception("Restriccion: El dominio: $domain, no corresponde al intervalo: 1 ≤ redirects[i][j].length ≤ 25");
            }
        }

        $groupsDomains = [];
        $initElement = array_shift($redirects);
        $groups =  $this->createGroup($redirects, $initElement);
        foreach ($groups as $group) {
            $domains = $this->getDomains($group);
            sort($domains, SORT_STRING);
            $groupsDomains[] = $domains;
        }
        return $groupsDomains;
    }

    /**
     * @param array $redirects
     * @param $initElement
     * @param int $index
     * @return array
     */
    private function createGroup(array &$redirects, $initElement, $index = 0): array
    {
        if (!key_exists($index, $this->groups)) {
            $this->groups[$index] = [];
        }
        if (!in_array($initElement, $this->groups[$index])) {
            $this->groups[$index][] = $initElement;
        }

        foreach ($redirects as $key => $redirect) {

            if ($initElement[0] === $redirect[0] || $initElement[0] === $redirect[1] ||
                $initElement[1] === $redirect[0] || $initElement[1] === $redirect[1]) {
                unset($redirects[$key]);
                $this->createGroup($redirects, $redirect, $index);
            }
        }

        if (count($redirects) > 0 && $this->elementsContains($redirects, $this->groups[$index]) === 0) {
            $initElement = array_shift($redirects);
            $this->createGroup($redirects, $initElement, ++$index);
        }


        return $this->groups;
    }

    /**
     * @param array $redirects
     * @param array $group
     * @return int
     */
    private function elementsContains(array $redirects, array $group): int
    {
        return count(array_intersect($this->getDomains($redirects), $this->getDomains($group)));
    }

    /**
     * @param array $group
     * @return array
     */
    private function getDomains(array $group): array
    {
        $groupDomains = [];
        foreach ($group as $item) {
            $groupDomains[] = $item[0];
            $groupDomains[] = $item[1];
        }
        return array_unique($groupDomains);
    }

}