<div>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Book Catalogue</h1>
            <p class="page-subtitle">Browse and search our complete library collection</p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success mb-4" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-danger mb-4" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; border: 1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="filter-bar">
                    <input 
                        type="text" 
                        wire:model.live="search" 
                        placeholder="Search by title, author, or ISBN..." 
                        class="form-control"
                    >
                    <select wire:model.live="selectedCategory" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="availability" class="form-control">
                        <option value="">Any Availability</option>
                        <option value="available">Available Only</option>
                    </select>
                </div>

                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th wire:click="sortBy('title')" style="cursor: pointer;">
                                    Title <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sortBy('author')" style="cursor: pointer;">
                                    Author <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sortBy('ISBN')" style="cursor: pointer;">
                                    ISBN <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sortBy('edition')" style="cursor: pointer;">
                                    Edition <i class="fas fa-sort"></i>
                                </th>
                                <th wire:click="sortBy('publication_year')" style="cursor: pointer;">
                                    Year <i class="fas fa-sort"></i>
                                </th>
                                <th>Category</th>
                                <th wire:click="sortBy('available_copies')" style="cursor: pointer;">
                                    Available <i class="fas fa-sort"></i>
                                </th>
                                {{-- ADDED: Action Column Header --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $book)
                            <tr>
                                <td><strong>{{ $book->title }}</strong></td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->ISBN }}</td>
                                <td>{{ $book->edition }}</td>
                                <td>{{ $book->publication_year }}</td>
                                <td>{{ $book->category->name }}</td>
                                <td>
                                    @if($book->available_copies > 0)
                                        <span class="badge badge-success" style="background: #28a745; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8em;">
                                            {{ $book->available_copies }} Available
                                        </span>
                                    @else
                                        <span class="badge badge-danger" style="background: #dc3545; color: white; padding: 5px 10px; border-radius: 20px; font-size: 0.8em;">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                {{-- ADDED: Action Column Body --}}
                                <td>
                                    @if($book->available_copies > 0)
                                        <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" 
                                                onclick="return confirm('Confirm borrowing: {{ $book->title }}?')"
                                                class="btn btn-primary btn-sm"
                                                style="background: #1a237e; color: white; border: none; padding: 5px 15px; border-radius: 4px; cursor: pointer;">
                                                Borrow
                                            </button>
                                        </form>
                                    @else
                                        <button disabled style="background: #e0e0e0; color: #9e9e9e; border: none; padding: 5px 15px; border-radius: 4px; cursor: not-allowed;">
                                            Waitlist
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="table-empty" style="text-align: center; padding: 40px; color: #666;">
                                    <i class="fas fa-search" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 12px;"></i>
                                    No books found matching your criteria.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($books->hasPages())
            <div class="card-footer">
                {{ $books->links() }}
            </div>
            @endif
        </div>
    </div>
</div>