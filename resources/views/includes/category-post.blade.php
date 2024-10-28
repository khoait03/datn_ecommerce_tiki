<div class="category-post">
    <h4 class="mb-3">Danh mục</h4>
    <div class="d-flex flex-wrap">
        @foreach($categoryAll as $item)
            <a class="category-post-item text-black text-decoration-none border rounded py-2 px-4 me-2 mb-2"
               href="{{ route('postByCategory',$item->id) }}">{{ $item->name }}</a>
        @endforeach

    </div>
</div>
