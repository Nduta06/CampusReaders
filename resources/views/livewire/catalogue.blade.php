<div class="p-4">

    <!-- Search + Filters -->
    <div class="flex flex-wrap gap-4 mb-4">
        <div class="flex gap-2 mb-2">
    @if($selectedCategory)
        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">
            Category: {{ $categories->firstWhere('id', $selectedCategory)->name }}
        </span>
    @endif

    @if($availability === 'available')
        <span class="px-2 py-1 bg-green-100 text-green-800 rounded">
            Available Only
        </span>
    @endif
    </div>
   
        <input type="text"
               wire:model="search"
               placeholder="Search title, author, ISBN..."
               class="px-3 py-2 border rounded w-64">

        <select wire:model="selectedCategory" class="px-3 py-2 border rounded">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select wire:model="availability" class="px-3 py-2 border rounded">
            <option value="">Any Availability</option>
            <option value="available">Available Only</option>
        </select>
    </div>

    <!-- Books Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th wire:click="sortBy('title')" class="p-2 cursor-pointer">Title</th>
                    <th wire:click="sortBy('author')" class="p-2 cursor-pointer">Author</th>
                    <th wire:click="sortBy('ISBN')" class="p-2 cursor-pointer">ISBN</th>
                    <th wire:click="sortBy('edition')" class="p-2 cursor-pointer">Edition</th>
                    <th wire:click="sortBy('publication_year')" class="p-2 cursor-pointer">Year</th>
                    <th class="p-2">Category</th>
                    <th wire:click="sortBy('available_copies')" class="p-2 cursor-pointer">Available</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr class="border-t">
                        <td class="p-2">{{ $book->title }}</td>
                        <td class="p-2">{{ $book->author }}</td>
                        <td class="p-2">{{ $book->ISBN }}</td>
                        <td class="p-2">{{ $book->edition }}</td>
                        <td class="p-2">{{ $book->publication_year }}</td>
                        <td class="p-2">{{ $book->category->name }}</td>
                        <td class="p-2">{{ $book->available_copies }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-3 text-center text-gray-500">
                            No books found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
