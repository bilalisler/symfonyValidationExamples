<?php


namespace App\Service;


use GuzzleHttp\Client;

class BinListService
{
    /**
     * Output:
     *
     * {
            number: {
                length: 16,
                luhn: true
            },
            scheme: "visa",
            type: "credit",
            brand: "Traditional",
            prepaid: false,
            country: {
                numeric: "826",
                alpha2: "GB",
                name: "United Kingdom of Great Britain and Northern Ireland",
                emoji: "🇬🇧",
                currency: "GBP",
                latitude: 54,
                longitude: -2
            },
            bank: {
                name: "BARCLAYS BANK PLC",
                url: "www.barclays.co.uk",
                phone: "0845 755 5555"
            }
        }

     *
     * @param $cardNumberFirst8Digit
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cardDetail($cardNumberFirst8Digit)
    {
        $client = new Client([
            'base_uri' => 'https://lookup.binlist.net',
            'Accept-Version' => 3,
        ]);

        $dump = $client->request('GET', $cardNumberFirst8Digit);

        return (string)$dump->getBody();
    }
}