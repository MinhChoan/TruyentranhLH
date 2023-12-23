<x-navbar/>
<!-- Display chapter details -->

<div class="col text-center">
    @foreach ($chapterInfo['images'] as $image)
        <img src="{{ $image->ImageURL }}" alt="Image {{ $image->ImageID }}" class="mx-auto d-block mb-3">
    @endforeach
</div>

