<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternetProvider\InvoiceFormRequest;
use App\Services\InternetServiceProvider\InternetProviderInvoice;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    use ResponseTrait;

    protected InternetProviderInvoice $internetProviderInvoice;

    public function __construct(InternetProviderInvoice $internetProviderInvoice)
    {
        $this->internetProviderInvoice = $internetProviderInvoice;
    }

    public function getMptInvoiceAmount(Request $request)
    {
        $mpt = new Mpt();
        $mpt->setMonth($request->get('month') ?: 1);
        $amount = $mpt->calculateTotalAmount();
        
        return response()->json([
            'data' => $amount
        ]);
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $ooredoo = new Ooredoo();
        $ooredoo->setMonth($request->get('month') ?: 1);
        $amount = $ooredoo->calculateTotalAmount();
        
        return response()->json([
            'data' => $amount
        ]);
    }

    public function getInvoiceAmount(InvoiceFormRequest $request, $provider): JsonResponse
    {
        $amount = $this->internetProviderInvoice->getInvoiceAmount($provider, $request);

        return $this->responseSuccess('success', $amount);
    }
}
