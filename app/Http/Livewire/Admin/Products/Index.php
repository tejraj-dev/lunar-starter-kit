<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Product;

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
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->whereHas('translations', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with(['translations', 'prices'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.products.index', compact('products'))
            ->layout('layouts.admin')
            ->section('page-title', 'Products Management');
    }
}
