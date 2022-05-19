<?php

namespace Tests\Feature;

use App\Enum\ERP;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiCallTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_correct_response_for_fort()
    {
        $response = $this->get(sprintf('/api/invoices/%s/%s', ERP::FORT_SOCKS->value, '9f587e13-682e-4d91-867f-fd3aec3b70b8'));
        $response->assertStatus(200);
        $this->assertJson($response->content(), 'Asserting that response is JSON object.');

        $responseArray = json_decode($response->content(), true);
        $this->assertArrayNotHasKey('data', $responseArray, 'Fort: Asserting that data wapper is not there.');
        $this->assertArrayHasKey('id', $responseArray, 'Fort: Asserting that id is present.');
        $this->assertArrayHasKey('invoice_nr', $responseArray, 'Fort: Asserting that invoice_nr is present.');
        $this->assertArrayHasKey('dates', $responseArray, 'Fort: Asserting that dates is present.');
        $this->assertArrayHasKey('currency', $responseArray, 'Fort: Asserting that currency is present.');
        $this->assertArrayHasKey('total_amount', $responseArray, 'Fort: Asserting that total_amount is present.');
        $this->assertArrayHasKey('custom_notes', $responseArray, 'Fort: Asserting that custom_notes is present.');
        $this->assertArrayHasKey('rows', $responseArray, 'Fort: Asserting that rows is present.');
    }

    public function test_the_application_returns_correct_response_for_vizma()
    {
        $response = $this->get(sprintf('/api/invoices/%s/%s', ERP::VIZMA->value, 1));
        $response->assertStatus(200);

        $responseArray = json_decode($response->content(), true);

        $this->assertArrayNotHasKey('data', $responseArray, 'Vizma: Asserting that data wapper is not there.');
        $this->assertArrayHasKey('id', $responseArray, 'Vizma: Asserting that id is present.');
        $this->assertArrayHasKey('invoice_nr', $responseArray, 'Vizma: Asserting that invoice_nr is present.');
        $this->assertArrayHasKey('dates', $responseArray, 'Vizma: Asserting that dates is present.');
        $this->assertArrayHasKey('currency', $responseArray, 'Vizma: Asserting that currency is present.');
        $this->assertArrayHasKey('total_amount', $responseArray, 'Vizma: Asserting that total_amount is present.');
        $this->assertArrayHasKey('custom_notes', $responseArray, 'Vizma: Asserting that custom_notes is present.');
        $this->assertArrayHasKey('rows', $responseArray, 'Vizma: Asserting that rows is present.');
    }
}
