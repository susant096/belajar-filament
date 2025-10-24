@extends('layouts.template-boostrap-5')
@section('content')
    <h1>{{ $post->title }}</h1>
    <div class="row rows-cols-1 row-cols-lg-3">
        <div class="col">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid rounded" alt="">
        </div>
    </div>
    {!! $post->content !!}
    {{-- <div class="d-flex ">
        <div class="fs-5 d-flex gap-2">
            <a href="#" class="text-secondary"><i class="bi bi-chat"></i></a>
            <a href="#" class="text-secondary"><i class="bi bi-heart"></i></a>
            <a href="#" class="text-secondary"><i class="bi bi-bookmark"></i></a>
        </div>
    </div> --}}
    {{-- @livewire('like-post') --}}
    <livewire:like-post />
    <div class="comment mt-5">
        <p class="fw-bold">Comment:</p>
        {{-- <div class="row rows-cols-1 mx-3 mb-3"> --}}
        <div class="form-floating mx-3 mb-3">
            <textarea class="form-control border border-primary" style="height: 100px"></textarea>
            <label for="floatingTextarea">Comments</label>
            <div class="d-flex justify-content-end mt-2 border-bottom pb-3">
                <button class="btn btn-primary ">Kirim</button>
            </div>
        </div>
        {{-- </div> --}}
        @for ($i = 0; $i < 3; $i++)
            <div class="row rows-cols-1 mx-3">
                <div class="col px-4 py-2 border rounded mb-2">
                    <div class="d-flex gap-2">
                        <div>
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="name fw-semibold">Hadi {{ $i }}</div>
                    </div>
                    <div class="ms-4 text-secondary">aadasdasd asdadasd</div>
                </div>
            </div>
        @endfor
    </div>
@endsection
