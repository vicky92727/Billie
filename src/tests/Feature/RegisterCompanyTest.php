<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class RegisterCompanyTest extends TestCase
{
    use RefreshDatabase;
    
    public function testsRegistersSuccessfully()
    {

        $payload = [
            "title" => "WHBx",
            "email" => "whafeez25@whbx.co",
            "phone" => "+923464535533",
            "address" => "14, Mehmood Park Shahdara Town Lahore Pakistan",
            "type" => 1,
            "debtor_limit" => 5
        ];

        $this->json('post', '/api/companies', $payload)
            ->assertStatus(200);
    }
}
