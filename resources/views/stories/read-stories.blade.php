<x-navbar/>
<!-- Display chapter details -->
<div class="container">
    <nav aria-label="breadcrumb d-flex justify-content-center">
        <ol class="breadcrumb ">
          <li class="breadcrumb-item"><a href="/" class="text-dark link-underline-dark">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{ route('truyen-tranh', ['title' => $story->Title]) }}" class="text-dark link-underline-dark"> {{ $story->Title }} </a></li>
          <li class="breadcrumb-item active" aria-current="page" class="text-dark link-underline-dark">
            {{ $chapterInfo['chapter']->Title }}
          </li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="panigation">

    </div>
</div>
<div class="col text-center">
    @foreach ($chapterInfo['images'] as $image)
        <img src="{{ $image->ImageURL }}" alt="Image {{ $image->ImageID }}" class="mx-auto d-block mb-3">
    @endforeach
    <ul class="pagination"></ul>
</div>


