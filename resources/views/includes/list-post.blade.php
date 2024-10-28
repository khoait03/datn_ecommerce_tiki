<div class="col-12 col-md-6 col-lg-3">
    <div class="card post-item h-100">
        <div class="box-img">
            <a href="{{ route('detailPost', $item->id) }}"> <img src="../storage/{{ $item->thumbnail }}"
                                                                 class="card-img-top" alt="..."></a>

        </div>

        <div class="card-body content">
            <h5 class="card-title"><a class="text-black text-decoration-none"
                                      href="{{ route('detailPost', $item->id) }}">{{ $item->title }}</a></h5>
            <div class="card-text"><small class="text-body-secondary me-2">{{ $item->user->name }}</small><small
                    class="text-body-secondary">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</small>
            </div>
            <div class="card-text meta-description">{{ $item->meta_description }}
            </div>

        </div>
    </div>
</div>

