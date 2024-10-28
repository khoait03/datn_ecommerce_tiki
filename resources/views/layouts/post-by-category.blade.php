@section('main')
    <div class="main">
        <div class="container">
            <nav style=""
                 aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 py-3">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href=""
                                                                              class="text-decoration-none">Library</a>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="container-lg">
            <div class="post-by-category">
                <div class="category-banner">
                    <div class="category-name fw-bold">{{ $category->name }}</div>
                    <img src="{{ asset('image/image112.png') }}" alt="BANNER IMG">
                </div>

                <div class="post-featured">
                    <h4>Bài viết nổi bậc</h4>
                    <div class="border rounded bg-white">
                        <div class="row category-post-featured">

                            @foreach($postByCategory as $item)
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="post-info">
                                        <h3 class="info-title"><a class="text-black text-decoration-none"
                                                                  href="{{ route('detailPost', $item->id) }}">{{ $item->title }}</a>
                                        </h3>
                                        <div class="meta-description">
                                            {{ $item->meta_description }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="post-img">
                                        <a href="{{ route('detailPost', $item->id) }}"><img
                                                src="../storage/{{ $item->thumbnail }}" alt=""></a>

                                    </div>
                                </div>

                                @break
                            @endforeach
                        </div>
                    </div>

                </div>


            </div>

            <div class="list-post">
                <h4>Bài mới mỗi ngày</h4>
                <div class="row gy-3">
                    @foreach($postByCategory->skip(1) as $item)
                        @include('includes.list-post')
                    @endforeach


                </div>
            </div>

            @include('includes.category-post')
        </div>

        <div class="section-subscribe d-flex align-items-center flex-wrap flex-column">
            <div class="subscribe-text mb-3 text-center">
                <h5 class="mb-0 fs-xs-1">Subscribe on our newsletter</h5>
                <span>Get daily news on upcoming offers from many suppliers all over the world</span>
            </div>
            <div class="subscribe-form">
                <form action="">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" class="form-control" name="">
                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@extends('index')
