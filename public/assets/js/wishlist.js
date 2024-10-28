const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

function insertWishlist(id, name) {
    $.ajax({
        type: 'POST',
        url: '/wishlist/insert',
        data: {
            id: id,
            name: name,
        },
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function (data) {
            var heartIcon = $('#wishlist-' + id).find('i')
            var statusText = $('.wishlist-status');
            if (data.status === 200) {
                if (heartIcon.hasClass('far')) {
                    heartIcon.removeClass('far').addClass('fas');
                    statusText.text('Đã yêu thích');
                } else {
                    heartIcon.removeClass('fas').addClass('far');
                    statusText.text('Thêm vào yêu thích');
                }

                countWishlist();

                Toast.fire({
                    icon: "success",
                    title: data.message,
                });
            } else {
                Swal.fire({
                    icon: "warning",
                    text: "Vui lòng đăng nhập để thực hiện hành động!",
                    footer: 'Bạn đã có tài khoản? <a href="/login" class="text-decoration-none fw-semibold text-primary">Đăng nhập</a>'
                });
            }
        },
        error: function (xhr, status, error) {
            Toast.fire({
                icon: "error",
                title: 'Đã có lỗi xảy ra!',
            });
            console.error('Lỗi insertWishlist: ' + xhr.status + ' - ' + xhr.statusText);
        },
    })
}

function countWishlist() {
    $.ajax({
        url: '/wishlist/count',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function (response) {
            // $('#count-wishlist').text(response.count);
            if (response.count !== undefined) {
                $('#count-wishlist').text(response.count);
            } else {
                console.error('Dữ liệu không hợp lệ.');
            }
        },
        error: function (xhr, status, error) {
            Toast.fire({
                icon: "error",
                title: 'Đã có lỗi xảy ra!',
            });
            console.error('Lỗi countWishlist: ' + xhr.status + ' - ' + xhr.statusText);
        }
    });
}

$(document).ready(function () {
    countWishlist();
    $('#wishlist-link').on('click', function (event) {
        event.preventDefault();

        $.ajax({
            url: '/wishlist',
            type: 'GET',
            success: function (response) {
                if (response.status === 500) {
                    Swal.fire({
                        icon: "warning",
                        text: "Vui lòng đăng nhập để xem danh sách yêu thích!",
                        footer: 'Bạn đã có tài khoản? <a href="/login" class="text-decoration-none fw-semibold text-primary">Đăng nhập</a>'
                    });
                } else {
                    window.location.href = '/wishlist';
                }
            },
            error: function (xhr, status, error) {
                Toast.fire({
                    icon: "error",
                    title: 'Đã có lỗi xảy ra!',
                });
                console.error('Lỗi wishlist: ' + xhr.status + ' - ' + xhr.statusText);
            }
        });
    });

});

