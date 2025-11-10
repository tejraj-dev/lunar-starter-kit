<?php

namespace App\Http\Livewire\Admin\Collections;

use Livewire\Component;
use Livewire\WithPagination;
use Lunar\Models\Collection;

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
        $collections = Collection::query()
            ->when($this->search, function ($query) {
                $query->whereHas('translations', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with(['translations', 'products'])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.collections.index', compact('collections'))
            ->layout('layouts.admin')
            ->section('page-title', 'Collections Management');
    }
}
