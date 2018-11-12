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

$('select.select2.categories').change(function () {
    get_specs($(this).val());
});

function get_specs (id) {
    $.get('/panel/specs/get/' + id, function(data, status){
        if(status == 'success') {
            var spec_id = data.id;
            data = JSON.parse(data.specs);
            var temp = '';
            for (item in data) {
                temp += '<div class="row"><div class="col-md-2"><h5 class="mb-10 col-md-12 border-bottom">';
                temp += '<i class="ti-angle-double-left" style="font-size: 15px; color:darkgray;"></i>';
                temp += '<b>' + data[item]['header'] + '</b></h5></div><div class="col-md-10"><div class="col-md-12">';

                for (spec in data[item]['items'])
                {
                    temp += '<div class="col-md-6">';
                    if (data[item]['items'][spec]['select'] !== undefined)
                    {
                        temp += '<div class="form-group">';
                        temp += '<label class="control-label mb-10">' + data[item]['items'][spec]['name'] + '</label>';
                        temp += '<div class="radio-list">';
                        var x = 0;
                        for (select in data[item]['items'][spec]['select'])
                        {
                            temp += '<div class="radio-inline"><div class="radio radio-info">';
                            var id = 'id-' + Math.floor((Math.random() * 10000) + 1);
                            temp += '<input type="radio" id="' + id + '"';
                            if (x++ == 0)
                            {
                                temp += ' checked="checked" ';
                            }
                            temp += 'name="specs[' + data[item]['value'] + '][' + data[item]['items'][spec]['value'] + ']"';
                            temp += 'value="' + data[item]['items'][spec]['select'][select] + '" />';
                            temp += '<label for="' + id + '">' + data[item]['items'][spec]['select'][select]; 
                            if (data[item]['items'][spec]['label'] !== undefined)
                            {
                                temp += data[item]['items'][spec]['label'];
                            }
                            temp += ' </label></div></div>';	
                        }
                        
                        temp += '</div></div>';
                    }
                    else
                    {
                        temp += '<div class="form-group"><label class="control-label mb-10">';
                        temp += data[item]['items'][spec]['name'] + '</label>';
                        if (data[item]['items'][spec]['label'] !== undefined)
                        {
                            temp += '<div class="input-group">';
                        }
                        temp += '<input type="text" class="form-control"';
                        temp += 'name="specs['+data[item]['value']+']['+data[item]['items'][spec]['value']+']"';
                        if (data[item]['items'][spec]['help'] !== undefined)
                        {
                            temp += 'placeholder="' + data[item]['items'][spec]['help'] + '"';

                        }            
                        temp += '>';
                        if (data[item]['items'][spec]['label'] !== undefined)
                        {
                            temp += '<div class="input-group-addon">'+data[item]['items'][spec]['label']+'</div></div>';
                        }
                        temp += '</div>';
                    }
                    temp += '</div>';
                }
                
                temp += '</div></div></div><div class="seprator-block"></div><hr class="light-grey-hr"/>';
                temp += '<div class="seprator-block"></div>';
            }            
            temp += '<input type="hidden" name="spec_id" value="' + spec_id + '" />';

            $('.specs-table').html(temp);
        }
    });
}