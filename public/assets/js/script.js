// ---------------
// change image
// ---------------
function changeImg(pic) {
    document.getElementById('change_image').src = pic;
}
document.addEventListener('DOMContentLoaded', function () {
    const clearAllButton = document.getElementById('Clearallfilter');
    clearAllButton.style.display = 'none';
});


//Chuyển đổi hiển thị dạng cột và dạng mảng
window.addEventListener('DOMContentLoaded', function () {
    var gridButton = document.getElementById('gridButton');
    var columnButton = document.getElementById('columnButton');
    var productGrid = document.getElementById('productGrid');
    var productColumn = document.getElementById('productColumn');

    gridButton.disabled = true;
    columnButton.disabled = false;
    productGrid.style.display = 'block';
    productColumn.style.display = 'none';

    gridButton.addEventListener('click', function () {
        gridButton.disabled = true;
        columnButton.disabled = false;
        productGrid.style.display = 'block';
        productColumn.style.display = 'none';
    });

    columnButton.addEventListener('click', function () {
        gridButton.disabled = false;
        columnButton.disabled = true;
        productGrid.style.display = 'none';
        productColumn.style.display = 'block';
    });
});
//Lọc giá trị thấp cao
document.querySelector('#sort-form select[name="sort"]').addEventListener('change', function () {
    document.querySelector('#sort-form').submit();
});
// Ẩn nút "Quay lại" ban đầu
document.getElementById('backToTopCategories').style.display = 'none';
document.getElementById('backToTopBrands').style.display = 'none';

document.getElementById('seeAllButtonCategories').addEventListener('click', function () {
    var categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(function (item) {
        item.style.display = 'block';
    });
    // Hiển thị nút "Quay lại" và ẩn nút "Xem Tất Cả"
    document.getElementById('backToTopCategories').style.display = 'inline-block';
    this.style.display = 'none';
});

document.getElementById('seeAllButtonBrands').addEventListener('click', function () {
    var brandCheckboxes = document.querySelectorAll('.form-check');
    brandCheckboxes.forEach(function (checkbox) {
        checkbox.style.display = 'block';
    });
    // Hiển thị nút "Quay lại" và ẩn nút "Xem Tất Cả"
    document.getElementById('backToTopBrands').style.display = 'inline-block';
    this.style.display = 'none';
});

document.getElementById('backToTopCategories').addEventListener('click', function () {
    var categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(function (item, index) {
        if (index >= 5) {
            item.style.display = 'none';
        }
    });
    // Hiển thị nút "Xem Tất Cả" và ẩn nút "Quay lại"
    document.getElementById('seeAllButtonCategories').style.display = 'inline-block';
    this.style.display = 'none';
});

document.getElementById('backToTopBrands').addEventListener('click', function () {
    var brandCheckboxes = document.querySelectorAll('.form-check');
    brandCheckboxes.forEach(function (checkbox, index) {
        if (index >= 5) {
            checkbox.style.display = 'none';
        }
    });
    // Hiển thị nút "Xem Tất Cả" và ẩn nút "Quay lại"
    document.getElementById('seeAllButtonBrands').style.display = 'inline-block';
    this.style.display = 'none';
});
//Lọc theo danh mục
document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('selectedCategoryId').value = this.dataset.id;
        document.getElementById('filterForm').submit();
    });
});
// Lọc theo danh mục
document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const selectedCategoryId = this.dataset.id;
        const url = new URL(window.location.href);

        // Cập nhật tham số category_id trong URL
        url.searchParams.set('category_id', selectedCategoryId);

        // Giữ lại giá nếu đã chọn
        const minPrice = url.searchParams.get('min_price');
        const maxPrice = url.searchParams.get('max_price');
        if (minPrice) {
            url.searchParams.set('min_price', minPrice);
        }
        if (maxPrice) {
            url.searchParams.set('max_price', maxPrice);
        }

        // Chuyển hướng đến URL mới
        window.location.href = url.toString();
    });
});

