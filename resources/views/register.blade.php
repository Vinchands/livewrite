@extends('layout')

@section('title', 'Register')

@section('content')
  <div class="w-full md:max-w-lg space-y-6 p-3 bg-white rounded shadow-md">
    <div class="text-center">
      <h1 class="font-semibold text-2xl text-secondary">Let's get started!</h1>
      <p class="text-sm text-black/50">Register to access</p>
    </div>
    <form action="{{ route('register.post') }}" method="post" class="grid gap-4">
      @csrf
      <input
        type="text"
        name="name"
        class="p-3 bg-slate-100"
        placeholder="Full name"
      />
      @error('name')
        <p class="text-center text-sm text-red-500">{{ $message }}</p>
      @enderror
      <input
        type="email"
        name="email"
        class="p-3 bg-slate-100"
        placeholder="Email address"
      />
      @error('email')
        <p class="text-center text-sm text-red-500">{{ $message }}</p>
      @enderror
      <input
        type="password"
        name="password"
        class="p-3 bg-slate-100"
        placeholder="Password"
      />
      @error('password')
        <p class="text-center text-sm text-red-500">{{ $message }}</p>
      @enderror
      <button type="submit" class="px-3 py-2 text-white bg-primary active:bg-secondary hover:bg-secondary rounded">Register</button>
      <p class="text-center">
        Have an account?
        <a href="{{ route('login') }}" class="underline text-primary active:text-secondary hover:text-secondary">Login</a>!
      </p>
      <p class="text-center text-sm text-black/50">
        &copy; 2025 <a href="https://github.com/Vinchands" target="_blank" ref="noopener noreferrer">Kevin CS</a>
      </p>
    </form>
  </d>
@endsection
