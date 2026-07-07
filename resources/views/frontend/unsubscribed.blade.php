@extends('layouts.frontend')

@section('title', 'Unsubscribed')

@section('content')
<section class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-[60vh] flex items-center">
    <div class="max-w-7xl mx-auto px-4 py-20 text-center">
        <div class="w-20 h-20 bg-vnn-red/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-vnn-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-black text-white font-heading">You've Been Unsubscribed</h1>
        <p class="text-gray-400 mt-4 max-w-md mx-auto font-body">You will no longer receive newsletter emails from VNN. We're sorry to see you go.</p>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mt-8 bg-vnn-red text-white font-bold px-6 py-3 rounded-xl hover:bg-vnn-red-dark transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Homepage
        </a>
    </div>
</section>
@endsection
