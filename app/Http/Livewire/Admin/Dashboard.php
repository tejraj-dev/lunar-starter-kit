<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Lunar\Models\Order;
use Lunar\Models\Product;
use Lunar\Models\Customer;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_customers' => Customer::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        return view('livewire.admin.dashboard', compact('stats'))
            ->layout('layouts.admin')
            ->section('page-title', 'Dashboard');
    }
}
