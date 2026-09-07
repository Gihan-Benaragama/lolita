<div>
    {{-- progress indicator --}}
    <div class="mb-10 flex items-center justify-between">
        @foreach (['Address', 'Shipping', 'Payment', 'Review'] as $i => $label)
            <div class="flex flex-1 items-center">
                <div class="flex h-9 w-9 items-center justify-center rounded-full text-sm font-medium transition-colors duration-300
                    {{ $step > $i + 1 ? 'bg-sage text-white' : ($step === $i + 1 ? 'bg-wine text-white' : 'bg-rose/10 text-ink/40') }}">
                    {{ $i + 1 }}
                </div>
                <span class="ml-2 hidden text-sm sm:inline {{ $step === $i + 1 ? 'text-wine' : 'text-ink/40' }}">{{ $label }}</span>
                @if (!$loop->last)
                    <div class="mx-3 h-px flex-1 {{ $step > $i + 1 ? 'bg-sage' : 'bg-rose/10' }}"></div>
                @endif
            </div>
        @endforeach
    </div>

    @if (session('error'))
        <div class="mb-6 rounded-xl bg-wine/10 p-4 text-sm text-wine">{{ session('error') }}</div>
    @endif

    {{-- STEP 1: ADDRESS --}}
    @if ($step === 1)
        <div class="space-y-4">
            <h2 class="font-display text-2xl italic text-wine">Shipping address</h2>

            <input wire:model.blur="full_name" placeholder="Full name" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
            @error('full_name') <p class="text-xs text-wine">{{ $message }}</p> @enderror

            <input wire:model.blur="address_line1" placeholder="Address line 1" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
            @error('address_line1') <p class="text-xs text-wine">{{ $message }}</p> @enderror

            <input wire:model.blur="address_line2" placeholder="Address line 2 (optional)" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input wire:model.blur="city" placeholder="City" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
                    @error('city') <p class="text-xs text-wine">{{ $message }}</p> @enderror
                </div>
                <div>
                    <input wire:model.blur="postal_code" placeholder="Postal code" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
                    @error('postal_code') <p class="text-xs text-wine">{{ $message }}</p> @enderror
                </div>
            </div>

            <input wire:model.blur="country" placeholder="Country" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
            @error('country') <p class="text-xs text-wine">{{ $message }}</p> @enderror

            <input wire:model.blur="phone" placeholder="Phone number" class="w-full rounded-xl border-rose/30 focus:border-rose focus:ring-rose/20">
            @error('phone') <p class="text-xs text-wine">{{ $message }}</p> @enderror

            <button wire:click="nextStep" class="btn-primary mt-4 w-full">Continue to shipping</button>
        </div>
    @endif

    {{-- STEP 2: SHIPPING --}}
    @if ($step === 2)
        <div class="space-y-4">
            <h2 class="font-display text-2xl italic text-wine">Shipping method</h2>

            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-rose/30 p-4 has-[:checked]:border-wine has-[:checked]:bg-wine/5">
                <span>
                    <input type="radio" wire:model="shipping_method" value="standard" class="mr-3 text-wine focus:ring-rose/20">
                    Standard (3–5 days)
                </span>
                <span>$5.00</span>
            </label>

            <label class="flex cursor-pointer items-center justify-between rounded-xl border border-rose/30 p-4 has-[:checked]:border-wine has-[:checked]:bg-wine/5">
                <span>
                    <input type="radio" wire:model="shipping_method" value="express" class="mr-3 text-wine focus:ring-rose/20">
                    Express (1–2 days)
                </span>
                <span>$15.00</span>
            </label>

            <div class="flex gap-3">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                <button wire:click="nextStep" class="btn-primary flex-1">Continue to payment</button>
            </div>
        </div>
    @endif

    {{-- STEP 3: PAYMENT --}}
    @if ($step === 3)
        <div class="space-y-4">
            <h2 class="font-display text-2xl italic text-wine">Payment</h2>
            <p class="text-sm text-ink/60">Your payment information is securely handled by Stripe. We never store your card details.</p>

            {{-- Stripe Card Element --}}
            <div class="rounded-xl border border-rose/30 bg-white p-4 shadow-sm">
                <label class="block text-xs uppercase tracking-widest text-ink/50 mb-3">Card Details</label>
                <div id="stripe-card-element" class="min-h-[44px]">
                    {{-- Stripe.js mounts here --}}
                </div>
                <div id="stripe-card-errors" class="mt-2 text-xs text-red-500 hidden"></div>
            </div>

            {{-- Security note --}}
            <div class="flex items-center gap-2 text-xs text-ink/40">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.955 11.955 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.248-8.25-3.286z" />
                </svg>
                Secured by Stripe · 256-bit TLS encryption
            </div>

            <div class="flex gap-3">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                <button id="stripe-pay-btn" class="btn-primary flex-1" type="button">Review order →</button>
            </div>
        </div>

        {{-- Stripe.js --}}
        <script src="https://js.stripe.com/v3/"></script>
        <script>
        (function() {
            function mountStripe() {
                const container = document.getElementById('stripe-card-element');
                if (!container || container.querySelector('iframe')) return; // already mounted

                const stripe = Stripe('{{ config("services.stripe.key") ?? "pk_test_placeholder" }}');

                const appearance = {
                    theme: 'stripe',
                    variables: {
                        colorPrimary: '#6E2A3A',
                        colorBackground: '#ffffff',
                        colorText: '#2C1A1A',
                        colorDanger: '#df1b41',
                        fontFamily: '"Jost", ui-sans-serif, system-ui, sans-serif',
                        spacingUnit: '4px',
                        borderRadius: '8px',
                        colorIconCardError: '#6E2A3A',
                    },
                    rules: {
                        '.Input': {
                            border: '1px solid #e8c8d0',
                            padding: '10px 14px',
                            fontSize: '14px',
                        },
                        '.Input:focus': {
                            border: '1px solid #6E2A3A',
                            boxShadow: '0 0 0 3px rgba(110,42,58,0.12)',
                        },
                        '.Label': {
                            fontSize: '11px',
                            textTransform: 'uppercase',
                            letterSpacing: '0.08em',
                            color: '#9a6e75',
                        },
                    },
                };

                const elements = stripe.elements({ appearance });
                const card = elements.create('card', {
                    style: {
                        base: {
                            color: '#2C1A1A',
                            fontFamily: '"Jost", sans-serif',
                            fontSize: '14px',
                            '::placeholder': { color: '#c4a0a8' },
                        },
                        invalid: { color: '#df1b41', iconColor: '#6E2A3A' },
                    },
                    hidePostalCode: false,
                });
                card.mount('#stripe-card-element');

                const errorsEl = document.getElementById('stripe-card-errors');
                card.on('change', ({ error }) => {
                    if (error) {
                        errorsEl.textContent = error.message;
                        errorsEl.classList.remove('hidden');
                    } else {
                        errorsEl.classList.add('hidden');
                    }
                });

                // "Review order" button — for now just advance the wizard step
                document.getElementById('stripe-pay-btn').addEventListener('click', function () {
                    @this.call('nextStep');
                });
            }

            // Mount on page load and after every Livewire update
            document.addEventListener('DOMContentLoaded', mountStripe);
            document.addEventListener('livewire:navigated', mountStripe);
            document.addEventListener('livewire:update', function() {
                setTimeout(mountStripe, 100);
            });
        })();
        </script>
    @endif


    {{-- STEP 4: REVIEW --}}
    @if ($step === 4)
        <div class="space-y-6">
            <h2 class="font-display text-2xl italic text-wine">Review your order</h2>

            <div class="rounded-xl bg-white p-5 text-sm">
                <p class="font-medium text-wine">Shipping to</p>
                <p class="text-ink/70">{{ $full_name }}, {{ $address_line1 }}, {{ $city }} {{ $postal_code }}, {{ $country }}</p>
            </div>

            <div class="rounded-xl bg-white p-5 text-sm">
                <p class="font-medium text-wine">Shipping method</p>
                <p class="text-ink/70">{{ ucfirst($shipping_method) }} — Rs. {{ number_format($this->shippingCost(), 2) }}</p>
            </div>

            <div class="flex gap-3">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                <button wire:click="placeOrder" wire:loading.attr="disabled" class="btn-primary flex-1">
                    <span wire:loading.remove wire:target="placeOrder">Place order</span>
                    <span wire:loading wire:target="placeOrder">Placing order…</span>
                </button>
            </div>
        </div>
    @endif
</div>
