@extends('layouts.app')

@section('title', 'Issue New Book')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9"> 
            <div class="card card-custom" style="background: #fff; color: #111; border-radius: 8px; border: 1px solid #ddd;">
                <div class="card-header py-3" style="background: #f5f5dc; border-bottom: 2px solid #1a237e;">
                    <h4 class="fw-bold mb-0" style="color: #1a237e;">
                        <i class="bi bi-journal-plus me-2"></i> Issue New Book
                    </h4>
                </div>
                
                <div class="card-body p-0"> 
                                        
                    {{-- Display Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('borrowed-items.store') }}" method="POST">
                        @csrf
                        
                        <table class="table table-bordered mb-0">
                            <tbody>
                                {{-- Row 1: Select User --}}
                                <tr>
                                    <th class="bg-light align-middle" style="width: 25%; color: #1a237e;">
                                        Select Student <span class="text-danger">*</span>
                                    </th>
                                    <td>
                                        <select name="user_id" id="user_id" class="form-control border-0 bg-transparent" required>
                                            <option value="">-- Click to choose user --</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                {{-- Row 2: Select Book --}}
                                <tr>
                                    <th class="bg-light align-middle" style="color: #1a237e;">
                                        Select Book <span class="text-danger">*</span>
                                    </th>
                                    <td>
                                        <select name="book_id" id="book_id" class="form-control border-0 bg-transparent" required>
                                            <option value="">-- Click to choose book --</option>
                                            @foreach($books as $book)
                                                <option value="{{ $book->id }}">
                                                    {{ $book->title }} (ISBN: {{ $book->ISBN }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="small text-muted mt-1 ms-2">
                                            * Only showing books currently in stock.
                                        </div>
                                    </td>
                                </tr>

                                {{-- Row 3: Due Date --}}
                                <tr>
                                    <th class="bg-light align-middle" style="color: #1a237e;">
                                        Due Date <span class="text-danger">*</span>
                                    </th>
                                    <td>
                                        <input type="date" name="due_date" id="due_date" 
                                               class="form-control border-0 bg-transparent" 
                                               value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
                                    </td>
                                </tr>

                                {{-- Row 4: Action Buttons (Footer) --}}
                                <tr>
                                    <td colspan="2" class="text-end bg-light p-3">
                                        <a href="{{ route('borrowed-items.index') }}" class="btn btn-outline-secondary me-2">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn text-white px-4" style="background-color: #1a237e;">
                                            Confirm Issue
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection