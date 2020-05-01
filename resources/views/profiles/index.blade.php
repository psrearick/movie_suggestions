@extends('layouts.account')

@section('account-content')
<div class="flex items-center mb-4 py-4">
    <div class="flex justify-between w-full items-center">
        <div>
            <h1 class="text-2xl">Change Profile</h1>
        </div>
        <a class="btn mr-4" href="/profiles/create">New Profile</a>
    </div>
</div>


<form action="/profiles/change-profile" method="POST" id="change-profile-form">
    @csrf
    <input type="hidden" value="" name="profile" id="profile">
    <div class="md:flex md:flex-wrap -mx-3">
        @forelse ($profiles as $profile)
        <div class="md:w-1/3 px-3 pb-6"
            onclick="document.getElementById('profile').setAttribute('value', {{ $profile->id }});document.getElementById('change-profile-form').submit();">
            <div class="card-btn-dark profile-card {{ $profile->isActive() ? 'bg-gray-700' : '' }}">
                <div>
                    <p class="text-xl text-center">
                        {{ $profile->profile_name }} {{ $profile->isActive() ? "(Current)" : "" }}</p>
                </div>
            </div>
        </div>

        @empty
        <div>
            <p>No Profiles Yet</p>
        </div>
        @endforelse
    </div>
</form>
@endsection
