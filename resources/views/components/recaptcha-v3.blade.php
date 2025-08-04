{{-- reCAPTCHA v3 component for including the script and handling token generation --}}
@if (config('services.recaptcha.enabled'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        // Initialize reCAPTCHA v3
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.ready(function() {
                    console.log('reCAPTCHA v3 initialized');
                });
            }
        });

        /**
         * Execute reCAPTCHA v3 for a given action and form
         * @param {string} action - The action to execute (e.g., 'submit', 'donation', 'contact')
         * @param {HTMLFormElement} form - The form element to add the token to
         * @param {function} callback - Optional callback function to execute after token is received
         */
        function executeRecaptcha(action, form, callback) {
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                            action: action
                        })
                        .then(function(token) {
                            // Add or update the reCAPTCHA token in the form
                            let tokenInput = form.querySelector('input[name="g-recaptcha-response"]');
                            if (!tokenInput) {
                                tokenInput = document.createElement('input');
                                tokenInput.type = 'hidden';
                                tokenInput.name = 'g-recaptcha-response';
                                form.appendChild(tokenInput);
                            }
                            tokenInput.value = token;

                            // Execute callback if provided
                            if (typeof callback === 'function') {
                                callback(token);
                            }
                        })
                        .catch(function(error) {
                            console.error('reCAPTCHA error:', error);
                            if (typeof callback === 'function') {
                                callback(null, error);
                            }
                        });
                });
            } else {
                console.warn('reCAPTCHA not loaded');
                if (typeof callback === 'function') {
                    callback(null, 'reCAPTCHA not loaded');
                }
            }
        }

        /**
         * Add reCAPTCHA to form submission
         * @param {string} formSelector - CSS selector for the form
         * @param {string} action - The reCAPTCHA action
         */
        function addRecaptchaToForm(formSelector, action = 'submit') {
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector(formSelector);
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        executeRecaptcha(action, form, function(token, error) {
                            if (token) {
                                // Token received, submit the form
                                form.submit();
                            } else {
                                console.error('Failed to get reCAPTCHA token:', error);
                                // Still allow form submission in case of reCAPTCHA issues
                                form.submit();
                            }
                        });
                    });
                }
            });
        }

        // Auto-initialize for common forms
        @if (!empty($autoInit))
            @foreach ($autoInit as $formSelector => $action)
                addRecaptchaToForm({!! json_encode($formSelector) !!}, {!! json_encode($action) !!});
            @endforeach
        @endif
    </script>
@else
    {{-- reCAPTCHA is disabled in configuration --}}
    <script>
        // Stub functions for when reCAPTCHA is disabled
        function executeRecaptcha(action, form, callback) {
            if (typeof callback === 'function') {
                callback('disabled');
            }
        }

        function addRecaptchaToForm(formSelector, action) {
            // Do nothing when reCAPTCHA is disabled
        }
    </script>
@endif
