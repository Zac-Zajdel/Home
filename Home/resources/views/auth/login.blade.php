@extends('layouts.app')

@section('content')
<div class="mx-auto h-full flex justify-center items-center bg-gray-400 font-mono">
  <div class="bg-blue-700 border-blue-900 rounded shadow p-10" style="width: 35rem">
    <h3 class="text-white text-6xl pb-5 text-center">Welcome Home</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="relative">
          <label for="email" class="text-blue absolute pl-3 pt-2">Email</label>
          <div>
            <input id="email" type="email" class="pt-8 w-full rounded p-3" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="example@gmail.com">
            @error('email')
                <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>

        <div class="relative pt-2">
          <label for="password" class="text-blue absolute pl-3 pt-2">Password</label>
          <div>
              <input id="password" type="password" class="pt-8 w-full rounded p-3" name="password"  autocomplete="current-password" placeholder="************">
              @error('password')
                  <span class="text-red-500" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
          </div>
        </div>

        <div class="flex justify-left pt-1 text-white">
            <span>Forgot Password?</span>
            <a class="pl-3 text-blue-400 hover:underline" href="{{ route('password.request') }}">&#8680;</a>
        </div>

        <div class="pt-2 pb-2">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="text-white" for="remember">Remember Me</label>
        </div>

        <div>
          <button type="submit" class="rounded w-full text-2xl bg-blue-800 hover:bg-blue-900 text-white p-3">Login</button>
        </div>

        <div class="flex justify-center pt-5 text-white">
            <span>Don't have an account?</span>
            <a class="pl-3 text-blue-400 hover:underline" href="{{ route('register') }}">Register</a>
        </div>
    </form>
  </div>
</div>
@endsection
