<?php

namespace Tests\Unit\Services\RemoteInvoices;

use App\Enum\ERP;
use App\Exceptions\InvoiceNotFound;
use App\Services\DTO\Invoice;
use App\Services\RemoteInvoices\FortStocksInvoice;
use App\Services\RemoteInvoices\VizmaInvoice;
use Tests\TestCase;

class VizmaInvoiceTest extends TestCase
{
    public function test_valid_url_is_generated()
    {
        $id = 1;
        $invoice = new VizmaInvoice($id);
        $url = sprintf('%s/%s/%s', config('api.remote_base_url'), ERP::VIZMA->value, $id);

        $this->assertEquals($url, $invoice->url);
    }

    public function test_valid_response_is_received_incase_of_invalid_id()
    {
        $this->expectException(InvoiceNotFound::class);
        (new VizmaInvoice(1000))->fetch();
    }

    public function test_correct_response_is_received_on_valid_id()
    {
        $invoice = (new VizmaInvoice(1))->fetch();

        $this->assertInstanceOf(Invoice::class, $invoice, 'Vizma: Asserting that api response is formatted to get Invoice object');
    }
}
