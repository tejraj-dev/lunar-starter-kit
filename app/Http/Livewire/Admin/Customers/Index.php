<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Customer;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $customers = Customer::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('company_name', 'like', '%' . $this->search . '%');
                });
            })
            ->withCount('orders')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.customers.index', compact('customers'))
            ->layout('layouts.admin')
            ->section('page-title', 'Customers Management');
    }
}
