@extends('layouts.template-boostrap-5')
@section('content')
    <h1>{{ $post->title }}</h1>
    <div class="row rows-cols-1 row-cols-lg-3">
        <div class="col">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid rounded" alt="">
        </div>
    </div>
    {!! $post->content !!}

    <livewire:like-post :post="$post" />

    <livewire:comments :post="$post" />
@endsection
