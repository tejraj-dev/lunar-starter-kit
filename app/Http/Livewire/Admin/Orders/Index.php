<?php

namespace App\Http\Livewire\Admin\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Order;

class Index extends Component
{
    use WithPagination;

    public $statusFilter = 'all';

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::query()
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['customer', 'currency'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.orders.index', compact('orders'))
            ->layout('layouts.admin')
            ->section('page-title', 'Orders Management');
    }
}
