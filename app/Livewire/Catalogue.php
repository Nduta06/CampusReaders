<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Books;
use App\Models\Category;

class Catalogue extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'availability' => ['except' => ''],
        'sortField' => ['except' => 'title'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public $search = '';
    public $selectedCategory = '';
    public $availability = '';
    public $sortField = 'title';
    public $sortDirection = 'asc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingAvailability()
    {
        $this->resetPage();
    }

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
        $categories = Category::orderBy('name')->get();

        $books = Books::with('category')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                    ->orWhere('author', 'like', "%{$this->search}%")
                    ->orWhere('ISBN', 'like', "%{$this->search}%")
                    ->orWhere('edition', 'like', "%{$this->search}%")
                    ->orWhere('publication_year', 'like', "%{$this->search}%");
                });
            })

            ->when($this->selectedCategory, fn($q) => 
                $q->where('category_id', $this->selectedCategory)
            )
            ->when($this->availability === 'available', fn($q) =>
                $q->where('available_copies', '>', 0)
            )
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.catalogue', compact('books', 'categories'));
    }
}
