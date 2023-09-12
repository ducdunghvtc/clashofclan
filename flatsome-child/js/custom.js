jQuery(document).ready(function($) {
    $('#show-popup-button').click(function(e) {
        e.preventDefault();
        
        // Hiển thị popup
        $.fancybox.open({
            src: '#contact-form-popup',
            type: 'inline',
        });
        // Tự động điền giá và tên sản phẩm vào biểu mẫu liên hệ
        $('input[name="your-product"]').val(productData.product_name);
        $('input[name="your-price"]').val(productData.product_price);
    });
});
