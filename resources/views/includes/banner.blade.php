<div class="main">
    <div class="container">
        <div class="section-banner border rounded-2">
            <div class="d-grid group">
                <div class="category">
                    <ul class="list-group">
                        @foreach($categoryBanners as $categoryBanner)
                            <li class="list-group-item">{{ $categoryBanner->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="image-banner" style="max-width: 100%">
                    <div class="content">
                        {{-- <div class="text">
                            <h2>Mua hàng online giá tốt, hàng chuẩn, ship nhanh</h2>
                        </div> --}}
                        {{-- <div class="button">
                            <button class="btn bg-white">Learn more</button>
                        </div> --}}
                    </div>
                    <div class="box-img">
                        <img src="{{ asset('images/banner-tiki.png') }}" alt="">
                
                
                    </div>
                </div>
                @if(auth()->check())
                    <div class="box">
                        <div class="box-1 mt-0 rounded-2">
                            <div class="d-flex mb-3">
                                <div class="avatar">
                                    <img src="{{ asset('storage/'. auth()->user()->avatar) }}" alt="">
                                </div>
                                <div class="text">
                                    Xin chào {{ auth()->user()->name }}
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                
                                <a style="color: #ffff" href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    Hồ sơ
                                </a>
                                
                                <a style="color: #ffff" href="{{ route('logout') }}" class="btn btn-primary">
                                    Đăng xuất
                                </a>
                                
                            </div>
                            <!-- <button class="btn btn-primary mb-2">Join now</button>
                            <button class="btn bg-white">Login</button> -->
                        </div>
                        <div class="box-2 rounded-2">
                            <div> Được giảm 10% với nhà cung cấp mới</div>
                        </div>
                        <div class="box-3 rounded-2">
                            <div>Gửi báo giá với tùy chọn nhà cung cấp</div>
                        </div>
                    </div>
                @else

                    <div class="box">
                        <div class="box-1 mt-0 rounded-2">
                            <div class="d-flex mb-3">
                                <div class="avatar">
                                    <img src="https://t4.ftcdn.net/jpg/05/11/55/91/240_F_511559113_UTxNAE1EP40z1qZ8hIzGNrB0LwqwjruK.jpg" alt="">
                                </div>
                                <div class="text">
                                    Chào mừng đến với website
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a style="color: #ffff" href="{{ route('login') }}" class="btn btn-primary" type="button">Đăng nhập</a>
                                <a style="color: #ffff" href="{{ route('register') }}" class="btn btn-primary" type="button">Đăng ký</a>
                            </div>
                            <!-- <button class="btn btn-primary mb-2">Join now</button>
                            <button class="btn bg-white">Login</button> -->
                        </div>
                        <div class="box-2 rounded-2">
                            <div> Được giảm 10% với nhà cung cấp mới</div>
                        </div>
                        <div class="box-3 rounded-2">
                            <div>Gửi báo giá với tùy chọn nhà cung cấp</div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
{{--update--}}
