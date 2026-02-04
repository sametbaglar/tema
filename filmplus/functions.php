<?php
/*
 * @ Decoder version : 1.0.0.2
 * @ cracked by X 
 */

if (file_exists(TEMPLATEPATH . "/lisans.php")) {
    require "lisans.php";
    $lisans["hash"] = ("WarezM");
    if ($lisans["hash"] !== $lisans_anahtar) {
        exit("Lisans anahtarınız bu site için geçerli değildir.");
    }
    unset($lisans);
    include_once "inc/filmplus.php";
    include_once "inc/features.php";
    include_once "inc/language.php";
    include_once "inc/widgets.php";
    include_once "inc/install.php";
    add_action("init", "register_my_menus");
    function register_my_menus()
    {
        register_nav_menus(["header-nav" => __("FilmPlus Header Menüsü")]);
    }
    register_sidebar(["name" => "Sidebar (En Üst)", "id" => "sidebar-ust", "before_widget" => "<div class=\"listcontent\">", "after_widget" => "</div>", "before_title" => "<div class=\"title\"><span class=\"title-border bd-purple\">", "after_title" => "</span></div>"]);
    register_sidebar(["name" => "Sidebar (En Alt)", "id" => "sidebar-alt", "before_widget" => "<div class=\"listcontent\">", "after_widget" => "</div>", "before_title" => "<div class=\"title\"><span class=\"title-border bd-purple\">", "after_title" => "</span></div>"]);
    register_sidebar(["name" => "Anasayfa (Son Eklenenler Üstü)", "id" => "anasayfa-ust", "before_widget" => "<div class=\"incontent\">", "after_widget" => "</div>", "before_title" => "", "after_title" => ""]);
    register_sidebar(["name" => "Anasayfa (Son Eklenenler Altı)", "id" => "anasayfa-alt", "before_widget" => "<div class=\"incontent\">", "after_widget" => "</div>", "before_title" => "", "after_title" => ""]);
    function filmplus_meta($isim, $alan, $sonra)
    {
        global $post;
        $ozel = get_post_meta($post->ID, "" . $alan . "", true);
        if ($ozel != "") {
            echo "<p><span>" . $isim . "</span>: " . $ozel . "</p>";
        } else {
            echo "" . $sonra . "";
        }
    }
    function filmplus_zaman($type = "post")
    {
        $d = "comment" == $type ? "get_comment_time" : "get_post_time";
        return human_time_diff($d("U"), current_time("timestamp")) . " " . __("önce", "filmplus");
    }
    function filmplus_resim_bulucu()
    {
        global $post;
        global $posts;
        $first_img = "";
        ob_start();
        ob_end_clean();
        $output = preg_match_all("/<img.+src=['\"]([^'\"]+)['\"][^>]*>/i", $post->post_content, $matches);
        if (!empty($output)) {
            $first_img = $matches[1][0];
        }
        $adres = get_bloginfo("template_url");
        if (empty($first_img)) {
            $first_img = $adres . "/images/no-thumbnail.png";
        }
        return $first_img;
    }
    function bilgi_part($args = "")
    {
        global $post;
        $bilgi = get_post_meta($post->ID, "kalite", true);
        if ($bilgi != "") {
            echo "<span class=\"bolumkalite\">" . $bilgi . "</span>";
        } else {
            echo "<span class=\"bolumkalite\">720p</span>";
        }
    }
    function filmplus_part_sistemi($args = "", $bilgi = NULL)
    {
        $defaults = ["before" => "" . __("" . $bilgi . ""), "after" => "", "link_before" => "<span>", "link_after" => "</span>", "echo" => 1];
        $r = wp_parse_args($args, $defaults);
        extract($r, EXTR_SKIP);
        global $page;
        global $numpages;
        global $multipage;
        global $more;
        global $pagenow;
        global $pages;
        $bilgi_bir = get_option("filmplus_part_bir");
        $output = "";
        if ($multipage) {
            $output .= $before;
            $i = 1;
            while ($i < $numpages + 1) {
                $part_content = $pages[$i - 1];
                $has_part_title = strpos($part_content, "<!--baslik:");
                if (0 === $has_part_title) {
                    $end = strpos($part_content, "-->");
                    $title = trim(str_replace("<!--baslik:", "", substr($part_content, 0, $end)));
                }
                $output .= " ";
                if ($i != $page || !$more && $page == 1) {
                    $output .= _wp_link_page($i);
                }
                $title = isset($title) && 0 < strlen($title) ? $title : "" . $bilgi_bir . "";
                $output .= $link_before . $title . $link_after;
                if ($i != $page || !$more && $page == 1) {
                    $output .= "</a>";
                }
                $i = $i + 1;
            }
            $output .= $after;
        }
        if ($echo) {
            echo $output;
        }
        return $output;
    }
    function filmplus_facebook()
    {
        $fb_resim = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "single-resim");
        $fb_resmim = get_post_meta(get_the_ID(), "resim", true);
        if (is_single()) {
            if (has_post_thumbnail()) {
                echo "<meta property=\"og:image\" content=\"" . $fb_resim[0] . "\" />";
            } else {
                if ($fb_resmim != "") {
                    echo "<meta property=\"og:image\" content=\"" . $fb_resmim . "\" />";
                } else {
                    echo "<meta property=\"og:image\" content=\"" . filmplus_resim_bulucu() . "\" />";
                }
            }
            echo "<meta property=\"og:title\" content=\"";
            wp_title("|", true, "right");
            bloginfo("name");
            echo "\" />\n<meta property=\"og:site_name\" content=\"";
            bloginfo("name");
            echo "\" />\n<meta property=\"og:url\" content=\"";
            the_permalink();
            echo "\" />\n";
        }
    }
    if (!function_exists("PozHtml_73_Advenced")) {
        function PozHtml_73_Advenced()
        {
            echo "        <script type=\"text/javascript\">\n\t\tedButtons[edButtons.length]=new edButton(\"ed_pfilmplus\",\"NextPage\",\"<!--nextpage-->\");\n\t\tedButtons[edButtons.length]=new edButton(\"ed_qfilmplus\",\"NextPage Başlık\",\"<!--baslik:\",\"-->\",\"qfilmplus\");\n        </script>\n    ";
        }
        add_action("admin_print_footer_scripts", "PozHtml_73_Advenced");
    }
} else {
    exit("Lisans anahtarının bulunduğundan emin olun.");
}

?>