<?php

namespace App\Services\RemoteInvoices;

use App\Enum\ERP;
use App\Exceptions\InvoiceNotFound;
use App\Services\Contracts\Actions\FetchesVizmaInvoice;
use App\Services\Contracts\HasRemoteInvoice;
use App\Services\DTO\Invoice;
use App\Services\DTO\InvoiceDate;
use App\Services\DTO\InvoiceRow;
use Illuminate\Support\Facades\Http;

final class VizmaInvoice extends AbstractRemoteInvoice implements HasRemoteInvoice
{
    public function __construct(string $id)
    {
        $this->url = sprintf('%s/%s/%s', config('api.remote_base_url'), ERP::VIZMA->value, $id);
    }

    /**
     * @throws InvoiceNotFound
     */
    protected function parseResponse(array $response): Invoice
    {
        if(empty($response) || isset($response['error'])) {
            throw new InvoiceNotFound('Invoice data not found');
        }

        return new Invoice(
            $response['Id'],
            $response['InvoiceNumber'],
            InvoiceDate::build($response['InvoiceDate'], $response['DueDate']),
            $response['CurrencyCode'],
            $response['TotalAmount'],
            $this->buildInvoiceRows($response['Rows'])
        );
    }

    protected function buildInvoiceRows(array $rows): array
    {
        $results = [];
        foreach ($rows as $row) {
            $results[] = (new InvoiceRow((int)$row['UnitPrice'] * $row['Quantity'], (int) $row['UnitPrice'], $row['Text']));
        }

        return $results;
    }
}
