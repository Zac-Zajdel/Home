@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-400 font-mono">
  <div class="bg-blue-700 border-blue-900 rounded shadow p-10" style="width: 35rem">
    <h3 class="text-white text-4xl pb-5 text-center">Dang Passwords :(</h3>
    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="relative">
        <label for="email" class="text-blue absolute pl-3 pt-2">{{ __('E-Mail Address') }}</label>
        <div>
          <input id="email" type="email" class="pt-8 w-full rounded p-3" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
      </div>

      <div class="flex justify-center pt-6">
          <button type="submit" class="rounded w-full text-2xl bg-blue-800 hover:bg-blue-900 text-white p-3">Send Reset Email</button>
      </div>

      <div class="flex justify-between pt-5 text-white">
        <a class="hover:text-blue-200 underline" href="{{ route('login') }}">Login</a>
        <a class="hover:text-blue-200 underline" href="{{ route('register') }}">Register</a>
      </div>
    </form>
  </div>
</div>
@endsection
