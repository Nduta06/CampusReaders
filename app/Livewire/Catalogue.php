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
    public $selectedCategory = '';
    public $availability = '';

    public $categories = [];

    public $sortField = 'title';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'tailwind';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'availability' => ['except' => ''],
    ];

    public function mount()
    {
        $this->categories = categories::all();
    }

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
        $query = books::with('category')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title', 'like', "%{$this->search}%")
                        ->orWhere('author', 'like', "%{$this->search}%")
                        ->orWhere('ISBN', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedCategory, fn($q) =>
                $q->where('category_id', $this->selectedCategory)
            )
            ->when($this->availability === 'available', fn($q) =>
                $q->where('available_copies', '>', 0)
            )
            ->orderBy($this->sortField, $this->sortDirection);

        $books = $query->paginate(10);

        return view('livewire.catalogue', [
            'books' => $books,
            'categories' => $this->categories,
            'sortField' => $this->sortField,
            'sortDirection' => $this->sortDirection,
        ]);
    }
}
