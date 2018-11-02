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

            var photos = data.gallery.split(",");
            
            var gallery = '<div class="wrap-slick3-dots"></div>';
            gallery += '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';
            gallery += '<div class="slick3 gallery-lb">';
									
            for (var i = 0; i < photos.length; ++i) {
                gallery += '<div class="item-slick3" data-thumb="uploads/products/' + photos[i] + '">';
                gallery += '<div class="wrap-pic-w pos-relative">';
                gallery += '<img src="uploads/products/' + photos[i] + '" alt="IMG-PRODUCT">';
                gallery += '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" ';
                gallery += 'href="uploads/products/' + photos[i] + '">';
                gallery += '<i class="fa fa-expand"></i></a></div></div>';
            }
            gallery += '</div>';

            if (data.aparat_video) {
                data.aparat_video = data.aparat_video.split('|');
                var video = '<div id="' + data.aparat_video[0] + '" class="m-b-30">';
                video += '<script type="text/JavaScript" src="https://www.aparat.com/embed/' + data.aparat_video[1] + '?data[rnddiv]=' + data.aparat_video[0] + '&data[responsive]=yes"></script>';
                video += '</div>';

                $('.js-modal1 .video').html(video);
            } else {
                $('.js-modal1 .video').html('');
            }
            
            $('.js-modal1 .product-gallery').html(gallery);

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