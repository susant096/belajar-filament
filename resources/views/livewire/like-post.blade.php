<div>
    <div class="d-flex ">
        <div class="fs-4 d-flex gap-3">

            <a href="javascript:void(0)" class="" wire:click="toggleLike()">
                @if ($like)
                    <i class="bi bi-heart-fill text-danger"></i>
                @else
                    <i class="bi bi-heart text-secondary"></i>
                @endif
            </a>
            <a href="javascript:void(0)" wire:click="toggleBookmark()">
                @if ($bookmark)
                    <i class="bi bi-bookmark-fill text-warning"></i>
                @else
                    <i class="bi bi-bookmark text-secondary"></i>
                @endif
            </a>
            <a href="javascript:void(0)" class="text-decoration-none text-secondary">
                <i class="bi bi-chat"></i><small style="font-size: 0.6em"> 122</small>
            </a>
        </div>
    </div>
</div>
