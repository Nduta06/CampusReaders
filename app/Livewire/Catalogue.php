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
    public $selectedCategory = null;
    public $availability = null;
    public $sortField = 'title';
    public $sortDirection = 'asc';
    
    // Reset pagination on filter/search change
    public function updatedSearch() { $this->resetPage(); }
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
            ->when($this->search, function($q) {
                $q->where(function($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                          ->orWhere('author', 'like', "%{$this->search}%")
                          ->orWhere('ISBN', 'like', "%{$this->search}%")
                          ->orWhere('edition', 'like', "%{$this->search}%")
                          ->orWhere('publication_year', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedCategory && $this->selectedCategory !== 'all', function($q) {
                $q->where('category_id', $this->selectedCategory);
            })
            ->when($this->availability !== null && $this->availability !== '', function($q) {
                if ($this->availability === 'available') {
                    $q->where('available_copies', '>', 0);
                } elseif ($this->availability === 'unavailable') {
                    $q->where('available_copies', '=', 0);
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
        
        return view('livewire.catalogue', compact('books', 'categories'));
    }
}