@extends('layouts.app')

@section('title', 'Issue New Book')

@section('content')
<div class="container-fluid py-4" style="background:#faf7f0;">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="card shadow-sm" 
                 style="background:#fffdf7; color:#3a3a3a; border-radius:10px; border:1px solid #e4dcc0;">
                
                {{-- Header --}}
                <div class="card-header py-3" 
                     style="background:#f2e8cf; border-bottom:2px solid #a68a64;">
                    <h4 class="fw-bold mb-0" style="color:#6b4f2a; font-family:'Georgia', serif;">
                        <i class="bi bi-journal-plus me-2"></i> Issue New Book
                    </h4>
                </div>

                {{-- Body --}}
                <div class="card-body p-0">

                    {{-- Errors --}}
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

                        <table class="table mb-0" 
                               style="border-color:#e8dfc7; font-size:0.95rem;">
                            <tbody>

                                {{-- User --}}
                                <tr>
                                    <th class="align-middle" 
                                        style="width:25%; background:#f8f1df; color:#6b4f2a; font-weight:600;">
                                        Select Student <span class="text-danger">*</span>
                                    </th>
                                    <td style="background:#fffdf7;">
                                        <select name="user_id" id="user_id" 
                                                class="form-control border-0 bg-transparent shadow-none" required>
                                            <option value="">-- Choose user --</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                {{-- Book --}}
                                <tr>
                                    <th class="align-middle" 
                                        style="background:#f8f1df; color:#6b4f2a; font-weight:600;">
                                        Select Book <span class="text-danger">*</span>
                                    </th>
                                    <td style="background:#fffdf7;">
                                        <select name="book_id" id="book_id" 
                                                class="form-control border-0 bg-transparent shadow-none" required>
                                            <option value="">-- Choose book --</option>
                                            @foreach($books as $book)
                                                <option value="{{ $book->id }}">
                                                    {{ $book->title }} (ISBN: {{ $book->ISBN }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="small text-muted mt-1 ms-1">
                                            * Only showing books currently in stock.
                                        </div>
                                    </td>
                                </tr>

                                {{-- Due Date --}}
                                <tr>
                                    <th class="align-middle" 
                                        style="background:#f8f1df; color:#6b4f2a; font-weight:600;">
                                        Due Date <span class="text-danger">*</span>
                                    </th>
                                    <td style="background:#fffdf7;">
                                        <input type="date" name="due_date" id="due_date"
                                               class="form-control border-0 bg-transparent shadow-none"
                                               value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
                                    </td>
                                </tr>

                                {{-- Footer --}}
                                <tr>
                                    <td colspan="2" class="text-end p-3" style="background:#f2e8cf;">
                                        <a href="{{ route('borrowed-items.index') }}" 
                                           class="btn btn-outline-secondary me-2"
                                           style="border-radius:50px;">
                                            Cancel
                                        </a>
                                        <button type="submit" 
                                                class="btn text-white px-4"
                                                style="background:#6b4f2a; border-radius:50px;">
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
