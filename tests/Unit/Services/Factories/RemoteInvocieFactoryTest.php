<?php

namespace Tests\Unit\Services\Factories;

use App\Enum\ERP;
use App\Services\Factories\RemoteInvoiceFactory;
use App\Services\RemoteInvoices\FortStocksInvoice;
use App\Services\RemoteInvoices\VizmaInvoice;
use Tests\TestCase;

class RemoteInvocieFactoryTest extends TestCase
{
    public function test_if_correct_erp_class_is_returned()
    {
        $remoteInvoice = RemoteInvoiceFactory::create(ERP::FORT_SOCKS->value, 1);
        $this->assertInstanceOf(FortStocksInvoice::class, $remoteInvoice, 'Asserting that remote invoice mapping is correct for Fort stocks');

        $remoteInvoice = RemoteInvoiceFactory::create(ERP::VIZMA->value, 1);
        $this->assertInstanceOf(VizmaInvoice::class, $remoteInvoice, 'Asserting that remote invoice mapping is correct for vizma');
    }
}
