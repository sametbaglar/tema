<style>
div.spad-splash {
    position: fixed;
    z-index: 999900;
}
div.reklam-s-spad {
    top: 50%;
    left: 50%;
    margin-top: -150px;
    margin-left: -150px;
    width: 300px;
    height: 300px;
    background-color: #fff;
    border: 4px solid #333;
    border-radius: 4px;
}
@media only screen and (max-width: 1000px) {
    div.spad-splash {
        display: block;
    }
    div.reklam-s-spad iframe {
        width: 250px !important;
        height: 250px !important;
    }
    div.reklam-s-spad {
        width: 250px !important;
        height: 250px !important;
        margin-left: -125px !important;
        margin-top: -125px !important;
    }
}
</style>
<?php if(get_option('filmplus_r_ee') == 'On'): ?>
<style>@media only screen and (max-width: 1000px) {div.spad-splash{display:none !important}}</style>
<?php endif; ?>
<div class="spad-splash reklam-s-spad" id="amans">
	<?php echo get_option('filmplus_r_e_e'); ?>
	<a class="spclose" href="javascript:void(0)" style="position:absolute;top:-15px;right:-17px;display:block;width:29px;height:29px;background:transparent url(<?php echo get_template_directory_uri();?>/images/close-button.png) no-repeat top left;"></a>		
</div>
<script>
<?php if(!empty(get_option('filmplus_r_e_s'))):?>
function readCookie(cookieName) {
    var re = new RegExp('[; ]' + cookieName + '=([^\s;]*)');
    var sMatch = (' ' + document.cookie).match(re);
    if (cookieName && sMatch) return unescape(sMatch[1]);
    return '';
}
var kdukig = readCookie('splashno2');
if (kdukig != '') {
    document.getElementById('amans').style.display = 'none';
    $(document).ready(function() {
        $(".spad-splash").attr('style', 'display:none !important');
    });

} else {
    var isim = 'splashno2';
    var deger = 'kapali';
    var gunler = 2;
    if (gunler) {
        var date = new Date();
        date.setTime(date.getTime() + (gunler * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else var expires = "";
    document.cookie = isim + "=" + deger + expires + "; path=/";
}
<?php endif;?>
$(document).ready(function() {
    $(".spclose").click(function() {
        $(".spad-splash").attr('style', 'display:none !important');
    });
});
</script>