<?php include_once('header.php'); ?>
<form action='' enctype='multipart/form-data'>
	<div id='general_settings' class='mainTab'>
		<div id='general'>
			<?php $this->select('tema_rengi', array(
				'mor' => 'Mor',
				'mavi' => 'Mavi',
				'dark' => 'Dark',
			),
			'Tema Rengi'); ?>
			<?php $this->upload('logo', 'Logo', 'Tavsiye edilen logo boyutu <code>170px x 58px</code>'); ?>
		    <?php $this->text('logo_title', 'Logo Yerine Title', 'Eğer logo yüklemezseniz varsayılan olarak bu kısım gözükür.'); ?>
			<?php $this->upload('favicon', 'Favicon', 'Tavsiye edilen favicon boyutu <code>16px x 16px</code>'); ?>
		    <?php $this->text('sayfa_basi', 'Gösterilecek Film Sayısı', 'Anasayfa ve film listeleme sayfalarında sayfa başı göstermek istediğiniz film sayısını giriniz.'); ?>
		    <?php $this->text('blur', 'Film Afiş Sansürle', 'Anasayfa ve film listeleme sayfalarında afişlerini sansürlemek istediğiniz kategorilerin ID lerini giriniz. ID leri virgül ile ayırmayı unutmayın.<br/><strong><span style="color:#DD4B39">Not:</span></strong> Seçtiğiniz kategoriye ait film afişleri bulanıklaştırılır ve üzerine "Resmi Aç" butonu eklenir.'); ?>
			<?php $this->checkbox('homepage_pagination', 'Anasayfada Sayfalamayı Etkinleştir', ''); ?>
		</div>
		<div id='analytics' style='display: none;'>
			<?php $this->textarea('analytics', 'Analytics Kodu', 'Google analytics veya kullandığınız diğer sayaç varsa kodunu buraya girebilirsiniz.'); ?>
		</div>
		<div id='single' style='display: none;'>
			<?php $this->checkbox('sidebar_show', 'Sidebarı Göster', 'Bu kısmı işaretlemezseniz film alanı tam boy gözükür.'); ?>
			<?php $this->checkbox('benzer_show', 'Benzer Filmleri Göster', ''); ?>
			<?php $this->checkbox('galeri_show', 'Film Galerisini Göster', ''); ?>
			<?php $this->text('benzer_count', 'Gösterilecek Benzer Film Sayısı', ''); ?>
		</div>
		<div id='slider' style='display: none;'>
			<?php $this->checkbox('slider', 'Anasayfa Slider Bölümünü Etkinleştir', ''); ?>
		    <?php $this->select('slider_gecis', array(
			'5000' => '5 Saniye',
			'10000' => '10 Saniye',
			'15000' => '15 Saniye',
		),
		'Diğer Filme Geçiş Süresi'); ?>
		    <?php $this->select('slider_tipi', array(
			'tip1' => 'Tekli',
			'tip2' => 'Çoklu',
		),
		'Slider Tipi','<span style="color:#DD4B39">Tekli:</span> Sayfa başı bir film görüntülenir ve filmler tüm detaylarıyla listelenir.(Özet, oyuncu, yönetmen vs.)<br/><span style="color:#DD4B39">Çoklu:</span> Filmler klasik listelemeyle çoklu olarak görüntülenir.'); ?>
			<?php $this->text('slider_id', 'Gösterilecek Filmler', 'Slider kısmında göstermek istediğiniz filmlerin idlerini giriniz. IDleri virgül ile ayırmayı unutmayın.'); ?>
        </div>
		<div id='footer' style='display: none;'>
			<?php $this->checkbox('sosyal', 'Sosyal Medya Bölümünü Etkinleştir', ''); ?>
			<?php $this->text('twitter_id', 'Twitter', 'Twitter sayfa adresinizi kutucuğa giriniz.'); ?>
			<?php $this->text('facebook_id', 'Facebook', 'Facebook sayfa adresinizi kutucuğa giriniz.'); ?>
			<?php $this->text('instagram_id', 'Instagram', 'Instagram sayfa adresinizi kutucuğa giriniz.'); ?>
            <?php $this->textarea('footer_left', 'Footer Yazı Sol', 'Footer sol bölüme eklemek istediğiniz linkleri veya yazıları bu bölüme girebilirsiniz.'); ?>
		</div>
		<div id='robot' style='display: none;'>
			<?php $this->text('site_key', 'Site Key', ''); ?>
			<?php $this->text('secret_key', 'Secret Key', ''); ?>
		</div>
	</div>
	<div id='tmdb_settings' style='display: none;' class='mainTab'>
		<div id='tmdb'>
            <?php $this->text('tmdb_id', 'TMDb Api Key', 'İçerik botunun çalışması için themoviedb.org adresine kaydolun ve aldığınız api anahtarını buraya girin.'); ?>
	</div>
		<div id='tmdbseo' style='display: none;'>
            <?php $this->text('tmdb_title', 'Genel Başlık Yapısı', 'Wordpressin klasik başlığı, yazı sayfasında ve film listeleme alanlarında gözükür. Başlık yapısını oluşturmak için aşağıdaki butonları kullanabilirsiniz.<br><button name="submit" type="button" id="btn1">Film Başlığı</button><button name="submit" type="button" id="btn2">Film Orijinal Başlığı</button><button name="submit" type="button" id="btn3">Yapım Yılı</button>'); ?>
            <?php $this->text('tmdb_seo_title', 'Seo Başlık Yapısı', 'Arama motorlarında gözüken başlık. Bu kısmı kullanmak için: <span style="color:#DD4B39">Seo Ayarları >> Yazı Ayarları >> SEO Özel Alanlarını Etkinleştir</span> aktif olmalıdır. Başlık yapısını oluşturmak için aşağıdaki butonları kullanabilirsiniz.<br><button name="submit" type="button" id="btn4">Film Başlığı</button><button name="submit" type="button" id="btn5">Film Orijinal Başlığı</button><button name="submit" type="button" id="btn6">Yapım Yılı</button>'); ?>
            <?php $this->text('tmdb_seo_desc', 'Seo Açıklama Yapısı', 'Arama motorlarında gözüken açıklama. Bu kısmı kullanmak için: <span style="color:#DD4B39">Seo Ayarları >> Yazı Ayarları >> SEO Özel Alanlarını Etkinleştir</span> aktif olmalıdır. Açıklama yapısını oluşturmak için aşağıdaki butonları kullanabilirsiniz.<br><button name="submit" type="button" id="btn7">Film Başlığı</button><button name="submit" type="button" id="btn8">Film Orijinal Başlığı</button><button name="submit" type="button" id="btn9">Yapım Yılı</button>'); ?>
            <?php $this->text('tmdb_seo_url', 'Url Yapısı', '<span style="color:#DD4B39">Önemli Not:</span> Bu kısma girilen bilgiler otomatik olarak url yapısına dönüştürülmektedir. Bu nedenle bu kısmı title alanı gibi kullanın. Url yapısını oluşturmak için aşağıdaki butonları kullanabilirsiniz.<br><button name="submit" type="button" id="btn10">Film Başlığı</button><button name="submit" type="button" id="btn11">Film Orijinal Başlığı</button><button name="submit" type="button" id="btn12">Yapım Yılı</button>'); ?>
	</div>
