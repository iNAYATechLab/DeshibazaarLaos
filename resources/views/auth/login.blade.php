@extends('layouts.app', ['title' => 'Admin Sign In · DeshiBazaar.com'])

@section('content')
<div class="mx-auto flex min-h-[calc(100vh-170px)] max-w-md items-center px-4 py-12">
    <section class="w-full rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">
        <p class="text-sm font-bold uppercase tracking-widest text-emerald-700">Administration</p>
        <h1 class="mt-2 text-2xl font-black">Sign in to DeshiBazaar</h1>
        <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-5">
            @csrf
            <label class="block text-sm font-semibold">Email
                <input name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-emerald-600 focus:ring-emerald-600">
                @error('email') <span class="mt-1 block text-xs text-red-600">{{ $message }}</span> @enderror
            </label>
            <label class="block text-sm font-semibold">Password
                <input name="password" type="password" required class="mt-2 w-full rounded-lg border-slate-300 px-3 py-2.5 focus:border-emerald-600 focus:ring-emerald-600">
            </label>
            <label class="flex items-center gap-2 text-sm text-slate-600"><input name="remember" type="checkbox" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600"> Remember me</label>
            <button class="w-full rounded-lg bg-emerald-700 px-4 py-3 font-bold text-white hover:bg-emerald-800">Sign in securely</button>
        </form>
    </section>
</div>
@endsection
