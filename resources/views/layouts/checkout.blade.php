@extends('index')
@section('main')
    <div class="main">
        <div class="section-cart pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-7">
                        <h4 class="mb-4"><strong>SẢN PHẨM CỦA BẠN</strong></h4>
                        <div class="card px-3">
                            <div class="cart-item py-3">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-10">
                                        <div class="d-flex">
                                            <div class="box-img me-3">
                                                <img src="{{ asset('image/img2.jpg') }}" alt="" class="rounded-1">
                                            </div>
                                            <div class="box-content">
                                                <div class="title">T-shirts with multiple colors, for men and lady</div>
                                                <div class="text mb-2">
                                                    Size: medium, Color: blue, Material: Plastic <br> Seller: Artel Market
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-2">
                                        <div class="price">$78.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card px-3">
                            <div class="cart-item py-3">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-10">
                                        <div class="d-flex">
                                            <div class="box-img me-3">
                                                <img src="{{ asset('image/img2.jpg') }}" alt="" class="rounded-1">
                                            </div>
                                            <div class="box-content">
                                                <div class="title">T-shirts with multiple colors, for men and lady</div>
                                                <div class="text mb-2">
                                                    Size: medium, Color: blue, Material: Plastic <br> Seller: Artel Market
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-2">
                                        <div class="price">$78.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card px-3">
                            <div class="cart-item py-3">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-10">
                                        <div class="d-flex">
                                            <div class="box-img me-3">
                                                <img src="{{ asset('image/img2.jpg') }}" alt="" class="rounded-1">
                                            </div>
                                            <div class="box-content">
                                                <div class="title">T-shirts with multiple colors, for men and lady</div>
                                                <div class="text mb-2">
                                                    Size: medium, Color: blue, Material: Plastic <br> Seller: Artel Market
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-2">
                                        <div class="price">$78.99</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="border p-3"> <!-- Thêm border và padding cho khung -->
                                    <div class="total-info">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>Tổng:</div>
                                            <div>$216.500</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>Giảm giá:</div>
                                            <div style="color: red;">-$00.00</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <div>Thuế:</div>
                                            <div style="color: rgba(32,133,61,0.97);">+$14.00</div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>
                                            <div>Tổng cộng:</div>
                                        </strong>
                                        <div><h3>230.500</h3></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="border p-3">
                            <h4 class="mb-4"><strong>HOÀN TẤT ĐƠN HÀNG CỦA BẠN</strong></h4>
                            <div class="my-4">
                                <h4 style="color: blue;"><strong>Thông tin thanh toán</strong></h4>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="Name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="Name" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="LastName" class="form-label">Họ</label>
                                        <input type="text" class="form-control" id="LastName" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="Email" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="Phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="Phone" aria-label="Tên">
                                    </div>
                                </div>
                            </div>
                            <div class="my-4">
                                <h4 style="color: blue;"><strong>Chi tiết thanh toán</strong></h4>
                                <div class="payment d-flex my-4">
                                    <img class="mt-3 mx-2 payment-logo"
                                         src="https://tse3.mm.bing.net/th?id=OIP.jOUW5N630RdeYpEB-cnPGQAAAA&pid=Api&P=0&h=180"
                                         alt="">
                                    <img class="mt-3 mx-2 payment-logo"
                                         src="https://tse3.mm.bing.net/th?id=OIP.SFfuwImiHUnsYUvtMr2elgHaEK&pid=Api&P=0&h=180"
                                         alt="">
                                    <img class="mt-3 mx-2 payment-logo"
                                         src="https://tse4.mm.bing.net/th?id=OIP.pPSmbT_SV82uYvk5ZR5shQHaFK&pid=Api&P=0&h=180"
                                         alt="">
                                    <img class="mt-3 mx-2 payment-logo"
                                         src="https://apithanhtoan.com/wp-content/uploads/2020/08/logo-ngan-hang-ACB.png"
                                         alt="">
                                    <img class="mt-3 mx-2 payment-logo"
                                         src="https://purepng.com/public/uploads/large/purepng.com-google-pay-gpay-logobrandlogobrand-logoiconssymbolslogosgoogle-681522937443muxmx.png"
                                         alt="">
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="cardHolderName" class="form-label">Tên chủ thẻ</label>
                                        <input type="text" class="form-control" id="cardHolderName" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="cardNumber" class="form-label">Số thẻ</label>
                                        <input type="text" class="form-control" id="cardNumber" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="expirationDate" class="form-label">Ngày hết hạn </label>
                                        <input type="text" class="form-control" id="expirationDate" placeholder="MM/YY"
                                               aria-label="Tên">
                                    </div>
                                </div>
                            </div>
                            <div class="my-4">
                                <h4 style="color: blue;"><strong>Địa chỉ giao hàng</strong></h4>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="specificAddress" class="form-label">Địa chỉ cụ thể</label>
                                        <input type="text" class="form-control" id="specificAddress" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="province" class="form-label">Tỉnh/Thành</label>
                                        <input type="text" class="form-control" id="province" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="district" class="form-label">Quận/Huyện</label>
                                        <input type="text" class="form-control" id="district" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="ward" class="form-label">Xã/Phường</label>
                                        <input type="text" class="form-control" id="ward" aria-label="Tên">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="street" class="form-label">Đường</label>
                                        <input type="text" class="form-control" id="street" aria-label="Tên">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-dark" type="button">Hủy bỏ</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="button" onclick="return validateForm()"><strong>Hoàn tất mua hàng</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End .main -->
@endsection

{{--update--}}
