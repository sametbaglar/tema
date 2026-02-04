jQuery(document).ready(function($){
    $('#filmplus_seodescription').each(function(){
        var tId=$(this).attr("id");
        $(this).after('<span id="cnt'+tId+'"></span>');
        $(this).keyup(function () {
            var tId=$(this).attr("id");
            var tMax= 160;
            var left = tMax - $(this).val().length;
            $('#cnt'+tId).text(left + ' Karakter Kaldı');
        }).keyup();
    });
    $('#filmplus_seotitle').each(function(){
        var tId=$(this).attr("id");
        $(this).after('<span id="cnt'+tId+'"></span>');
        $(this).keyup(function () {
            var tId=$(this).attr("id");
            var tMax= 60;
            var left = tMax - $(this).val().length;
            $('#cnt'+tId).text(left + ' Karakter Kaldı');
        }).keyup();
    });    
     $("#cntfilmplus_seodescription").css({"float": "left", "font-weight": "bold", "margin-top": "10px"});
     $("#cntfilmplus_seotitle").css({"float": "left", "font-weight": "bold", "margin-top": "10px"});
});