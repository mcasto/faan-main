<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCAPTCHA v3 Test - FAAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-12">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">reCAPTCHA v3 Implementation Test</h1>

        <div class="space-y-6">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-green-800 mb-2">✅ Implementation Status</h2>
                <ul class="text-green-700 space-y-1 text-sm">
                    <li>• reCAPTCHA v3 Service: Implemented</li>
                    <li>• Validation Rule: Created</li>
                    <li>• Forms Updated: Donation & Contact forms</li>
                    <li>• Site Key: {{ config('services.recaptcha.site_key') }}</li>
                    <li>• Service Enabled: {{ config('services.recaptcha.enabled') ? 'Yes' : 'No' }}</li>
                </ul>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-blue-800 mb-2">🔧 How it Works</h2>
                <p class="text-blue-700 text-sm">
                    reCAPTCHA v3 runs invisibly in the background, analyzing user behavior to generate a score between
                    0.0 (bot) and 1.0 (human).
                    Forms with scores below 0.5 are rejected with user-friendly error messages.
                </p>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-yellow-800 mb-2">🎯 Actions Configured</h2>
                <ul class="text-yellow-700 space-y-1 text-sm">
                    <li>• <strong>donation_submit</strong>: Donation form submissions</li>
                    <li>• <strong>contact_submit</strong>: Contact form submissions</li>
                </ul>
            </div>

            <div class="text-center">
                <a href="/donations"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg mr-4">
                    Test Donation Form
                </a>
                <a href="/contact-us"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg">
                    Test Contact Form
                </a>
            </div>
        </div>

        <div class="mt-8 text-center text-xs text-gray-500">
            This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.
        </div>
    </div>

    @include('components.recaptcha-v3')
</body>

</html>
