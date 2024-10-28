@extends('index')
@section('main')
    <div class="main">
        <div class="container pb-5">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Cửa hàng</a></li>
                    </ol>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <form id="filterForm" action="{{ route('product.index') }}" method="GET">
                            <div class="filter-heading">
                                <i class="fas fa-filter"></i> Bộ lọc tìm kiếm
                            </div>
                            <input type="hidden" name="category_id" id="selectedCategoryId"
                                   value="{{ request('category_id') }}">
                            @foreach(request('brand_ids', []) as $brandId)
                                <input type="hidden" name="brand_ids[]" value="{{ $brandId }}">
                            @endforeach
                            <input type="hidden" name="sort" id="selectedSort" value="{{ request('sort', '0') }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button custom-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                        <span>Danh mục sản phẩm</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionFlush1">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @php
                                                $displayedCategories = 0;
                                            @endphp
                                            @foreach($Categories as $category)
                                                <li class="category-item" data-category="{{ $category->id }}"
                                                    style="{{ $displayedCategories < 5 ? '' : 'display:none;' }}">
                                                    <a href="#" class="category-link"
                                                       data-id="{{ $category->id }}">{{ $category->name }}</a>
                                                </li>
                                                @php
                                                    $displayedCategories++;
                                                @endphp
                                            @endforeach
                                        </ul>
                                        <button type="button" class="seeAllButton" id="seeAllButtonCategories">Xem Tất
                                            Cả
                                        </button>
                                        <button type="button" class="seeAllButton" id="backToTopCategories">Quay lại
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button custom-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                            aria-controls="flush-collapseTwo">
                                        <span>Thương hiệu</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                     data-bs-parent="#accordionFlush2">
                                    <div class="accordion-body">
                                        @foreach($Brands as $Brand)
                                            <div class="form-check"
                                                 style="{{ $loop->index < 5 ? '' : 'display:none;' }}">
                                                <input class="form-check-input brand-checkbox" type="checkbox"
                                                       name="brand_ids[]" value="{{ $Brand->id }}"
                                                       id="brand{{ $Brand->id }}" {{ in_array($Brand->id, request('brand_ids', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="brand{{ $Brand->id }}">
                                                    {{ $Brand->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                        <button type="button" class="seeAllButton" id="seeAllButtonBrands">Xem Tất Cả
                                        </button>
                                        <button type="button" class="seeAllButton" id="backToTopBrands">Quay lại
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button custom-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapsePrice" aria-expanded="false"
                                            aria-controls="flush-collapsePrice">
                                        <span>Giá</span>
                                    </button>
                                </h2>
                                <div id="flush-collapsePrice" class="accordion-collapse collapse"
                                     data-bs-parent="#accordioncollapsePrice">
                                    <div class="accordion-body">
                                        <div class="price-buttons">
                                            <button type="button" class="price-button" data-min="0" data-max="500000">
                                                Dưới 500.000
                                            </button>
                                            <button type="button" class="price-button" data-min="500000"
                                                    data-max="1000000">500.000 - 1.000.000
                                            </button>
                                            <button type="button" class="price-button" data-min="1000000"
                                                    data-max="5000000">1.000.000 - 5.000.000
                                            </button>
                                            <button type="button" class="price-button" data-min="5000000">Trên
                                                5.000.000
                                            </button>
                                        </div>
                                        <div class="range-inputs">
                                            <div class="input-group">
                                                <label for="minRangeInput">Giá tối thiểu:</label>
                                                <input type="number" class="form-control small-input" id="minRangeInput"
                                                       min="0" step="1">
                                            </div>
                                            <div class="input-group">
                                                <label for="maxRangeInput">Giá tối đa:</label>
                                                <input type="number" class="form-control small-input" id="maxRangeInput"
                                                       min="0" step="1">
                                            </div>
                                        </div>
                                        <button type="button" class="apply-button">Áp dụng</button>
                                        <!-- Nút áp dụng vẫn hiện -->
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button custom-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseRating" aria-expanded="false"
                                            aria-controls="flush-collapseRating">
                                        <span>Xếp hạng</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseRating" class="accordion-collapse collapse"
                                     data-bs-parent="#accordioncollapseRating">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="5" id="star5">
                                            <label class="form-check-label" for="star5">
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="4" id="star4">
                                            <label class="form-check-label" for="star4">
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star-gray"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="3" id="star3">
                                            <label class="form-check-label" for="star3">
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="2" id="star2">
                                            <label class="form-check-label" for="star2">
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="star1">
                                            <label class="form-check-label" for="star1">
                                                <i class="fa fa-star star"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                                <i class="fa fa-star star-gray"></i>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9 content">
                        <div class="content-top">
                            <div class="row align-items-center">
                                <div id="filteredItemCount" class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $filteredItemCount = $products->count();
                                        @endphp
                                        <strong>{{ $filteredItemCount }}</strong> &nbsp; Sản phẩm &nbsp; <strong>
                                            @if(request('category_id'))
                                                @php
                                                    $category = \App\Models\Category::find(request('category_id'));
                                                @endphp
                                                @if($category)
                                                    <span class="filter-btn">{{ $category->name }}</span>
                                                @endif
                                            @endif
                                        </strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <form id="sort-form" method="GET" action="{{ route('product.index') }}">
                                            <div class="form-group me-3">
                                                <select class="form-select" name="sort" aria-label="Sắp xếp theo">
                                                    <option value="0" @if(request('sort', '0') == '0') selected @endif>
                                                        Nổi bật
                                                    </option>
                                                    <option value="1" @if(request('sort', '0') == '1') selected @endif>
                                                        Giá thấp đến cao
                                                    </option>
                                                    <option value="2" @if(request('sort', '0') == '2') selected @endif>
                                                        Giá cao đến thấp
                                                    </option>
                                                    <option value="3" @if(request('sort', '0') == '3') selected @endif>
                                                        Khuyến mãi
                                                    </option>
                                                </select>
                                            </div>
                                        </form>
                                        <div class="btn-group me-3 switchView">
                                            <div id="gridButton" onclick="switchView('grid')"><i
                                                    class="bi bi-grid-3x3-gap-fill"></i></div>
                                            <div id="columnButton" onclick="switchView('column')"><i
                                                    class="bi bi-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filters-applied">
                            @if(request('query'))
                                <p>
                                    <i class="bi bi-search"></i>
                                    Kết quả tìm kiếm cho từ khóa "<span
                                        style="color: red;">{{ request('query') }}</span>"
                                </p>
                            @endif

                            @if(request('category_id'))
                                @php
                                    $category = \App\Models\Category::find(request('category_id'));
                                @endphp
                                @if($category)
                                    <span class="filter-btn">
                {{ $category->name }}
                <button type="button" class="remove-filter" data-filter-type="category"
                        data-filter-value="{{ request('category_id') }}">x</button>
            </span>
                                @endif
                            @endif

                            @php
                                $brandIds = request('brand_ids', []);
                                $brands = \App\Models\Brand::whereIn('id', $brandIds)->get();
                            @endphp

                            @foreach($brands as $brand)
                                <span class="filter-btn">
            {{ $brand->name }}
            <button type="button" class="remove-filter" data-filter-type="brand"
                    data-filter-value="{{ $brand->id }}">x</button>
        </span>
                            @endforeach

                            @if(request('min_price') || request('max_price'))
                                <span class="filter-btn">
            @if(request('min_price') && request('max_price'))
                                        {{ request('min_price') }} - {{ request('max_price') }}
                                    @elseif(request('min_price'))
                                        Từ {{ request('min_price') }}
                                    @elseif(request('max_price'))
                                        Dưới {{ request('max_price') }}
                                    @endif
            <button type="button" class="remove-filter" data-filter-type="price"
                    data-filter-value="{{ request('min_price') }}-{{ request('max_price') }}">x</button>
        </span>
                            @endif

                            @if(request('category_id') || request('brand_ids') || request('min_price') || request('max_price'))
                                <button type="button" class="seeAllButton" id="clearFilters">Xóa tất cả bộ lọc</button>
                            @endif
                        </div>
                        <div class="product">

                            <div id="productGrid" class="product-grid">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-md-4 pb-4 product-item"
                                             data-category="{{ $product->category_id }}"
                                             data-brand="{{ $product->brand_id }}"
                                             data-price="{{ $product->price }}">
                                            <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                                               class="product-link text-decoration-none text-black">
                                                <div class="product-card h-100">
                                                    <div class="product-img">
                                                        @if ($product->main_image)
                                                            <img src="{{ asset('storage/' . $product->main_image) }}"
                                                                 alt="Product Image">
                                                        @else
                                                            <img
                                                                src="https://thudaumot.binhduong.gov.vn/Portals/0/images/default.jpg"
                                                                alt="Default Image">
                                                        @endif
                                                    </div>

                                                    <div class="product-info">
                                                        <div class="product-price-item">
                                                            <div class="price-item">
                                                                <div class="product-price">
                                                                    {{ $product->formattedDisplayedPrice ? $product->formattedDisplayedPrice : 'Price not available' }}
                                                                    @if($product->sale_price)
                                                                        <div class="product-price-discounted">
                                                                            {{ $product->formattedRegularPrice ? $product->formattedRegularPrice : '' }}
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="rating">
                                                                        <?php for ($i = 1;
                                                                                   $i <= 5;
                                                                                   $i++): ?>
                                                                        <?php if ($i <= $product->rating): ?>
                                                                    <i class="bi bi-star-fill" style="color: gold;"></i>
                                                                    <?php elseif ($i - $product->rating < 1): ?>
                                                                    <i class="bi bi-star-half" style="color: gold;"></i>
                                                                    <?php else: ?>
                                                                    <i class="bi bi-star-fill"
                                                                       style="color: lightgray;"></i>
                                                                    <?php endif; ?>
                                                                    <?php endfor; ?>
                                                                </div>
                                                            </div>
                                                            <div class="product-favorite d-flex align-items-center">
                                                                @if(Auth::check())
                                                                    <a onclick="insertWishlist({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                                                       id="wishlist-{{ $product->id }}"><i
                                                                            class="{{ in_array($product->id, $wishlistItems) ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
                                                                @else
                                                                    <a onclick="insertWishlist({{ $product->id }}, '{{ addslashes($product->name) }}')"><i
                                                                            class="far fa-heart"></i></a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <p class="product-title">{{ $product->name }}</p>
                                                        <p class="product-description">{{ $product->description }}</p>
                                                    </div>
                                                    @if($product->sale_price != 0)
                                                        <div class="sale-off fw-bolder">
                                                            -{{ round(100 - ($product->sale_price * 100 / $product->regular_price))  }}
                                                            %
                                                        </div>
                                                    @endif
                                                </div>

                                            </a>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                            <div id="productColumn" class="product-column">
                                @foreach ($products as $product)

                                    <div class="product-card mb-3 product-item"
                                         data-category="{{ $product->category_id }}"
                                         data-brand="{{ $product->brand_id }}"
                                         data-price="{{ $product->price }}">
                                        <div class="row">
                                            <div class="col-12 col-lg-3">
                                                <div class="product-img"><a href="checkout.blade.php"><img
                                                            src="{{ asset('storage/' . $product->main_image) }}"
                                                            alt="Product 1 Image"></a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-9">
                                                <div class="product-info">
                                                    <div class="product-title-item">
                                                        <p class="product-title">{{ $product->name }}</p>
                                                        <div class="product-favorite d-flex align-items-center">
                                                            @if(Auth::check())
                                                                <a onclick="insertWishlist({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                                                   id="wishlist-{{ $product->id }}"><i
                                                                        class="{{ in_array($product->id, $wishlistItems) ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
                                                            @else
                                                                <a onclick="insertWishlist({{ $product->id }}, '{{ addslashes($product->name) }}')"><i
                                                                        class="far fa-heart"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="price-item">
                                                        <div class="product-price">
                                                            {{ $product->formattedDisplayedPrice ? $product->formattedDisplayedPrice : 'Price not available' }}
                                                            @if($product->sale_price)
                                                                <div class="product-price-discounted">
                                                                    {{ $product->formattedRegularPrice ? $product->formattedRegularPrice : '' }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="rating">
                                                            <div class="star">
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </div>
                                                            <div class="number-star">
                                                                7.5
                                                            </div>
                                                            <div class="order">
                                                                145 Orders
                                                            </div>
                                                            <div class="shipping">
                                                                Free Ship
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="product-description">{{ $product->description }} </p>
                                                    <div class="view-detail">
                                                        <a href="">View Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($product->sale_price != 0)
                                            <div class="sale-off fw-bolder">
                                                -{{ round(100 - ($product->sale_price * 100 / $product->regular_price))  }}
                                                %
                                            </div>
                                        @endif
                                    </div>

                                @endforeach
                            </div>
                            <div class="pagination-menu">
                                {{ $products->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--update--}}
