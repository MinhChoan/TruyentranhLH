<x-navbar />

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Kết quả tìm kiếm cho truyện "{{ $keyword }}"</h4>
        </div>
    
        <div class="card-body text-center">
            <div class="row row-cols-2 row-cols-md-6 g-4">
                @if ($results->isEmpty())
                <p>Không có truyện nào với tên "{{ $keyword }}" được tìm thấy </p>
                @else
                @foreach ($results as $story)
                    <a href="{{ route('truyen-tranh', ['title' => $story->Title]) }}" class="text-decoration-none">
                        <div class="col">
                            <div class="card border-0">
                                <img src="{{ asset($story->StoriesCover) }}" class="card-img-top" alt="...">
                                
                                <div class="card-body">
                                    <h6 class="card-title">{{ $story->Title }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>