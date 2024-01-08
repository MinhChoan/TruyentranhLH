<x-navbar/>

<div class="card container">
    <div class="card-header">
      Danh sách truyện thể loại
    </div>
    <div class="card-body text-center">
        <div class="row row-cols-2 row-cols-md-4 g-4">
            @foreach ($truyen as $story)
                @if(isset($story->Title))
                    <a href="{{ route('truyen-tranh', ['title' => $story->Title]) }}" class="text-decoration-none">
                        <div class="col">
                            <div class="card border-0">
                                <img src="{{ asset($story->StoriesCover) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ $story->Title }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>        
    </div>
  </div>