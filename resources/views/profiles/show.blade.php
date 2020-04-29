@extends('layouts.account')

@section('account-content')
<div>
    <div class="card-dark">
        <h1 class="text-xl mb-8">{{ $profile->profile_name }}</h1>

        <div>
            <div class="mb-2">
                <span class="font-bold">First Name</span>
                <br>
                <span>{{ $profile->first_name }}</span>
            </div>
            <div class="mb-2">
                <span class="font-bold">Last Name</span>
                <br>
                <span>{{ $profile->last_name }}</span>
            </div>
            <div class="mb-2">
                <span class="font-bold">Date of Birth</span>
                <br>
                <span>{{ $profile->date_of_birth }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
