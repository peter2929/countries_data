<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Country;
use App\Enums\CountryStatus;
use RuntimeException;

class DataFetchService
{
    private const FIELDS = ['name', 'gini'];
    private const EEA_COUNTRIES = [
        'Austria', 'Belgium', 'Bulgaria', 'Croatia', 'Cyprus', 'Czechia', 'Denmark', 'Estonia',
        'Finland', 'France', 'Germany', 'Greece', 'Hungary', 'Iceland', 'Ireland', 'Italy',
        'Latvia', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Malta', 'Netherlands',
        'Norway', 'Poland', 'Portugal', 'Romania', 'Slovakia', 'Slovenia', 'Spain', 'Sweden'
    ];

    public function fetch(): array
    {
        $europeanData = $this->getData('region/europe?fields='. implode(',', self::FIELDS));
        $eeaData = $this->filterData($europeanData);
        return $this->extractData($eeaData);
    }

    private function getData(string $query): array
    {
        $apiConfig = config('services.restcountries');
        $data = Http::baseUrl($apiConfig['url'])
                ->timeout($apiConfig['timeout'])
                ->get($query)
                ->throw()
                ->json();

        if(!is_array($data) || empty($data)) {
            throw new RuntimeException();
        }

        return $data;
    }

    private function filterData(array $data): array
    {
        return array_filter($data, function($elem) {
            return in_array($elem['name']['common'], self::EEA_COUNTRIES);
        });
    }

    private function extractData(array $rawData): array
    {
        $extracted = [];
        foreach($rawData as $country) {
            $gini = (isset($country['gini']) ? reset($country['gini']) : null);
            $extracted[] = [
                'name' => $country['name']['common'],
                'status' => CountryStatus::fromGini($gini)->value,
            ];
        }

        return $extracted;
    }
}
