<div x-data="{
    init() {
        // Fitur otomatis load saat scroll (jika browser mendukung)
        if ('IntersectionObserver' in window) {
            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        Livewire.dispatch('load-more');
                    }
                });
            });
            observer.observe(this.$refs.loadMoreTrigger);
        }
    }
}" class="space-y-3">

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

    <div wire:loading class="d-flex justify-content-center">
        <div wire:loading class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    {{-- Tombol Load More (fallback) --}}
    @if ($hasMore)
        <div class="text-center mt-2">
            <button wire:click="loadMore" class="btn btn-outline-secondary btn-sm" wire:loading.attr="disabled">
                Load More
            </button>
        </div>
    @else
        <div class="text-center text-muted small">
            <em>Semua komentar sudah ditampilkan</em>
        </div>
    @endif
    <div x-ref="loadMoreTrigger" class="mt-3"></div>
</div>
