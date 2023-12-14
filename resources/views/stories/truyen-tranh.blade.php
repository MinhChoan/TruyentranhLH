<x-navbar/>
<p></p>
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card mb-3">
                <div class="card-body stories">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="stories-cover">
                                <img src="
                            https://i.postimg.cc/0Q2h5RT6/evangelion.jpg
                            {{-- {{ asset($story->StoriesCover) }} --}}
                            " class="card-img-top" alt="...">
                            </div>
                            
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="stories-title">
                                <span>
                                    <h4>{{ $title }}</h4>
                                </span>
                            </div>
                            <div class="stories-infomation">
                                <div class="stories-item">
                                    <span class="stories-name font-weight-bold">
                                        Tên khác:
                                    </span>
                                    <span class="stories-value">
                                        {{ $differentName }}
                                    </span>
                                </div>
                                <div class="stories-item">
                                    <span class="stories-name font-weight-bold">
                                        Thể loại:
                                    </span>
                                    <span class="stories-value">
                                        @foreach ($categories as $genre)
                                        <span class="badge badge-primary">{{ $genre }}</span>
                                        @endforeach
                                    </span>
                                </div>
                                <div class="stories-item">
                                    <span class="stories-name font-weight-bold">
                                        Tác giả:
                                    </span>
                                    <span class="stories-value">
                                        {{ $author }}
                                    </span>
                                </div>
                            </div>                            
                           <p></p>
                           <div class="col-12 bottom-features">
                            <div class="side-features">
                                <div class="row justify-content-center">
                                    <div class="col-md-2 col-2 feature-item">
                                        <a href="" class="text-decoration-none text-dark">
                                            <span class="d-block feature-value display-6">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                            </span>
                                            <span class="block feature-name">20</span>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-2 feature-item">
                                        <a href="" class="text-decoration-none text-dark">
                                            <span class="d-block feature-value display-6">
                                                <i class="bi bi-hand-thumbs-down"></i>
                                            </span>
                                            <span class="block feature-name">20</span>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-2 feature-item">
                                        <a href="" class="text-decoration-none text-dark">
                                            <span class="d-block feature-value display-6">
                                                <i class="bi bi-suit-heart"></i>
                                            </span>
                                            <span class="block feature-name">20</span>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-2 feature-item">
                                        <a href="" class="text-decoration-none text-dark">
                                            <span class="d-block feature-value display-6">
                                                <i class="bi bi-star"></i>
                                            </span>
                                            <span class="block feature-name">20</span>
                                        </a>
                                    </div>
                                    <div class="col-md-2 col-2 feature-item">
                                        <a href="" class="text-decoration-none text-dark">
                                            <span class="d-block feature-value display-6">
                                                <i class="bi bi-share"></i>
                                            </span>
                                            <span class="block feature-name">20</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                      </div>
                    
                </div>
                <div class="card-body summary">
                    <div class="row">
                        <div class="value">
                            <h5>Tóm Tắt</h5>
                        </div>
                        <div class="content">
                                {!! $content !!}
                        </div>
                    </div>
                </div>
              </div>
            <div class="card mb-3">
                <div class="card-header">
                    Danh sách chương
                  </div>
                <div class="card-body chapter">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                  Quote
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>A well-known quote, contained in a blockquote element.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                  </blockquote>
                </div>
              </div>
        </div>
    </div>
    
</div>
