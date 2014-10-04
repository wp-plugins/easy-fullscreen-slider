jQuery('#upload_images').click(function(e){
    e.preventDefault();
    

    var efsuploader = wp.media({
        title: 'Sarven Fullscreen Slider - Upload Images',
        button: {
            text: 'Insert into gallery'
        },
        multiple: true
    })
    .on('select', function() {
        //jQuery('#images').empty();
        var selection = efsuploader.state().get('selection');
        var i = jQuery('.timg').length;
        selection.map( function( attachment ) {
            attachment = attachment.toJSON();
            jQuery('<div id="img'+i+'" class="timg"><img src=' +attachment.url+' alt=""><input type="hidden" name="efs-images[]" value="'+attachment.url+'" /><div id="'+i+'" class="dlink"></div></div>').appendTo("#images");
            i++;
        });
    })
    .open();
}); 
jQuery('#images').on('click', '.dlink', function(){
    jQuery('#img'+this.id).remove();
});
jQuery(function(){
    jQuery('#images').sortable({
            placeholder: 'ui-state-highlight'
        });
        jQuery('#images').disableSelection();
});