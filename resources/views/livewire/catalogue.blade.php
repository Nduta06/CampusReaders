<div>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Book Catalogue</h1>
            <p class="page-subtitle">Browse and search our complete library collection</p>
        </div>

        <div class="card">
            <div class="card-body">
                <!-- Search and Filters -->
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

                <!-- Books Table -->
                <div class="table-wrapper">
                    <table>
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
                                        <span class="badge badge-success">
                                            {{ $book->available_copies }} Available
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="table-empty">
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