// Lọc theo thương hiệu
document.querySelectorAll('.brand-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const url = new URL(window.location.href);

        // Lấy tất cả các brand_ids đã chọn
        let brandIds = url.searchParams.getAll('brand_ids[]');

        // Nếu checkbox được chọn, thêm vào brandIds; nếu không, xóa khỏi brandIds
        if (this.checked) {
            brandIds.push(this.value);
        } else {
            brandIds = brandIds.filter(id => id !== this.value);
        }

        // Cập nhật tham số brand_ids trong URL
        url.searchParams.delete('brand_ids[]');
        brandIds.forEach(id => url.searchParams.append('brand_ids[]', id));

        // Giữ lại giá nếu đã chọn
        const minPrice = url.searchParams.get('min_price');
        const maxPrice = url.searchParams.get('max_price');
        if (minPrice) {
            url.searchParams.set('min_price', minPrice);
        }
        if (maxPrice) {
            url.searchParams.set('max_price', maxPrice);
        }

        // Chuyển hướng đến URL mới
        window.location.href = url.toString();
    });
});

// Lọc theo giá (giữ lại khoảng giá đã chọn khi thay đổi bộ lọc khác)
document.querySelectorAll('.price-button').forEach(button => {
    button.addEventListener('click', function () {
        const minPrice = this.getAttribute('data-min');
        const maxPrice = this.getAttribute('data-max');
        const url = new URL(window.location.href);

        // Cập nhật tham số URL cho giá
        url.searchParams.set('min_price', minPrice);
        if (maxPrice) {
            url.searchParams.set('max_price', maxPrice);
        } else {
            url.searchParams.delete('max_price');
        }

        // Chuyển hướng đến URL mới
        window.location.href = url.toString();
    });
});
// Sắp xếp
document.querySelector('#sort-form select').addEventListener('change', function () {
    const selectedSort = this.value;
    const url = new URL(window.location.href);

    // Cập nhật tham số sort trong URL
    url.searchParams.set('sort', selectedSort);

    // Giữ lại tất cả các bộ lọc khác
    const minPrice = url.searchParams.get('min_price');
    const maxPrice = url.searchParams.get('max_price');
    const categoryId = url.searchParams.get('category_id');
    const brandIds = url.searchParams.getAll('brand_ids[]');

    if (minPrice) {
        url.searchParams.set('min_price', minPrice);
    }
    if (maxPrice) {
        url.searchParams.set('max_price', maxPrice);
    }
    if (categoryId) {
        url.searchParams.set('category_id', categoryId);
    }
    brandIds.forEach(id => {
        url.searchParams.append('brand_ids[]', id);
    });

    // Cập nhật giá trị selectedSort
    document.getElementById('selectedSort').value = selectedSort;

    // Chuyển hướng đến URL mới
    window.location.href = url.toString();
});

// Xử lý nút "Áp dụng" cho nhập giá
document.querySelector('.apply-button').addEventListener('click', function () {
    const minPrice = document.getElementById('minRangeInput').value;
    const maxPrice = document.getElementById('maxRangeInput').value;
    const url = new URL(window.location.href);

    // Cập nhật tham số URL cho giá
    if (minPrice) {
        url.searchParams.set('min_price', minPrice);
    } else {
        url.searchParams.delete('min_price');
    }

    if (maxPrice) {
        url.searchParams.set('max_price', maxPrice);
    } else {
        url.searchParams.delete('max_price');
    }

    // Chuyển hướng đến URL mới
    window.location.href = url.toString();
});


//Filler
document.addEventListener('DOMContentLoaded', function () {
    // Remove individual filters
    document.querySelectorAll('.remove-filter').forEach(button => {
        button.addEventListener('click', function () {
            let filterType = this.getAttribute('data-filter-type');
            let filterValue = this.getAttribute('data-filter-value');
            let url = new URL(window.location.href);

            if (filterType === 'category') {
                url.searchParams.delete('category_id');
            } else if (filterType === 'brand') {
                let brandIds = url.searchParams.getAll('brand_ids[]');
                brandIds = brandIds.filter(id => id !== filterValue);
                url.searchParams.delete('brand_ids[]');
                brandIds.forEach(id => url.searchParams.append('brand_ids[]', id));
            } else if (filterType === 'price') {
                url.searchParams.delete('min_price');
                url.searchParams.delete('max_price');
            }

            window.location.href = url.toString();
        });
    });
    // Clear all filters
    document.getElementById('clearFilters').addEventListener('click', function () {
        let url = new URL(window.location.href);
        url.searchParams.delete('category_id');
        url.searchParams.delete('brand_ids[]');
        url.searchParams.delete('min_price');
        url.searchParams.delete('max_price');
        url.searchParams.delete('sort');
        window.location.href = url.toString();
    });

});




