<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\RecaptchaV3Service;
use Illuminate\Http\Request;

class RecaptchaV3Test extends TestCase
{
    public function test_recaptcha_service_is_enabled()
    {
        $service = app(RecaptchaV3Service::class);

        // Test that service is enabled when keys are present
        $this->assertTrue($service->isEnabled());

        // Test that we can get the site key
        $siteKey = $service->getSiteKey();
        $this->assertNotEmpty($siteKey);
        $this->assertEquals(config('services.recaptcha.site_key'), $siteKey);
    }

    public function test_recaptcha_validation_rule_exists()
    {
        // Test that the validation rule can be instantiated
        $request = Request::create('/test', 'POST', ['g-recaptcha-response' => 'test-token']);
        $rule = new \App\Rules\RecaptchaV3Rule($request, 'test_action', 0.5);

        $this->assertInstanceOf(\App\Rules\RecaptchaV3Rule::class, $rule);
    }

    public function test_recaptcha_config_is_loaded()
    {
        $this->assertNotEmpty(config('services.recaptcha.site_key'));
        $this->assertNotEmpty(config('services.recaptcha.secret_key'));
        $this->assertTrue(config('services.recaptcha.enabled'));
    }
}
