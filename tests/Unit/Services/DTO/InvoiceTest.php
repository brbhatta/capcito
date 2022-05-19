<?php

namespace Tests\Unit\Services\DTO;

use App\Services\DTO\Invoice;
use App\Services\DTO\InvoiceDate;
use App\Services\DTO\InvoiceRow;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    /**
     * @throws \App\Exceptions\BoardSlotsException
     */
    public function test_invoice_object_is_valid(): void
    {
        $id = 1;
        $invoiceNumber = 101;
        $dates = InvoiceDate::build('2022-01-01', '2022-01-31');

        $rows = [
            new InvoiceRow(1, 100, 'Test 1'),
            new InvoiceRow(2, 100, 'Test 2')
        ];

        $invoice = new Invoice($id, $invoiceNumber, $dates, 'SEK', '7000', $rows);

        $this->assertEquals($invoice->getId(), $id, 'Asserting that invoice is returning correct id.');
        $this->assertEquals($invoice->getInvoiceNumber(), $invoiceNumber, 'Asserting that invoice is returning correct invoice number.');
        $this->assertIsArray($invoice->getDates(), 'Asserting that invoice is returning dates as array.');
        $this->assertCount(4, $invoice->getDates(), 'Asserting that invoice is returning correct dates.');
        $this->assertIsArray($invoice->getRows(), 'Asserting that invoice is returning correct rows as array.');
        $this->assertCount(2, $invoice->getRows(), 'Asserting that invoice is returning correct rows.');
    }
}
