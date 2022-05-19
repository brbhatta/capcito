<?php

namespace Tests\Unit\Services\RemoteInvoices;

use App\Enum\ERP;
use App\Exceptions\InvoiceNotFound;
use App\Services\DTO\Invoice;
use App\Services\RemoteInvoices\FortStocksInvoice;
use Tests\TestCase;

class FortStocksInvoiceTest extends TestCase
{
    public function test_valid_url_is_generated()
    {
        $id = 1;
        $invoice = new FortStocksInvoice($id);
        $url = sprintf('%s/%s/%s', config('api.remote_base_url'), ERP::FORT_SOCKS->value, $id);

        $this->assertEquals($url, $invoice->url);
    }

    public function test_valid_response_is_received_incase_of_invalid_id()
    {
        $this->expectException(InvoiceNotFound::class, 'Asserting that invoice not found exception is thrown.');
        (new FortStocksInvoice(1))->fetch();
    }

    public function test_correct_response_is_received_on_valid_id()
    {
        $invoice = (new FortStocksInvoice('9f587e13-682e-4d91-867f-fd3aec3b70b8'))->fetch();

        $this->assertInstanceOf(Invoice::class, $invoice, 'FortStock: Asserting that api response is formatted to get Invoice object');
    }
}
