@extends('layout')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 rounded bg-gray-700 text-white">
        </div>

        <div class="mb-4">
            <label class="block mb-2">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 rounded bg-gray-700 text-white">
        </div>

        <button type="submit" class="bg-cyan-400 text-black px-4 py-2 rounded hover:bg-cyan-500">Save Changes</button>
    </form>
</div>
@endsection
