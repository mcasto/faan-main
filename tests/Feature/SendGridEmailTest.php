<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\SendGridService;
use App\Models\SubmittedData;

class SendGridEmailTest extends TestCase
{
    public function test_sendgrid_service_exists()
    {
        $service = app(SendGridService::class);
        $this->assertInstanceOf(SendGridService::class, $service);
    }

    public function test_contact_form_creates_database_record()
    {
        $response = $this->withSession(['_token' => 'test-token'])
            ->post('/contact', [
                '_token' => 'test-token',
                'name' => 'Test User',
                'email' => 'test@example.com',
                'subject' => 'Test Subject',
                'message' => 'Test message content',
                'g-recaptcha-response' => 'test-token' // This will be skipped since reCAPTCHA is disabled
            ]);

        // Should redirect back with success
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Should create a database record
        $this->assertDatabaseHas('submitted_data', [
            'type' => 'contacts'
        ]);
    }

    public function test_donation_form_creates_database_record()
    {
        $response = $this->withSession(['_token' => 'test-token'])
            ->post('/donations', [
                '_token' => 'test-token',
                'name' => 'Test Donor',
                'email' => 'donor@example.com',
                'donation_amount' => '50.00',
                'donation_type' => 'credit',
                'consent' => '1',
                'g-recaptcha-response' => 'test-token' // This will be skipped since reCAPTCHA is disabled
            ]);

        // Should redirect back with success
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Should create a database record
        $this->assertDatabaseHas('submitted_data', [
            'type' => 'donations'
        ]);
    }

    public function test_legacy_giving_form_creates_database_record()
    {
        $response = $this->withSession(['_token' => 'test-token'])
            ->post('/donations', [
                '_token' => 'test-token',
                'type' => 'legacy_giving',
                'name' => 'Test Legacy Donor',
                'phone' => '555-1234',
                'doc_num' => 'ABC123456',
                'email' => 'legacy@example.com',
                'address' => '123 Test Street, Test City',
                'donation_type' => 'fixed',
                'donation_info' => '$1000',
                'consent' => '1',
                'g-recaptcha-response' => 'test-token' // This will be skipped since reCAPTCHA is disabled
            ]);

        // Should redirect back with success
        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Should create a database record
        $this->assertDatabaseHas('submitted_data', [
            'type' => 'legacy_giving'
        ]);
    }
}
