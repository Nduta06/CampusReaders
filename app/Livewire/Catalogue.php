<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\books;
use App\Models\categories;
use CampusReaders\OpenLibrary\OpenLibrary;

class Catalogue extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $availability = '';

    public $categories = [];

    protected $paginationTheme = 'tailwind';
    protected $queryString = ['search', 'selectedCategory', 'availability'];

    public function mount()
    {
        $this->categories = categories::all(); // Load categories from DB
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

    public function render()
    {
        $dbBooks = books::query()
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('author', 'like', "%{$this->search}%")
                  ->orWhere('ISBN', 'like', "%{$this->search}%")
            )
            ->when($this->selectedCategory, fn($q) =>
                $q->where('category_id', $this->selectedCategory)
            )
            ->when($this->availability === 'available', fn($q) =>
                $q->where('available_copies', '>', 0)
            )
            ->paginate(10);
        $apiBooks = collect();
        if (strlen($this->search) >= 3) {
            $openLibrary = app('openlibrary');
            $results = $openLibrary->search($this->search);

            $apiBooks = collect($results['docs'] ?? [])->map(function ($item) {
                return (object) [
                    'title' => $item['title'] ?? 'N/A',
                    'author' => $item['author_name'][0] ?? 'Unknown',
                    'ISBN' => $item['isbn'][0] ?? '—',
                    'edition' => $item['edition_key'][0] ?? '—',
                    'publication_year' => $item['first_publish_year'] ?? '—',
                    'category' => (object)['name' => $item['subject'][0] ?? '—'],
                    'available_copies' => null, // API books don’t track your stock
                ];
            });
        }
        $mergedBooks = $dbBooks->getCollection()->merge($apiBooks);
        $dbBooks->setCollection($mergedBooks);

        return view('livewire.catalogue', [
            'books' => $dbBooks,
        ]);
    }
}