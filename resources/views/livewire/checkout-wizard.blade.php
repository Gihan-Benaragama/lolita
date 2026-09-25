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

            <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-rose/30 p-4 transition-all has-[:checked]:border-wine has-[:checked]:bg-wine/5">
                <span class="flex items-center gap-3">
                    <input type="radio" wire:model="shipping_method" value="standard" class="text-wine focus:ring-rose/20">
                    <div>
                        <p class="font-medium text-ink">Standard Delivery</p>
                        <p class="text-xs text-ink/50">Delivered in 3–5 business days</p>
                    </div>
                </span>
                <span class="font-semibold text-wine">Rs. 300.00</span>
            </label>

            <label class="flex cursor-pointer items-center justify-between rounded-2xl border border-rose/30 p-4 transition-all has-[:checked]:border-wine has-[:checked]:bg-wine/5">
                <span class="flex items-center gap-3">
                    <input type="radio" wire:model="shipping_method" value="express" class="text-wine focus:ring-rose/20">
                    <div>
                        <p class="font-medium text-ink">Express Delivery</p>
                        <p class="text-xs text-ink/50">Delivered in 1–2 business days</p>
                    </div>
                </span>
                <span class="font-semibold text-wine">Rs. 750.00</span>
            </label>

            <div class="flex gap-3 pt-2">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                <button wire:click="nextStep" class="btn-primary flex-1">Continue to payment</button>
            </div>
        </div>
    @endif

    {{-- STEP 3: PAYMENT --}}
    @if ($step === 3)
        <div class="space-y-6">
            <div>
                <h2 class="font-display text-2xl italic text-wine">Select Payment Method</h2>
                <p class="text-sm text-ink/60">Choose how you would like to complete your order. All transactions are 100% secure.</p>
            </div>

            @error('payment_method')
                <p class="text-xs text-wine font-medium">{{ $message }}</p>
            @enderror

            <div class="space-y-3">

                {{-- Option 1: Direct Credit / Debit Card --}}
                <div class="rounded-2xl border transition-all duration-300 {{ $payment_method === 'card' ? 'border-wine bg-wine/5 shadow-md ring-1 ring-wine/20' : 'border-rose/20 bg-white hover:border-rose/40' }}">
                    <label class="flex cursor-pointer items-start p-4 gap-3.5">
                        <input type="radio" wire:model.live="payment_method" value="card" class="mt-1 text-wine focus:ring-rose/20">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-wine text-base">Credit or Debit Card</span>
                                <div class="flex items-center gap-1">
                                    <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-[10px] font-bold text-ink/70">VISA</span>
                                    <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-[10px] font-bold text-ink/70">Mastercard</span>
                                    <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-[10px] font-bold text-ink/70">AMEX</span>
                                </div>
                            </div>
                            <p class="mt-0.5 text-xs text-ink/60">Direct & instant payment confirmation with bank-level encryption.</p>
                        </div>
                    </label>

                    {{-- Card Fields Container --}}
                    @if ($payment_method === 'card')
                        <div class="px-5 pb-5 pt-2 border-t border-rose/15 space-y-4">
                            <div>
                                <label class="block text-xs uppercase tracking-widest text-ink/60 font-medium mb-1.5">Cardholder Name</label>
                                <input wire:model.blur="card_name" placeholder="Name on card"
                                    class="w-full rounded-xl border-rose/30 bg-white px-4 py-2.5 text-sm focus:border-wine focus:ring-wine/20 text-ink">
                                @error('card_name') <p class="text-xs text-wine mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs uppercase tracking-widest text-ink/60 font-medium mb-1.5">Card Number</label>
                                <div class="relative">
                                    <input wire:model.blur="card_number" placeholder="4111 2222 3333 4444"
                                        class="w-full rounded-xl border-rose/30 bg-white px-4 py-2.5 text-sm focus:border-wine focus:ring-wine/20 text-ink pr-12">
                                    <div class="absolute right-3.5 top-1/2 -translate-y-1/2 text-ink/30 pointer-events-none">
                                        <svg class="h-5 w-7" viewBox="0 0 32 20" fill="currentColor">
                                            <rect width="32" height="20" rx="3" fill="#E5E7EB"/>
                                            <circle cx="12" cy="10" r="6" fill="#9CA3AF"/>
                                            <circle cx="20" cy="10" r="6" fill="#6B7280" fill-opacity="0.7"/>
                                        </svg>
                                    </div>
                                </div>
                                @error('card_number') <p class="text-xs text-wine mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs uppercase tracking-widest text-ink/60 font-medium mb-1.5">Expiry Date</label>
                                    <input wire:model.blur="card_expiry" placeholder="MM / YY"
                                        class="w-full rounded-xl border-rose/30 bg-white px-4 py-2.5 text-sm focus:border-wine focus:ring-wine/20 text-ink">
                                    @error('card_expiry') <p class="text-xs text-wine mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs uppercase tracking-widest text-ink/60 font-medium mb-1.5">CVV / CVC</label>
                                    <input wire:model.blur="card_cvc" placeholder="123" maxlength="4"
                                        class="w-full rounded-xl border-rose/30 bg-white px-4 py-2.5 text-sm focus:border-wine focus:ring-wine/20 text-ink">
                                    @error('card_cvc') <p class="text-xs text-wine mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Option 2: PayHere Sri Lanka Gateway --}}
                <div class="rounded-2xl border transition-all duration-300 {{ $payment_method === 'payhere' ? 'border-wine bg-wine/5 shadow-md ring-1 ring-wine/20' : 'border-rose/20 bg-white hover:border-rose/40' }}">
                    <label class="flex cursor-pointer items-start p-4 gap-3.5">
                        <input type="radio" wire:model.live="payment_method" value="payhere" class="mt-1 text-wine focus:ring-rose/20">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-wine text-base">PayHere Online Gateway</span>
                                    <span class="rounded-full bg-emerald-50 border border-emerald-200 px-2 py-0.5 text-[10px] font-semibold text-emerald-700 uppercase tracking-wider">Official Gateway</span>
                                </div>
                            </div>
                            <p class="mt-0.5 text-xs text-ink/60">Pay securely via Cards, eZ Cash, mCash, or Sampath Vishwa Net Banking.</p>
                            
                            <div class="mt-2.5 flex flex-wrap items-center gap-1.5 text-[10px]">
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">VISA</span>
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">Mastercard</span>
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">AMEX</span>
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">eZ Cash</span>
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">mCash</span>
                                <span class="rounded bg-ivory border border-rose/15 px-2 py-0.5 text-ink/60 font-medium">Sampath Vishwa</span>
                            </div>
                        </div>
                    </label>
                </div>

                {{-- Option 3: Cash on Delivery (COD) --}}
                <div class="rounded-2xl border transition-all duration-300 {{ $payment_method === 'cod' ? 'border-wine bg-wine/5 shadow-md ring-1 ring-wine/20' : 'border-rose/20 bg-white hover:border-rose/40' }}">
                    <label class="flex cursor-pointer items-start p-4 gap-3.5">
                        <input type="radio" wire:model.live="payment_method" value="cod" class="mt-1 text-wine focus:ring-rose/20">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-wine text-base">Cash on Delivery (COD)</span>
                                    <span class="rounded-full bg-blue-50 border border-blue-200 px-2 py-0.5 text-[10px] font-semibold text-blue-700 uppercase tracking-wider">Doorstep Payment</span>
                                </div>
                            </div>
                            <p class="mt-0.5 text-xs text-ink/60">Pay cash upon delivery when your luxury bouquet arrives at your doorstep. Available islandwide in Sri Lanka.</p>
                        </div>
                    </label>
                </div>


            </div>

            {{-- Bank level security assurance badge --}}
            <div class="flex items-center gap-3 rounded-2xl bg-ivory/80 border border-rose/15 p-4 text-xs text-ink/70 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-wine/10 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-wine" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-wine">PCI-DSS Compliant & 256-Bit TLS Encrypted</p>
                    <p class="text-ink/50 text-[11px]">Your financial information is transmitted over a encrypted connection and is never stored on our servers.</p>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                @if ($payment_method === 'payhere')
                    <button wire:click="placeOrder" wire:loading.attr="disabled" class="btn-primary flex-1 bg-wine text-ivory hover:bg-wine/90 shadow-md">
                        <span wire:loading.remove wire:target="placeOrder">Pay with PayHere Popup →</span>
                        <span wire:loading wire:target="placeOrder">Opening PayHere…</span>
                    </button>
                @else
                    <button wire:click="nextStep" class="btn-primary flex-1">Review order →</button>
                @endif
            </div>
        </div>
    @endif

    {{-- STEP 4: REVIEW --}}
    @if ($step === 4)
        <div class="space-y-6">
            <h2 class="font-display text-2xl italic text-wine">Review your order</h2>

            <div class="rounded-2xl bg-white border border-rose/15 p-5 text-sm space-y-1 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-ink/40 font-medium">Shipping Address</p>
                <p class="font-medium text-wine text-base">{{ $full_name }}</p>
                <p class="text-ink/70">{{ $address_line1 }}{{ $address_line2 ? ', ' . $address_line2 : '' }}</p>
                <p class="text-ink/70">{{ $city }} {{ $postal_code }}, {{ $country }}</p>
                <p class="text-xs text-ink/50 mt-1">Phone: {{ $phone }}</p>
            </div>

            <div class="rounded-2xl bg-white border border-rose/15 p-5 text-sm space-y-1 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-ink/40 font-medium">Shipping Method</p>
                <p class="font-medium text-wine text-base">{{ ucfirst($shipping_method) }} Delivery</p>
                <p class="text-ink/70">Rs. {{ number_format($this->shippingCost(), 2) }}</p>
            </div>

            <div class="rounded-2xl bg-white border border-rose/15 p-5 text-sm space-y-1 shadow-sm">
                <p class="text-xs uppercase tracking-widest text-ink/40 font-medium">Payment Method</p>
                <p class="font-medium text-wine text-base">
                    @if ($payment_method === 'card')
                        Credit / Debit Card ({{ $card_number ? '•••• ' . substr(str_replace(' ', '', $card_number), -4) : 'Card Details Provided' }})
                    @elseif ($payment_method === 'payhere')
                        PayHere Online Gateway (Popup Modal)
                    @elseif ($payment_method === 'cod')
                        Cash on Delivery (COD)
                    @endif
                </p>
                <p class="text-xs text-ink/60">
                    @if ($payment_method === 'card')
                        Direct card payment processed upon order placement.
                    @elseif ($payment_method === 'payhere')
                        Opens PayHere secure popup modal overlay to complete payment without leaving this page.
                    @elseif ($payment_method === 'cod')
                        Cash payment collected upon delivery at your doorstep.
                    @endif
                </p>
            </div>

            <div class="flex gap-3">
                <button wire:click="previousStep" class="btn-outline flex-1">Back</button>
                <button wire:click="placeOrder" wire:loading.attr="disabled" class="btn-primary flex-1">
                    <span wire:loading.remove wire:target="placeOrder">
                        {{ $payment_method === 'payhere' ? 'Pay with PayHere Popup →' : 'Place Order & Pay →' }}
                    </span>
                    <span wire:loading wire:target="placeOrder">Processing order…</span>
                </button>
            </div>
        </div>
    @endif

    {{-- PayHere JS SDK Script & Listener --}}
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('open-payhere-modal', (eventData) => {
                const data = Array.isArray(eventData) ? eventData[0] : eventData;
                const payhereData = data.payhere;
                const confirmationUrl = data.confirmationUrl;

                payhere.onCompleted = function onPaymentCompleted(orderId) {
                    window.location.href = confirmationUrl + '?payment=success';
                };

                payhere.onDismissed = function onPaymentDismissed() {
                    console.log("PayHere payment modal closed.");
                };

                payhere.onError = function onPaymentError(error) {
                    alert("PayHere Payment Error: " + error);
                };

                payhere.startPayment(payhereData);
            });
        });
    </script>
</div>
