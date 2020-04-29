@extends('layouts.account')

@section('account-content')
<div class="flex items-center mb-4 py-4">
    <div class="flex justify-between w-full items-center">
        <div>
            <h1 class="text-2xl">Switch Profile</h1>
        </div>
        <a class="btn" href="/profiles/create">New Profile</a>
    </div>
</div>


<div class="md:flex md:flex-wrap -mx-3">
    @forelse ($profiles as $profile)
    <a href="{{ $profile->path() }}" class="md:w-1/3 px-3 pb-6">
        <div class="card-btn-dark">
            <div>
                <p class="text-xl text-center">{{ $profile->profile_name }}</p>
            </div>
        </div>
    </a>

    @empty
    <div>
        <p>No Profiles Yet</p>
    </div>
    @endforelse
</div>
@endsection
