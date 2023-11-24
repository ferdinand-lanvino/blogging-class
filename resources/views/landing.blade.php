@extends('layouts.template')

@section('title', 'Landing Page')

@section('content')
    {{-- Cek jika $featured tidak kosong --}}
    @if ($featured)
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="row mb-2">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic">{{ $featured->title }}</h1>
                    <p class="lead my-3">{{ Str::limit($featured->body, 50, ' ...') }}</p>
                    <p class="lead mb-0">
                        <a href="{{ route('articles.show', $featured) }}" class="text-white fw-bold">
                            Continue reading...
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    @if ($featured->image)
                        <img src="{{ $featured->image_url }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/250x200" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Articles Card --}}
    <div class="row mb-2">
        @forelse ($articles as $article)
            <x-article-card :article="$article" teks="Ini contoh teks"/>
        @empty
            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h2 class="card-text mb-auto">No articles found.</h2>
                    </div>
                </div>
            </div>
        @endforelse
        {{ $articles->links() }}
    </div>
@endsection
