<?php

namespace gietos\yii\Dadata;

use Dadata\Response\Address;
use yii\base\Configurable;

/**
 * {@inheritDoc}
 */
class Client extends \Dadata\Client implements Configurable
{
    /**
     * @param string $address
     * @param int $count
     * @return Address[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     */
    public function suggestAddress(string $address, int $count = 10): array
    {
        $result = $this->query($this->prepareSuggestionsUri('suggest/address'), [
            'query' => $address,
            'count' => $count,
            'locations'=> [
                ['country'=> '*'],
            ],
        ]);

        $addresses = [];
        foreach ($result as $searchData) {
            $addresses[] = $this->populate(new Address, $searchData['data']);
        }

        return $addresses;
    }

}
