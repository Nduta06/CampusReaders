<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\books;
use App\Models\categories;

class Catalogue extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;  // null works better for empty filter
    public $availability = null;
    public $sortField = 'title';
    public $sortDirection = 'asc';

    // Reset pagination on filter/search change
    public function updatingSearch() { $this->resetPage(); }
    public function updatedSelectedCategory() { $this->resetPage(); }
    public function updatedAvailability() { $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $categories = categories::orderBy('name')->get();

        $books = books::with('category')
            ->when($this->search, function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('author', 'like', "%{$this->search}%")
                  ->orWhere('ISBN', 'like', "%{$this->search}%")
                  ->orWhere('edition', 'like', "%{$this->search}%")
                  ->orWhere('publication_year', 'like', "%{$this->search}%");
            })
            ->when($this->selectedCategory, function ($q) {
                $q->where('category_id', $this->selectedCategory);
            })
            ->when($this->availability === 'available', function ($q) {
                $q->where('available_copies', '>', 0);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.catalogue', compact('books', 'categories'));
    }
}
