<?php

namespace Tests\Feature;

use Tests\TestCase;

class DHLAddressTest extends TestCase
{
    public function testTransformAddressSingleLineSuccess()
    {
        $payload = [
            'address1' => 'Business Office, Malcolm Long 92911 Proin Road Lake Charles Maine',
            'address2' => '',
            'address3' => '',
        ];

        $expectedAddress = json_encode([
            'address1' => 'Business Office, Malcolm Long',
            'address2' => '92911 Proin Road Lake Charles',
            'address3' => 'Maine',
        ]);

        $this->json('POST', '/api/dhl-address', $payload)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'dhl_address' => $expectedAddress,
                'message' => 'Transformed to DHL compliance address.'
            ]);

    }

    public function testTransformAddressWithExtraSpaces()
    {
        /* with extra spaces */
        $payload = [
            'address1' => '   Business Office, Malcolm Long 92911 ',
            'address2' => 'Proin           Road Lake Charles    Maine',
            'address3' => '                        ',
        ];

        $expectedAddress = json_encode([
            'address1' => 'Business Office, Malcolm Long',
            'address2' => '92911 Proin Road Lake Charles',
            'address3' => 'Maine',
        ]);

        $this->json('POST', '/api/dhl-address', $payload)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'dhl_address' => $expectedAddress,
                'message' => 'Transformed to DHL compliance address.'
            ]);

    }

    public function testTransformAddressSingleLineFail()
    {
        /* with extra spaces */
        $payload = [
            'address1' => 'Business Office, Malcolm Long Panjang 92911 Proin Road Lake Charles Maine, United State of America',
            'address2' => '',
            'address3' => '',
        ];

        $this->json('POST', '/api/dhl-address', $payload)
            ->assertStatus(400)
            ->assertJson([
                'status' => 'failed',
                'dhl_address' => '',
                'message' => 'Incoming address length exceed limit.'
            ]);

    }
    
    public function testTransformAddressMultilineFail()
    {
        /* with extra spaces */
        $payload = [
            'address1' => 'Business Office, Malcolm Long Panjang',
            'address2' => '92911 Proin Road Lake Charles Maine, United State of America',
            'address3' => 'Earth Federation',
        ];

        $this->json('POST', '/api/dhl-address', $payload)
            ->assertStatus(400)
            ->assertJson([
                'status' => 'failed',
                'dhl_address' => '',
                'message' => 'Incoming address length exceed limit.'
            ]);

    }

}
