<?php

namespace Tests\Unit\Services\DTO;

use App\Services\DTO\InvoiceDate;
use Carbon\Carbon;
use Tests\TestCase;

class InvoiceDatesTest extends TestCase
{
    public function test_dates_are_set_properly()
    {
        $date = InvoiceDate::build('2022-01-01', '2022-01-31');

        $this->assertEquals('Y-m-d H:i:s', InvoiceDate::DATE_FORMAT, 'Asserting that date format is correctly setup');

        $this->assertInstanceOf(InvoiceDate::class, $date, 'Asserting that invoice date returns correct instance.');

        $this->assertNotEmpty(Carbon::createFromFormat(InvoiceDate::DATE_FORMAT, $date->getIssueDate()), 'Asserting that issue date is in correct format.');
        $this->assertNotEmpty(Carbon::createFromFormat(InvoiceDate::DATE_FORMAT, $date->getDueDate()), 'Asserting that due date is in correct format.');
        $this->assertNotEmpty(Carbon::createFromFormat(InvoiceDate::DATE_FORMAT, $date->getCreatedAt()), 'Asserting that created at is in correct format.');
        $this->assertNotEmpty(Carbon::createFromFormat(InvoiceDate::DATE_FORMAT, $date->getUpdatedAt()), 'Asserting that updated at is in correct format.');

    }
}
