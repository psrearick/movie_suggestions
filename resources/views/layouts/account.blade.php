@extends('layouts.app')

@section('content')
<header class="py-4">
    <h1 class="text-4xl">
        Profile: {{ auth()->user()->profiles()->first()->profile_name }}
    </h1>
</header>
<div class="md:flex md:flex-wrap">
    <aside class="md:w-1/4 md:pr-3 mb-3">
        <div class="card-dark">
            <div class="pb-4">
                <h2 class="text-lg text-gray-500">Account</h2>
                <ul>
                    <li><a class="hover:text-yellow-500" href="/profiles">Profile Details</a></li>
                    <li><a class="hover:text-yellow-500" href="/profiles/change-profile">Change Profile</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-lg text-gray-500">Movies</h2>
                <ul>
                    <li><a class="hover:text-yellow-500" href="#">Favorites</a></li>
                    <li><a class="hover:text-yellow-500" href="#">Watch List</a></li>
                    <li><a class="hover:text-yellow-500" href="#">Seen</a></li>
                    <li><a class="hover:text-yellow-500" href="#">Rated</a></li>
                </ul>
            </div>
        </div>
    </aside>
    <main class="md:w-3/4 md:pl-3">
        @yield('account-content')
    </main>
</div>
@endsection
