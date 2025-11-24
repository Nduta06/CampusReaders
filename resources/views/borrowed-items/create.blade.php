@extends('layout')

@section('title', 'Issue New Book')

@section('content')
<div class="container" style="max-width: 800px; margin-top: 40px; margin-bottom: 60px;">
    <div class="page-header" style="margin-bottom: 32px;">
        <h1 class="page-title" style="display: flex; align-items: center; font-size: 2rem; color: #1a237e;">
            <i class="fas fa-book-medical" style="color: #d4c3a3; margin-right: 12px;"></i>
            Issue New Book
        </h1>
        <p class="page-subtitle" style="color: #666; margin-left: 4px;">Register a new book borrowing transaction</p>
    </div>

    <div class="card" style="border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border-radius: 12px;">
        <div class="card-body" style="padding: 32px;">
            
            {{-- Errors --}}
            @if ($errors->any())
                <div style="background: #fee; border: 1px solid #fcc; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                    <div style="color: #c00; font-weight: 600; margin-bottom: 8px;">
                        <i class="fas fa-exclamation-circle"></i> Please fix the following errors:
                    </div>
                    <ul style="margin: 0; padding-left: 20px; color: #c00;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('borrowed-items.store') }}" method="POST">
                @csrf

                {{-- Select Student --}}
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; margin-bottom: 8px; display: block; font-weight: 600;">
                        Select Student <span style="color: #dc3545;">*</span>
                    </label>
                    <div style="position: relative;">
                        <i class="fas fa-user" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #d4c3a3; pointer-events: none; z-index: 1;"></i>
                        <select 
                            name="user_id" 
                            id="user_id" 
                            class="form-control" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23a08c6c%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat; background-position: right 12px center; background-size: 16px; cursor: pointer;"
                        >
                            <option value="">-- Choose student --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Select Book --}}
                <div class="form-group" style="margin-bottom: 24px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; margin-bottom: 8px; display: block; font-weight: 600;">
                        Select Book <span style="color: #dc3545;">*</span>
                    </label>
                    <div style="position: relative;">
                        <i class="fas fa-book" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #d4c3a3; pointer-events: none; z-index: 1;"></i>
                        <select 
                            name="book_id" 
                            id="book_id" 
                            class="form-control" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%23a08c6c%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat; background-position: right 12px center; background-size: 16px; cursor: pointer;"
                        >
                            <option value="">-- Choose book --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">
                                    {{ $book->title }} (ISBN: {{ $book->ISBN }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div style="font-size: 12px; color: #888; margin-top: 6px; margin-left: 2px;">
                        <i class="fas fa-info-circle" style="margin-right: 4px;"></i>
                        Only showing books currently in stock
                    </div>
                </div>

                {{-- Due Date --}}
                <div class="form-group" style="margin-bottom: 32px;">
                    <label style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; margin-bottom: 8px; display: block; font-weight: 600;">
                        Due Date <span style="color: #dc3545;">*</span>
                    </label>
                    <div style="position: relative;">
                        <i class="fas fa-calendar-alt" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #d4c3a3; pointer-events: none; z-index: 1;"></i>
                        <input 
                            type="date" 
                            name="due_date" 
                            id="due_date"
                            class="form-control"
                            value="{{ date('Y-m-d', strtotime('+14 days')) }}" 
                            required
                            style="width: 100%; padding: 12px 16px 12px 44px; border: 1px solid #e8dfca; border-radius: 8px; font-size: 15px; transition: all 0.2s ease; color: #333;"
                        >
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 24px; border-top: 1px solid #eee;">
                    <a 
                        href="{{ route('borrowed-items.index') }}" 
                        class="btn btn-secondary"
                        style="background: #f1f1f1; color: #333; border: none; padding: 12px 24px; font-size: 15px; font-weight: 600; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center;"
                    >
                        <i class="fas fa-times" style="margin-right: 6px;"></i>
                        Cancel
                    </a>
                    <button 
                        type="submit" 
                        class="btn btn-primary"
                        style="background: #1a237e; color: white; border: none; padding: 12px 28px; font-size: 15px; font-weight: 600; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center;"
                    >
                        <i class="fas fa-check" style="margin-right: 6px;"></i>
                        Confirm Issue
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
    .form-control:focus {
        outline: none;
        border-color: #d4c3a3 !important;
        box-shadow: 0 0 0 3px rgba(212, 195, 163, 0.2);
    }

    select.form-control:hover {
        border-color: #c8b8a0;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: 0.6;
        filter: invert(45%) sepia(15%) saturate(800%) hue-rotate(350deg);
    }

    input[type="date"]::-webkit-calendar-picker-indicator:hover {
        opacity: 1;
    }
</style>
@endsection