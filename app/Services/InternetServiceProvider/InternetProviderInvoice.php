<?php

namespace App\Services\InternetServiceProvider;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Config;

class InternetProviderInvoice
{
    public function getInvoiceAmount(string $provider, $request): int|float
    {
        $data = $request->validated();

        $wifi_service = $this->checkProvider($provider);

        $wifi_service->setMonth($data['month'] ?: 1);

        $amount = $wifi_service->calculateTotalAmount();

        return $amount;
    }

    private function checkProvider(string $provider): Mpt|Ooredoo
    {
        $internet_service_provider = config('internetprovider.internetproviders');

        if (!in_array($provider, $internet_service_provider))
        {
            throw new CustomException('Wifi service not found', 404);
        }

        if ($provider == 'mpt')
        {
            $wifi_service = new Mpt();
        } else
        {
            $wifi_service = new Ooredoo();
        }

        return $wifi_service;
    }
}