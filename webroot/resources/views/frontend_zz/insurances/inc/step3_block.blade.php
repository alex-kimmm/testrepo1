<div class="cover-me-card cover-me-card-{{ $insuranceBlock->position }}">
    <div class="music-musician-bg" style="background-image: url('{{ asset($insuranceBlock->image != null ? $insuranceBlock->getImageUrl() : '') }}');">
        <div class="desc">
            <div class="title"><span>{{ $insuranceBlock->title }}</span></div>
            <div class="description"><span>{{ $insuranceBlock->summary }}</span></div>
        </div>
    </div>
</div>