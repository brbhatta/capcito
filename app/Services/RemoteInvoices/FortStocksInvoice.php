<?php

namespace App\Services\RemoteInvoices;

use App\Enum\ERP;
use App\Exceptions\InvoiceNotFound;
use App\Services\Contracts\HasRemoteInvoice;
use App\Services\DTO\Invoice;
use App\Services\DTO\InvoiceDate;
use App\Services\DTO\InvoiceRow;

final class FortStocksInvoice extends AbstractRemoteInvoice implements HasRemoteInvoice
{
    public function __construct(string $id)
    {
        $this->url = sprintf('%s/%s/%s', config('api.remote_base_url'), ERP::FORT_SOCKS->value, $id);
    }

    protected function parseResponse(array $response): Invoice
    {
        if(empty($response) || isset($response['error'])) {
            throw new InvoiceNotFound('Invoice data not found');
        }

        return new Invoice(
            $response['invoice-nr'],
            $response['invoice-nr'],
            InvoiceDate::build($response['invoice-date'], $response['due-date']),
            $response['currency'],
            $response['amount'],
            $this->buildInvoiceRows($response['rows'])
        );
    }

    protected function buildInvoiceRows(array $rows): array
    {
        $results = [];
        foreach ($rows as $row) {
            $results[] = (new InvoiceRow((int) $row['quantity'], (int) $row['price'], $row['product-name']));
        }

        return $results;
    }
}