</div>
	<div id='seo_settings' style='display: none;' class='mainTab'>
		<div id='seohome'>
		<?php $this->checkbox('seo_home_title', 'Anasayfa Başlığını Etkinleştir',null); ?>
		<?php $this->textfield('seo_home_titletext', 'Anasayfa Başlığı', 'Bu bölüm ile anasayfanıza yeni bir başlık verebilirsiniz. Boş bırakırsanız wordpress kurulumu yaparken verdiğiniz başlık aktif olur.'); ?>
		<?php $this->textfield('seo_home_description', 'Anasayfa Açıklaması', 'Anasayfa için bir açıklama girebilirsiniz. Bu bölümü boş bırakırsanız wordpress tarafından otomatik belirlenmiş açıklamanız aktif hale gelir.'); ?>
		<?php $this->textfield('seo_home_keywords', 'Anasayfa Anahtar Kelimeleri', 'Anahtar kelimeleri girerken virgül ile ayırmayı unutmayın. Örneğin; <br /><code>filmplus, film izle, yabancı film izle</code>'); ?>
		<?php $this->select('seo_home_type', array(
			'blogisim' => 'Blog ismi | Blog açıklaması',
			'blogaciklama' => 'Blog açıklaması | Blog ismi',
			'sadeceblog' => 'Sadece Blog ismi',
		),
		'Başlık Kalıpları', 'Yukarıda anasayfa başlığı aktif halde değilse buradan bir kalıp aktif olacaktır. Size uygun olanı seçmelisiniz.'); ?>
		<?php $this->text('seo_home_separate', 'Ayırma İşareti', 'Ayırma işaretinin başına ve sonuna mutlaka <strong><span style="color:#DD4B39">boşluk</span></strong> bırakın. Varsayılan ayraç: <code> | </code>'); ?>
		</div>
		<div id='seosingle' style='display: none;'>
		<?php $this->checkbox('seo_field', 'SEO Özel Alanlarını Etkinleştir','Eğer bu kısmı işaratlerseniz yazı ekleme sayfasına <span style="color:#DD4B39">Seo Ayarları</span> paneli eklenir ve bu panelden filmlere arama motorlarını göstermek istediğiniz <span style="color:#DD4B39">Başlık, Açıklama ve Anahtar Kelimeleri</span> girebilirsiniz.'); ?>
		<?php $this->select('seo_single_type', array(
			'yazibaslik' => 'Yazı Başlığı | Blog ismi',
			'yaziblog' => 'Blog ismi | Yazı Başlığı',
			'sadeceyazi' => 'Sadece Yazı Başlığı',
		),
		'Başlık Kalıpları', null); ?>
		<?php $this->text('seo_single_separate', 'Ayırma İşareti', 'Ayırma işaretinin başına ve sonuna mutlaka <strong><span style="color:#DD4B39">boşluk</span></strong> bırakın. Varsayılan ayraç: <code> | </code>'); ?>
		</div>
		<div id='seokategori' style='display: none;'>
		<?php $this->checkbox('seo_index_description', 'Kategori Açıklamalarını Etkinleştir','Eğer bu kısmı işaretlerseniz kategori sayfasındaki <span style="color:#DD4B39">Tanım</span> kısmı açıklama olarak arama motorlarında gözükür.'); ?>
		<?php $this->select('seo_index_type', array(
			'kategoribaslik' => 'Kategori Başlığı | Blog ismi',
			'kategoriblog' => 'Blog ismi | Kategori Başlığı',
			'sadecekategori' => 'Sadece Kategori Başlığı',
		),
		'Başlık Kalıpları', null); ?>
		<?php $this->text('seo_index_separate', 'Ayırma İşareti', 'Ayırma işaretinin başına ve sonuna mutlaka <strong><span style="color:#DD4B39">boşluk</span></strong> bırakın. Varsayılan ayraç: <code> | </code>'); ?>
		<?php $this->text('seo_index_add_cat', 'Kategori başlıklarından sonra eklenecek kelime', 'Kelimenin başına boşluk koymayı unutmayın. Örnek: <strong><span style="color:#DD4B39"> Filmleri, Filmleri izle</span></strong>'); ?>
		</div>
		<div id='seotaxonomy' style='display: none;'>
		<?php $this->checkbox('seo_tax_description', 'Taxonomy Açıklamalarını Etkinleştir','Eğer bu kısmı işaretlerseniz taxonomy -Yapım Yılı, Ülke, Oyuncu, Yönetmen- sayfalarındaki <span style="color:#DD4B39">Tanım</span> kısmı açıklama olarak arama motorlarında gözükür.'); ?>
		<?php $this->select('seo_index_type_tax', array(
			'kategoribaslik' => 'Taxonomy Başlığı | Blog ismi',
			'kategoriblog' => 'Blog ismi | Taxonomy Başlığı',
			'sadecekategori' => 'Sadece Taxonomy Başlığı',
		),
		'Başlık Kalıpları', null); ?>
		<?php $this->text('seo_index_separate_tax', 'Ayırma İşareti', 'Ayırma işaretinin başına ve sonuna mutlaka <strong><span style="color:#DD4B39">boşluk</span></strong> bırakın. Varsayılan ayraç: <code> | </code>'); ?>
		<?php $this->text('seo_index_add_tax', 'Taxonomy başlıklarından sonra eklenecek kelime', 'Kelimenin başına boşluk koymayı unutmayın. Örnek: <strong><span style="color:#DD4B39"> Filmleri, Filmleri izle</span></strong>'); ?>
		</div>
		<div id='seogenel' style='display: none;'>
		<?php $this->checkbox('seo_facebook', 'Facebook Meta Bilgileri Etkinleştir',null); ?>
		<?php $this->checkbox('seo_canonical', 'Canonical (Standart Url) Etkinleştir',null); ?>
		</div>
	</div>
	<div id='appearence_settings' style='display: none;' class='mainTab'>
		<div id='reklam_a'>
		<?php $this->checkbox('r_a', 'Video Önü Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_a_a', 'Reklam Kodu','<span style="color:#DD4B39">NOT:</span> Eğer sesli reklam ekleyecekseniz, <span style="color:#DD4B39">Reklamı Geç</span> butonuna bastıktan veya süre reklam süresi tamamlandıktan sonra videonun durması için kodun içerisine <span style="color:#DD4B39">class="videoad"</span> etiketini ekleyin.'); ?>
		<?php $this->select('r_a_s', array(
			'5000' => '5 Saniye',
			'10000' => '10 Saniye',
			'15000' => '15 Saniye',
			'20000' => '20 Saniye',
			'25000' => '25 Saniye',
			'30000' => '30 Saniye',
			'60000' => '60 Saniye',
			'120000' => '120 Saniye',
		),
		'Gösterim Süresi'); ?>
		<?php $this->checkbox('r_a_g', 'Reklamı Geç Butonunu Etkinleştir',null); ?>
		</div>
		<div id='reklam_u' style='display: none;'>
		<?php $this->checkbox('r_u', 'Video Üstü Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_u_u', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_b' style='display: none;'>
		<?php $this->checkbox('r_b', 'Video Altı Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_b_b', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_c' style='display: none;'>
		<?php $this->checkbox('r_c', 'Sol Kayan Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_c_c', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_d' style='display: none;'>
		<?php $this->checkbox('r_d', 'Sağ Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_d_d', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_e' style='display: none;'>
		<?php $this->checkbox('r_e', 'Splash Reklam Alanını Etkinleştir',null); ?>
		<?php $this->select('r_e_s', array(
			'1' => 'Günde 1 Kez',
			'' => 'Sınır Yok',
		),
		'Gösterim Seçenekleri'); ?>
		<?php $this->checkbox('r_ee', 'Mobilde Gizle',null); ?>
		<?php $this->textarea('r_e_e', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_ps' style='display: none;'>
		<?php $this->checkbox('r_ps', 'Pageskin Reklam Alanını Etkinleştir',null); ?>
		<?php $this->text('r_ps_ps1', 'Arkaplan Resim Url',null); ?>
		<?php $this->text('r_ps_ps2', 'Açılacak Sayfa Url',null); ?>
		</div>
		<div id='reklam_h' style='display: none;'>
		<?php $this->checkbox('r_h', 'Header Reklam Alanını Etkinleştir',null); ?>
		<?php $this->textarea('r_h_h', 'Reklam Kodu',null); ?>
		</div>
		<div id='reklam_f' style='display: none;'>
		<?php $this->checkbox('r_f', 'Footer Kayan Reklam Alanını Etkinleştir',null); ?>
		<?php $this->text('r_f_f1', '728x90 Resim Url',null); ?>
		<?php $this->text('r_f_f2', 'Açılacak Sayfa Url',null); ?>
		<?php $this->textarea('r_f_f3', 'Veya Reklam Kodu',null); ?>
		</div>
	</div>
	<div class='reset_save'>
		<div class='bottom_button'>
			<img class='save_tip' style='display: none;' src='<?php bloginfo('template_directory'); ?>/inc/panel/images/save_tip.png' alt='' />
			<input type='submit' name='save_changes' value='' class='save_changes' />
		</div>
		<div style='clear: both;'></div>
	</div>
	<div style='clear: both;'></div>
</form>
<?php include_once('footer.php'); ?>