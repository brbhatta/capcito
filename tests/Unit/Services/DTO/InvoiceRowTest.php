<?php

namespace Tests\Unit\Services\DTO;

use App\Services\DTO\InvoiceRow;
use Tests\TestCase;

class InvoiceRowTest extends TestCase
{
    function test_invoice_rows_are_correctly_formed()
    {
        $row = new InvoiceRow(2, 100, 'Test 2');

        $this->assertInstanceOf(InvoiceRow::class, $row, 'Asserting that invoice row returns correct instance.');

        $this->assertEquals(2, $row->getQuantity(), 'Asserting that quantity is correct.');
        $this->assertEquals(100, $row->getPrice(), 'Asserting that quantity is correct.');
        $this->assertEquals('Test 2', $row->getArticleName(), 'Asserting that quantity is correct.');

    }
}
