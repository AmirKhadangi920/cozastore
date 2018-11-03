$('.js-show-modal1').click(function (e) {
    var id = $(this).attr('href');

    quickview(id);

    e.preventDefault();
});

function quickview (id) {
    
    $.get('/product/quickview/' + id, function(data, status){
        if(status == 'success') {
            data = JSON.parse(data);
            
            $('.js-modal1 .js-name-detail').text(data.name);
            $('.js-modal1 .price').text(data.price + ' تومان');
            $('.js-modal1 .short-description').text(data['short_description']);


            if (data.colors)
            {
                colors = data.colors.split(',');
                var color_options = '<option value="">یک رنگ انتخاب کنید</option>';
                for (var i = 0; i < colors.length; ++i) {
                    color_options += '<option value="' + colors[i] + '">'+ colors[i] +'</option>';
                }
                $('.js-select2').parent().parent().parent().show();
                $('.js-select2').html(color_options);
            } else {
                $('.js-select2').parent().parent().parent().hide();
            }
            
            var photos = data.gallery.split(",");            
            var gallery = '<div class="wrap-slick3-dots"></div>';
            gallery += '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';
            gallery += '<div class="slick3 gallery-lb">';
									
            for (var i = 0; i < photos.length; ++i) {
                gallery += '<div class="item-slick3" data-thumb="uploads/' + photos[i] + '">';
                gallery += '<div class="wrap-pic-w pos-relative">';
                gallery += '<img src="uploads/' + photos[i] + '" alt="IMG-PRODUCT">';
                gallery += '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" ';
                gallery += 'href="uploads/products/' + photos[i] + '">';
                gallery += '<i class="fa fa-expand"></i></a></div></div>';
            }
            gallery += '</div>';

            if (data.aparat_video) {
                var video = '<div id="aparat_video" class="m-b-30">';
                video += '<script type="text/JavaScript" src="https://www.aparat.com/embed/' + data.aparat_video + '?data[rnddiv]=aparat_video&data[responsive]=yes"></script>';
                video += '</div>';

                $('.js-modal1 .video').html(video);
            } else {
                $('.js-modal1 .video').html('');
            }
            
            $('.js-modal1 .product-gallery').html(gallery);
            $('.js-modal1 .js-addcart-detail').click(function () 
            {
                var url = '/cart/add/'+id+'/'+data.name+'/'+$('.js-modal1 .num-product').val();
                if ($('.js-select2').val()) {
                    url += '/' + $('.js-select2').val();
                }
                window.location = url;
            });

            $('.wrap-slick3').each(function(){
                $(this).find('.slick3').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 6000,
    
                    arrows: true,
                    appendArrows: $(this).find('.wrap-slick3-arrows'),
                    prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    
                    dots: true,
                    appendDots: $(this).find('.wrap-slick3-dots'),
                    dotsClass:'slick3-dots',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');
                        return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                    },  
                });
            });

            $('.js-modal1').addClass('show-modal1');
        }
    });
}