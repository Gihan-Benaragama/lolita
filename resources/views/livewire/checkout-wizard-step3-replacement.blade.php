<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutWizard extends Component
{
    public int $step = 1; // 1 = Address, 2 = Shipping, 3 = Payment method, 4 = Review

    // Address
    public string $full_name = '';
    public string $address_line1 = '';
    public string $address_line2 = '';
    public string $city = '';
    public string $postal_code = '';
    public string $country = 'Sri Lanka';
    public string $phone = '';

    // Shipping
    public string $shipping_method = 'standard'; // standard | express

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
            default => [],
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
        return $this->shipping_method === 'express' ? 750.00 : 300.00; // LKR
    }

    /**
     * Creates the order as 'pending', then redirects to PayHere's hosted
     * checkout. The order is NOT marked as paid here — that only happens
     * when PaymentController::notify() receives and verifies PayHere's
     * server-to-server webhook.
     */
    public function placeOrder(CartService $cartService)
    {
        $this->validate($this->rulesForStep());

        $items = $cartService->all();

        if (empty($items)) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('shop');
        }

        $subtotal = $cartService->subtotal();
        $shipping = $this->shippingCost();

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'LOL-' . strtoupper(Str::random(8)),
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
                'product_name_snapshot' => $line['name'] . (!empty($line['variant_name']) ? ' — ' . $line['variant_name'] : ''),
                'quantity' => $line['quantity'],
                'unit_price' => $line['price'],
                'subtotal' => $line['price'] * $line['quantity'],
            ]);
        }

        $cartService->clear();

        // Off to PayHere's hosted checkout page
        return redirect()->route('payhere.checkout', $order);
    }

    public function render()
    {
        return view('livewire.checkout-wizard');
    }
}
