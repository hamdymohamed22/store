@extends('admin.layout')

@section('page_title')
    Profile
@endsection

@section('sub')
    Edit Profile
@endsection

@section('content')
    <div class="container col-md-10">
        <x-alert />
        <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- first name --}}
            <div class="form-group">
                <x-form.lable>First Name</x-form.lable>
                <x-form.input name='first_name' type="text" class="form-control" :value="$user->profile->first_name" />
            </div>
            {{-- last name --}}
            <div class="form-group">
                <x-form.lable>Last Name</x-form.lable>
                <x-form.input name='last_name' type="text" class="form-control" :value="$user->profile->last_name" />
            </div>
            {{-- birthDate --}}
            <div class="form-group">
                <x-form.lable>Birthdate</x-form.lable>
                <x-form.input name='birthdate' type="date" class="form-control" :value="$user->profile->birthdate" />
            </div>
            {{-- gender --}}
            <div class="form-group">
                <x-form.lable>Gender</x-form.lable>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="gender" id="male" value="male" checked>
                    <label class="form-chek-lable" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-chek-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-chek-lable" for="female">Female</label>
                </div>
            </div>
            {{-- image --}}
            <div class="form-group">
                <x-form.lable>Image</x-form.lable>
                <x-form.input name='image' type="file" class="form-control" />
            </div>
            {{-- country --}}
            <div class="form-group">
                <label for="country">Country</label>
                <select name="country" id="country" class="form-control">
                    <option :value="$user->profile->country">{{ $user->profile->country }}</option>
                    @foreach ($countries as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            {{-- state --}}
            <div class="form-group">
                <x-form.lable>State</x-form.lable>
                <x-form.input name='state' type="text" class="form-control" :value="$user->profile->state" />
            </div>
            {{-- city --}}
            <div class="form-group">
                <x-form.lable>City</x-form.lable>
                <x-form.input name='city' type="text" class="form-control" :value="$user->profile->city" />
            </div>
            {{-- str_address --}}
            <div class="form-group">
                <x-form.lable>Str Address</x-form.lable>
                <x-form.input name='str_address' type="text" class="form-control" :value="$user->profile->str_address" />
            </div>
            {{-- str_address --}}
            <div class="form-group">
                <x-form.lable>postal_code</x-form.lable>
                <x-form.input name='postal_code' type="text" class="form-control" :value="$user->profile->postal_code" />
            </div>
            {{-- Language --}}
            <div class="form-group">
                <x-form.lable>locale Language</x-form.lable>
                <select name="locale" id="locale" class="form-control">
                    <option :value="$user->profile->locale">{{ $user->profile->locale }}</option>
                    @foreach ($languages as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit </button>
            </div>

        </form>
    </div>
@endsection
