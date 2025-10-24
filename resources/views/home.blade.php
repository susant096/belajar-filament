@extends('layouts.template-boostrap-5')
@section('content')
    <h1 class="mb-3">Post</h1>
    <div class="row row-cols-1 row-cols-lg-3 g-3">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card" style="">
                    @if (!$post->thumbnail)
                        <img src="{{ asset('img/no-image.webp') }}" class="card-img-top" alt="...">
                    @else
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body shadow-sm">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->content !!}</p>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a class="text-decoration-none text-dark" href="{{ route('post', $post->slug) }}">Go
                                    somewhere &nbsp;<i class="bi bi-arrow-right"></i></a>
                            </div>
                            <div class="fs-5 d-flex gap-2">
                                <a href="#" class="text-secondary"><i class="bi bi-chat"></i></a>
                                <a href="#" class="text-secondary"><i class="bi bi-heart"></i></a>
                                <a href="#" class="text-secondary"><i class="bi bi-bookmark"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col mx-auto">
                <h3 class="text-center">No Post</h3>
            </div>
        @endforelse



    </div>
@endsection
