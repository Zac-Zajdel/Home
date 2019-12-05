@extends('layouts.app')

@section('content')
  <div class="mx-auto h-full flex justify-center items-center bg-gray-400 font-mono">
    <div class="bg-blue-700 border-blue-900 rounded shadow p-10" style="width: 35rem">
      <h3 class="text-white text-4xl pb-5 text-center">Glad to meet you!</h3>
        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="relative">
            <label for="name" class="text-blue absolute pl-3 pt-2">Name</label>
            <div>
              <input id="name" type="text" class="pt-8 w-full rounded p-3" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
              @error('name')
                <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>

          <div class="relative pt-2">
            <label for="email" class="text-blue absolute pl-3 pt-2">{{ __('Email') }}</label>
            <div class="col-md-6">
              <input id="email" type="email" class="pt-8 w-full rounded p-3" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="example@gmail.com">
              @error('email')
                <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>

          <div class="relative pt-2">
            <label for="password" class="text-blue absolute pl-3 pt-2">{{ __('Password') }}</label>
            <div>
              <input id="password" type="password" class="pt-8 w-full rounded p-3" name="password" required autocomplete="new-password" placeholder="***************">
              @error('password')
                  <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>
          </div>

          <div class="relative pt-2">
            <label for="password-confirm" class="text-blue absolute pl-3 pt-2">{{ __('Confirm Password') }}</label>
              <input id="password-confirm" type="password" class="pt-8 w-full rounded p-3" name="password_confirmation" required autocomplete="new-password" placeholder="***************">
          </div>

          <div class="flex justify-center pt-5 text-white">
            <button type="submit" class="rounded w-full text-2xl bg-blue-800 hover:bg-blue-900 text-white p-3">Register</button>
          </div>

          <div class="flex justify-center pt-5 text-white">
              <a class="rounded w-full text-2xl bg-blue-800 hover:bg-blue-900 text-white p-3" style="text-align:center;" href="{{ route('login') }}">Login</a>
          </div>
      </form>
    </div>
  </div>
@endsection
