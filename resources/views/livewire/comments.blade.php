<div>
    <div class="comment mt-5">
        <p class="fw-bold">Comment:</p>
        <form wire:submit.prevent="addComment">
            <div class="form-floating mx-3 mb-3">
                <textarea class="form-control border border-primary" wire:model.lazy="content" style="height: 100px"></textarea>
                <label for="floatingTextarea">Comments</label>
                <div class="d-flex justify-content-end mt-2 border-bottom pb-3">
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </div>
        </form>

        @forelse ($comments as $comment)
            <div class="row rows-cols-1 mx-3">
                <div class="col px-4 py-2 border rounded mb-2">
                    <div class="d-flex gap-2">
                        <div>
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="name fw-semibold">{{ $comment->user->name }}</div>
                    </div>
                    <div class="ms-4 text-secondary">{{ $comment->content }}</div>
                </div>
            </div>
        @empty
            <div class="row rows-cols-1 mx-3">
                <div class="col px-4 py-2 border rounded mb-2">
                    <div class="ms-4 text-secondary">Belum ada komentar</div>
                </div>
            </div>
        @endforelse
    </div>
</div>
