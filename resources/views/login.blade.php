@extends('layout')

@section('title', 'Login')

@section('content')
  <div class="w-full md:max-w-lg space-y-6 p-3 bg-white rounded shadow-md">
    <div class="text-center">
      <h1 class="font-semibold text-2xl text-secondary">Welcome back!</h1>
      <p class="text-sm text-black/50">Login to continue</p>
    </div>
    <form action="{{ route('login.post') }}" method="post" class="grid gap-4">
      @csrf
      <input
        type="text"
        name="email"
        class="p-3 bg-slate-100"
        placeholder="Email address"
      />
      <input
        type="password"
        name="password"
        class="p-3 bg-slate-100"
        placeholder="Password"
      />
      @error('email')
        <p class="text-center text-sm text-red-500">{{ $message }}</p>
      @enderror
      <div class="flex items-center gap-1">
        <input  type="checkbox" name="remember" />
        <label>Remember me</label>
      </div>
      <button type="submit" class="px-3 py-2 text-white bg-primary active:bg-secondary hover:bg-secondary rounded">Login</button>
      <p class="text-center">
        Have no account?
        <a href="{{ route('register') }}" class="underline text-primary active:text-secondary hover:text-secondary">Register</a>!
      </p>
      <p class="text-center text-sm text-black/50">
        &copy; 2025 <a href="https://github.com/Vinchands" target="_blank" ref="noopener noreferrer">Kevin CS</a>
      </p>
    </form>
  </d>
@endsection
