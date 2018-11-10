$(document).ready(function(){
 
    // selectable group section
    $('select.select2').select2();
    
    // dropable picture upload
	$('.dropify.file').dropify();
    
    // Change color of color section labels
    $('.color-value').on('change', function () { 
        var color = $('select.color-value').val();
        $('input.color-value').val(color);
        
        var li = $('li.select2-selection__choice').first();
        for (var i = 0; i < color.length; ++i) {
            li.css({background: color[i]});
            li = li.next();
        }
    });

    var i = 1;
    // add new features section
	$('.create-new-feautre').click(function () {
        var featuresRow = s2[0] + i + s2[1] + (i++) + s2[2];
        $('.features-values').append(featuresRow);
        $('.features-values').children('.features-row').last().find('.select2').select2();
        $('.features-values').children('.features-row').last().css({display: 'none'});
        $('.features-values').children('.features-row').last().slideDown();
    });
    
    $('.add-pics').click(function () { 
        var photo = $(this).parent().parent().prev().find('li').first();
        var photos = '';

        do {
            if (photo.find('a').hasClass('selected')) {
                photos += photo.attr('photo') + ',';
            }
            photo = photo.next();
        } while (photo.html() != undefined);

        photos = photos.substring(0, photos.length-1);
        if (photos.indexOf(',') != -1) {
            photo = photos.substring(0, photos.indexOf(','));
        } else {
            photo = photos;
        }
        
        $('#single_photo').val(photo);
        $('#gallery').val(photos);

        var temp = '';
        if (photos != '') {
            photos = photos.split(',');

            for (value in photos) {
                temp += '<div class="col-md-2 col-xs-4 mb-30"><div class="img-upload-wrap">';
                temp += '<input type="file" disabled data-show-remove="false" data-default-file="/uploads/'+photos[value]+'" class="dropify file" /></div></div>';
            }
        } else {
            photos = [];
        }


        $('.preview-gallery').html(temp);
        $('.preview-gallery .dropify').dropify();

        if (photos.length != 0) {
            $('.fileupload').removeClass('btn-default').addClass('btn-warning');
            $('.fileupload i').removeClass('fa-plus').addClass('fa-edit');
            $('.fileupload .btn-text').text('ویرایش تصاویر');
            $('#picture-files .alert').fadeOut();
        } else {
            $('.fileupload').removeClass('btn-warning').addClass('btn-default');
            $('.fileupload i').removeClass('fa-edit').addClass('fa-plus');
            $('.fileupload .btn-text').text('افزودن تصویر جدید');
            $('#picture-files .alert').fadeIn();
        }

    });
});