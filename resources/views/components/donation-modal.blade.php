{{-- Donation Type Information Modal --}}
<div x-data="{
    showModal: false,
    modalType: 'credit',
    init() {
        document.addEventListener('open-donation-modal', (event) => {
            this.modalType = event.detail.type;
            this.showModal = true;
        });
    }
}">
    {{-- Modal Backdrop --}}
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" @click="showModal = false">

        {{-- Modal Content --}}
        <div x-show="showModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto" @click.stop>

            {{-- Modal Header --}}
            <div class="flex justify-between items-center p-6 border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    <span x-show="modalType === 'credit'">
                        {{ app()->getLocale() === 'es' ? 'Donar con Tarjeta de Crédito o PayPal' : 'Donate with Credit Card or PayPal' }}
                    </span>
                    <span x-show="modalType === 'transfer'">
                        {{ app()->getLocale() === 'es' ? 'Donación mediante Transferencia Bancaria Ecuatoriana' : 'Donation by Ecuadorian Bank Transfer' }}
                    </span>
                    <span x-show="modalType === 'pickup'">
                        {{ app()->getLocale() === 'es' ? 'Recogida por Voluntario FAAN' : 'Pickup by FAAN Volunteer' }}
                    </span>
                </h3>
                <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-6">
                {{-- Credit Card / PayPal Content --}}
                <div x-show="modalType === 'credit'" class="space-y-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-medium">
                            {{ app()->getLocale() === 'es' ? '¡Gracias por donar!' : 'Thank you for donating!' }}
                        </p>
                    </div>

                    <div class="prose prose-sm max-w-none text-gray-700">
                        <p>
                            {{ app()->getLocale() === 'es'
                                ? 'Cuando haces clic en el enlace o usas el código QR a continuación, serás llevado a un formulario de pago en el sitio web de PayPal. Ingrese el monto de su donación y envíela tu donación.'
                                : 'When you click the link or use the QR code below, you will be taken to a checkout form on the PayPal website. Enter your donation amount and submit your donation.' }}
                        </p>
                        <p>
                            {{ app()->getLocale() === 'es'
                                ? 'Tendrá que volver a ingresar cierta información. Pedimos disculpas por cualquier inconveniente, pero actualmente está fuera de nuestro control.'
                                : 'You will have to reenter some information. We apologize for any inconvenience, but it is currently beyond our control.' }}
                        </p>
                        <p>
                            {{ app()->getLocale() === 'es'
                                ? 'Después de completar su donación a través de su sistema, cierre la pestaña o ventana. Ellos procesarán su donación y nos harán saber. No será necesario realizar ninguna otra acción en nuestro sitio en ese momento.'
                                : 'After completing your donation through their system, close the tab or window. They will process your donation and let us know. No further action will be required on our site at that point.' }}
                        </p>
                    </div>

                    <div class="flex flex-col items-center bg-gray-50 rounded-lg p-6">
                        <a href="{{ app()->getLocale() === 'es' ? 'https://www.paypal.com/ncp/payment/UZGGUKX4B5FP2' : 'https://www.paypal.com/ncp/payment/3HBLEDRD2A5MQ' }}"
                            target="_blank"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg mb-4 transition duration-200">
                            PayPal
                        </a>
                        <img src="{{ app()->getLocale() === 'es' ? '/images/paypal-qr-code-es.jpeg' : '/images/paypal-qr-code-en.jpeg' }}"
                            alt="PayPal QR Code" class="max-w-xs rounded-lg shadow-sm">
                    </div>
                </div>

                {{-- Bank Transfer Content --}}
                <div x-show="modalType === 'transfer'" class="space-y-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-medium">
                            {{ app()->getLocale() === 'es' ? '¡Gracias por donar!' : 'Thank you for donating!' }}
                        </p>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-700 mb-6">
                            {{ app()->getLocale() === 'es'
                                ? 'Si estás en Ecuador, puedes transferir tu donación a nuestra cuenta oficial.'
                                : 'If you\'re in Ecuador, you can transfer your donation to our official account.' }}
                        </p>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <img src="/images/donations-bank-transfer.jpg" alt="Bank Transfer Information"
                                class="max-w-full h-auto rounded-lg shadow-sm mx-auto mb-4">
                            <p class="text-center font-semibold text-gray-800">
                                Fundación Familia Amor Animal
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Pickup Content --}}
                <div x-show="modalType === 'pickup'" class="space-y-4">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800 font-medium">
                            {{ app()->getLocale() === 'es' ? '¡Gracias por donar!' : 'Thank you for donating!' }}
                        </p>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-700">
                            {{ app()->getLocale() === 'es'
                                ? 'Un voluntario de FAAN le enviará un correo electrónico pronto para coordinar la recogida de su donación.'
                                : 'A FAAN volunteer will email you soon to arrange to pick up your donation.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="flex justify-end p-6 border-t bg-gray-50">
                <button @click="showModal = false"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    {{ app()->getLocale() === 'es' ? 'Cerrar' : 'Close' }}
                </button>
            </div>
        </div>
    </div>
</div>
