<?php

namespace App\Services\RemoteInvoices;

use App\Services\DTO\Invoice;
use Illuminate\Support\Facades\Http;

abstract class AbstractRemoteInvoice
{
    public string $url;

    abstract protected function parseResponse(array $response): Invoice;

    abstract protected function buildInvoiceRows(array $rows): array;

    public function fetch(): Invoice
    {
        $response = $this->executeApiCall();
        return $this->parseResponse($response);
    }

    protected function executeApiCall(): array
    {
        return Http::get($this->url)->json();
    }
}
