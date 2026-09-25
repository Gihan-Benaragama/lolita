<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\PayHereService;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutWizard extends Component
{
    public int $step = 1;

    public ?int $activeOrderId = null;

    public string $full_name = '';

    public string $address_line1 = '';

    public string $address_line2 = '';

    public string $city = '';

    public string $postal_code = '';

    public string $country = 'Sri Lanka';

    public string $phone = '';

    public string $shipping_method = 'standard';

    public string $payment_method = 'payhere';

    // Visual Card fields inside Step 3
    public string $card_number = '';

    public string $card_expiry = '';

    public string $card_cvc = '';

    public string $card_name = '';

    public function rules(): array
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:120',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:120',
            'phone' => 'required|string|max:30',
            'shipping_method' => 'required|in:standard,express',
            'payment_method' => 'required|in:card,payhere,cod,bank,demo',
        ];

        if ($this->payment_method === 'card') {
            $rules['card_number'] = 'required|string|min:14|max:19';
            $rules['card_expiry'] = 'required|string|max:7';
            $rules['card_cvc'] = 'required|string|min:3|max:4';
            $rules['card_name'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function rulesForStep(): array
    {
        return match ($this->step) {
            1 => [
                'full_name' => 'required|string|max:255',
                'address_line1' => 'required|string|max:255',
                'city' => 'required|string|max:120',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:120',
                'phone' => 'required|string|max:30',
            ],
            2 => ['shipping_method' => 'required|in:standard,express'],
            3 => array_filter(
                $this->rules(),
                fn ($key) => in_array($key, ['payment_method', 'card_number', 'card_expiry', 'card_cvc', 'card_name']),
                ARRAY_FILTER_USE_KEY
            ),
            default => $this->rules(),
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep());
        $this->step = min(4, $this->step + 1);
    }

    public function previousStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function shippingCost(): float
    {
        return $this->shipping_method === 'express' ? 750.00 : 300.00;
    }

    public function placeOrder(CartService $cartService)
    {
        $this->validate($this->rules());

        if ($this->activeOrderId) {
            $order = Order::find($this->activeOrderId);
        } else {
            $items = $cartService->all();

            if (empty($items)) {
                session()->flash('error', 'Your cart is empty.');

                return redirect()->route('shop');
            }

            $subtotal = $cartService->subtotal();
            $shipping = $this->shippingCost();

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'LOL-'.strtoupper(Str::random(8)),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shipping,
                'total' => $subtotal + $shipping,
                'currency' => 'LKR',
                'shipping_address' => [
                    'full_name' => $this->full_name,
                    'address_line1' => $this->address_line1,
                    'address_line2' => $this->address_line2,
                    'city' => $this->city,
                    'postal_code' => $this->postal_code,
                    'country' => $this->country,
                    'phone' => $this->phone,
                ],
            ]);

            foreach ($items as $line) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $line['product_id'],
                    'product_variant_id' => $line['variant_id'] ?? null,
                    'product_name_snapshot' => $line['name'].(! empty($line['variant_name']) ? ' — '.$line['variant_name'] : ''),
                    'quantity' => $line['quantity'],
                    'unit_price' => $line['price'],
                    'subtotal' => $line['price'] * $line['quantity'],
                ]);
            }

            $cartService->clear();
            $this->activeOrderId = $order->id;
        }

        if ($this->payment_method === 'card') {
            $order->update(['status' => 'paid']);

            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->decrement('stock_quantity', $item->quantity);
                }
            }

            return redirect()->route('orders.confirmation', $order)
                ->with('status', 'Payment successful! Thank you for your order.');
        }

        if (in_array($this->payment_method, ['cod', 'bank'])) {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->decrement('stock_quantity', $item->quantity);
                }
            }

            $msg = $this->payment_method === 'cod'
                ? 'Order received! Payment will be collected in cash upon delivery.'
                : 'Order received! Please complete your bank transfer using your Order Number as reference.';

            return redirect()->route('orders.confirmation', $order)->with('status', $msg);
        }

        if ($this->payment_method === 'payhere') {
            $payHereService = app(PayHereService::class);
            $payhereData = $payHereService->buildCheckoutFields($order);

            $this->dispatch('open-payhere-modal',
                payhere: $payhereData,
                confirmationUrl: route('orders.confirmation', $order)
            );

            return null;
        }

        return redirect()->route('demo-payment.checkout', $order);
    }

    public function render()
    {
        return view('livewire.checkout-wizard');
    }
}
