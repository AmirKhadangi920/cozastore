$(document).ready(function(){
 
    // selectable group section
    $('select.select2').select2();
    
    // dropable picture upload
	$('#input-file-now').dropify();
    
    // add new dropabe picture section
    $('#add-new-picture').click(function () {
        var newPic = '<div class="col-md-2 col-xs-4"><div class="img-upload-wrap">'
        newPic += '<input type="file" name="images[]" class="dropify" /></div></div>';

        var temp = $('#picture-files') 
        temp.append(newPic);

        temp = $('#picture-files').children().last();
        temp.find('input').dropify();
        temp.css({display: 'none'});
        temp.fadeIn();
    });

    // Change color of color section labels
    $('.color-value').on('change', function () {
        
        var color = $('.color-value').val();
        
        var li = $('li.select2-selection__choice').first();
        for (var i = 0; i < color.length; ++i) {
            li.css({background: color[i]});
            li = li.next();
        }
    });

	$('.color-value').on('itemAdded', function(event) {
        // Chagen the color of color picker label
        alert('asdf');
        // var label = $('.colorpicker').find('.label.label-info').last();
		// label.css({background: label.text()});
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
});