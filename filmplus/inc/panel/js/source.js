jQuery(document).ready(function() {
    jQuery("#kaynak_ekle").click(function() {
        jQuery(".kaynak_ekle").show();
		jQuery("#source-modal-backdrop").show();
    });
    jQuery(".kaynak_kapat").click(function() {
        jQuery(".kaynak_ekle").hide();
		jQuery("#source-modal-backdrop").hide();
    });
    jQuery("#ekle").click(function() {
        var empty_alert = "Hata Yok";
        var sname = jQuery("#source_name").val();
        var lang = jQuery("#languages option:selected").val();
        var qlts = jQuery("#qualities option:selected").val();
        var code = jQuery("#code").val();
        if (lang != "") {
            lang = "," + lang;
        }
        if (qlts != "") {
            qlts = "," + qlts;
        }
        if (sname != "" && lang != "" && qlts != "" && code != "") {
            if (jQuery('[name="checkbox"]').is(':checked')) {
                jQuery("#content").val(jQuery("#content").val() + "<!--baslik:" + sname + lang + qlts + "-->" + code);
            } else {
                jQuery("#content").val(jQuery("#content").val() + "\n<!--nextpage-->" + "<!--baslik:" + sname + lang + qlts + "-->" + code);
            }
        } else if (sname != "" && code != "" && lang != "") {
            if (jQuery('[name="checkbox"]').is(':checked')) {
                jQuery("#content").val(jQuery("#content").val() + "<!--baslik:" + sname + lang + "-->" + code);
            } else {
                jQuery("#content").val(jQuery("#content").val() + "\n<!--nextpage-->" + "<!--baslik:" + sname + lang + "-->" + code);
            }
        } else if (sname != "" && code != "" && qlts != "") {
            if (jQuery('[name="checkbox"]').is(':checked')) {
                jQuery("#content").val(jQuery("#content").val() + "<!--baslik:" + sname + ",undefined" + qlts + "-->" + code);
            } else {
                jQuery("#content").val(jQuery("#content").val() + "\n<!--nextpage-->" + "<!--baslik:" + sname + ",undefined" + qlts + "-->" + code);
            }
        } else if (sname != "" && code != "") {
            if (jQuery('[name="checkbox"]').is(':checked')) {
                jQuery("#content").val(jQuery("#content").val() + "<!--baslik:" + sname + "-->" + code);
            } else {
                jQuery("#content").val(jQuery("#content").val() + "\n<!--nextpage-->" + "<!--baslik:" + sname + "-->" + code);
            }
        } else {
            alert("Eksik kısımları tamamlayın.");
            empty_alert = "Hata Var";
        }
        if (empty_alert == "Hata Yok") {
            jQuery(".kaynak_ekle").hide();
			jQuery("#source-modal-backdrop").hide();
            jQuery("#source_name").val('');
            jQuery('#languages').prop('selectedIndex', 0);
            jQuery('#qualities').prop('selectedIndex', 0);
            jQuery("#code").val('');
            jQuery('[name="checkbox"]').prop('checked', false);
        }
    });
});