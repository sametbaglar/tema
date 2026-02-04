jQuery(function($){
    $('#filter').submit(function(){
        var filter = $('#filter');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(), 
            type:filter.attr('method'), 
            beforeSend:function(xhr){
                filter.find('button').html('<i class="fas fa-filter"></i> Getiriliyor...');},
            success:function(data){
    $('html, body').animate({
        scrollTop: $('.container').offset().top - 120
    }, 'slow');
if ( $(window).width() < 1000 ) {
$('form#filter').hide();
}
                filter.find('button').html('<i class="fas fa-filter"></i> Filmleri Getir');$('.container').html(data);
            }
        });
        return false;
    });
});