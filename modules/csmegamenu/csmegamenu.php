<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;
include_once(dirname(__FILE__).'/classes/CsMegaMenuClass.php');
include_once(dirname(__FILE__).'/classes/CsMegaMenuOptionClass.php');
class CsMegaMenu extends Module
{
	private $_html;
	private $temp_url = "{megamenu_url}";
	private $optionsMenu = array(
				array(
				'key'=> 0,
				'name' => 'Category'
				),
				array(
				'key'=> 1,
				'name' => 'Product'
				),
				array(
				'key'=> 2,
				'name' => 'Static Block'
				),
				array(
				'key'=> 3,
				'name' => 'Manufacture'
				),
				array(
				'key'=> 4,
				'name' => 'Infomation'
				)
			);
	private $user_groups;
	function __construct()
	{
		$this->name = 'csmegamenu';
	 	$this->tab = 'MyBlocks';
	 	$this->version = '1.0';
		$this->author = 'CodeSpot';
		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('CS Mega Menu block');
		$this->description = $this->l('Adds a mega menu block.');
	}
	
	public function init_data()
	{
	
		$id_en = Language::getIdByIso('en');
		$id_fr = Language::getIdByIso('fr');
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');;
		$option_1 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_2 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_3 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_4 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_5 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"1","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_6 = '{"opt_show_image_manu":"1","opt_image_size_manu":"manufacture_default","opt_show_name_manu":"0","opt_list_manu":["3","2","4","6","5","1"],"opt_fill_column":"1"}';
		$option_7 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_8 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_9 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_10 = '{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_11 =
		'{&quot;opt_content_static&quot;:{&quot;1&quot;:&quot;&lt;p&gt;Here is some contents with side image&lt;\\/p&gt;\\r\\n&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/11.jpg\\&quot; alt=\\&quot;\\&quot; width=\\&quot;287\\&quot; height=\\&quot;145\\&quot; \\/&gt;&lt;\\/p&gt;&quot;,&quot;2&quot;:&quot;&lt;p&gt;Here is some contents with side image&lt;\\/p&gt;\\r\\n&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/11.jpg\\&quot; alt=\\&quot;\\&quot; width=\\&quot;287\\&quot; height=\\&quot;145\\&quot; \\/&gt;&lt;\\/p&gt;&quot;},&quot;opt_fill_column&quot;:&quot;2&quot;}';
		$option_12 =
		'{&quot;opt_content_static&quot;:{&quot;1&quot;:&quot;&lt;p&gt;This is a blackbox, you can use it to highlight some&lt;\\/p&gt;\\r\\n&lt;p&gt;Pellentesque fermentum mi nunc justo feugiat non vehicula sit amet, dapibus sit amet ipsum.\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Nunc pharetra lorem eget sapien ornare id placerat massa lacinia. Nulla facilisi. Praesent nisi odio, posuere ac varius eu, pellentesque sit amet nisi. Morbi ullamcorper nulla id lorem rhoncus blandit. Nunc moles pretium pharetra. Suspendisse in elit dui, ac vehicula erat. Vivamus consequat risus ut dui feugiat eleifend.&lt;\\/p&gt;&quot;,&quot;2&quot;:&quot;&lt;p&gt;This is a blackbox, you can use it to highlight some&lt;\\/p&gt;\\r\\n&lt;p&gt;Pellentesque fermentum mi nunc justo feugiat non vehicula sit amet, dapibus sit amet ipsum.\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Nunc pharetra lorem eget sapien ornare id placerat massa lacinia. Nulla facilisi. Praesent nisi odio, posuere ac varius eu, pellentesque sit amet nisi. Morbi ullamcorper nulla id lorem rhoncus blandit. Nunc moles pretium pharetra. Suspendisse in elit dui, ac vehicula erat. Vivamus consequat risus ut dui feugiat eleifend.&lt;\\/p&gt;&quot;},&quot;opt_fill_column&quot;:&quot;2&quot;}';
		$option_13 =
		'{&quot;opt_content_static&quot;:{&quot;1&quot;:&quot;&lt;p&gt;\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Mauris tincidunts malesuada pellentesque fermentum mi felis nunc justo lacus feugiat non vehicula sit amet.\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Donec sollicitudin, lectus vel sodales consectetur, libernibh iaculis odio, ac eleifend odio mi id nisl. Etiam felis leo, vulputate in vestibulum varius, accumsan temp ligula. Suspendisse mauris nibh, mollis ac tempus sit amet, facilisis in nunc. Proin ac orci ipsum. Sed quis nibh iaculis odio, ac eleifend odio mi id nisl.&lt;\\/p&gt;&quot;,&quot;2&quot;:&quot;&lt;p&gt;\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Mauris tincidunts malesuada pellentesque fermentum mi felis nunc justo lacus feugiat non vehicula sit amet.\\u00a0&lt;\\/p&gt;\\r\\n&lt;p&gt;Donec sollicitudin, lectus vel sodales consectetur, libernibh iaculis odio, ac eleifend odio mi id nisl. Etiam felis leo, vulputate in vestibulum varius, accumsan temp ligula. Suspendisse mauris nibh, mollis ac tempus sit amet, facilisis in nunc. Proin ac orci ipsum. Sed quis nibh iaculis odio, ac eleifend odio mi id nisl.&lt;\\/p&gt;&quot;},&quot;opt_fill_column&quot;:&quot;2&quot;}';
		$option_14 =
		'{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate": "category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_15 =
		'{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate": "category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_16 =
		'{&quot;opt_content_static&quot;:{&quot;1&quot;:&quot;&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/canon.png\\&quot; alt=\\&quot;\\&quot; width=\\&quot;198\\&quot; height=\\&quot;42\\&quot; \\/&gt;&lt;\\/p&gt;\\r\\n&lt;p&gt;Donec sollicitudin, lectus vel sodales consectetur, libero nibh iaculis odio, ac eleifend odio mi id nisl. Etiam felis leo, vulputate in vestibulum varius, accumsan tempor ligula. Suspendisse mauris nibh, mollis ac tempus sit amet, facilisis in nunc. Proin ac orci ipsum. Sed quis vehicula est. Nunc congue nisi vitae mi placerat pharetra. posuere ac varius eu, pellentesque sit amet nisi.&lt;\\/p&gt;&quot;,&quot;2&quot;:&quot;&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/canon.png\\&quot; alt=\\&quot;\\&quot; width=\\&quot;198\\&quot; height=\\&quot;42\\&quot; \\/&gt;&lt;\\/p&gt;\\r\\n&lt;p&gt;Donec sollicitudin, lectus vel sodales consectetur, libero nibh iaculis odio, ac eleifend odio mi id nisl. Etiam felis leo, vulputate in vestibulum varius, accumsan tempor ligula. Suspendisse mauris nibh, mollis ac tempus sit amet, facilisis in nunc. Proin ac orci ipsum. Sed quis vehicula est. Nunc congue nisi vitae mi placerat pharetra. posuere ac varius eu, pellentesque sit amet nisi.&lt;\\/p&gt;&quot;},&quot;opt_fill_column&quot;:&quot;2&quot;}';
		$option_17 =
		'{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_18 =
		'{"opt_fill_column":"1","opt_show_parent_cat":"1","opt_show_image_cat":"0","opt_image_size_cate":"category_default","opt_show_sub_cat":"1","opt_show_image_sub_cat":"0","opt_id_parent_cat":"2"}';
		$option_19 =
		'{&quot;opt_content_static&quot;:{&quot;1&quot;:&quot;&lt;h5&gt;Placerat porta&lt;\\/h5&gt;\\r\\n&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/office-stationery.jpg\\&quot; alt=\\&quot;\\&quot; width=\\&quot;260\\&quot; height=\\&quot;200\\&quot; \\/&gt;&lt;\\/p&gt;\\r\\n&lt;p&gt;Nunc pharetra lorem eget sapien ornare id placerat massa lacinia. Nulla facilisi. Praesent nisi odio, posuer ac varius eu, pellentesque sit amet nisi. Morbi ullamcorper nulla id lorem rhoncus blandit. Nunc ac varius eu, pellentesque sit amet nisi.&lt;\\/p&gt;&quot;,&quot;2&quot;:&quot;&lt;h5&gt;Placerat porta&lt;\\/h5&gt;\\r\\n&lt;p&gt;&lt;img src=\\&quot;{megamenu_url}themes\\/electronues\\/img\\/cms\\/office-stationery.jpg\\&quot; alt=\\&quot;\\&quot; width=\\&quot;260\\&quot; height=\\&quot;200\\&quot; \\/&gt;&lt;\\/p&gt;\\r\\n&lt;p&gt;Nunc pharetra lorem eget sapien ornare id placerat massa lacinia. Nulla facilisi. Praesent nisi odio, posuer ac varius eu, pellentesque sit amet nisi. Morbi ullamcorper nulla id lorem rhoncus blandit. Nunc ac varius eu, pellentesque sit amet nisi.&lt;\\/p&gt;&quot;},&quot;opt_fill_column&quot;:&quot;2&quot;}';
		$option_20 =
		'{"opt_show_image_product":"1","opt_image_size_product":"medium_default","input_hidden_id":"1-2-","input_hidden_name":"Barcelona Bamboo Platform Bed\\u00a4Coalesce: Functioning On Impatience T-Shirt\\u00a4","opt_fill_column":"1"}';
		$option_21 =
		'{"opt_show_image_product":"1","opt_image_size_product":"medium_default","input_hidden_id":"3-4-","input_hidden_name":"Coalesce: Functioning On Impatience T-Shirt\\u00a4Barcelona Bamboo Platform Bed\\u00a4","opt_fill_column":"1"}';
		$option_22 =
		'{"opt_show_image_product":"1","opt_image_size_product":"medium_default","input_hidden_id":"1-2-","input_hidden_name":"Coalesce: Functioning On Impatience T-Shirt\\u00a4Coalesce: Functioning On Impatience T-Shirt\\u00a4","opt_fill_column":"1"}';
		$option_23 =
		'{"opt_show_image_product":"1","opt_image_size_product":"medium_default","input_hidden_id":"2-3-","input_hidden_name":"Barcelona Bamboo Platform Bed\\u00a4Barcelona Bamboo Platform Bed\\u00a4","opt_fill_column":"1"}';
		
		//insert db table csmegamenu
		if(!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'csmegamenu` (`id_csmegamenu`, `number_column`, `width`, `icon`, `display`, `display_icon`, `classes`, `position`) VALUES 
		(1, 2, 380,"icon_1.png", 1, 1, "", 1),
		(2, 0, 200,"icon_2.png", 1, 1, "", 2),
		(3, 0, 234,"icon_3.png", 1, 1, "", 3),
		(4, 6, 900,"icon_4.png", 1, 1, "setminheight", 4),
		(5, 6, 900,"icon_5.png", 1, 1, "", 5),
		(6, 2, 600,"icon_6.png", 1, 1, "product_list", 6),
		(7, 2, 400,"icon_7.png", 1, 1, "product_grid", 7),
		(8, 0, 0,"icon_8.png", 1, 1, "", 8),
		(9, 0, 0,"icon_9.png", 1, 1, "", 0),
		(10, 0, 0,"icon_10.png", 1, 1, "", 0),
		(11, 0, 0,"icon_11.png", 1, 1, "", 0),
		(12, 0, 0,"icon_12.png", 1, 1, "", 0),
		(13, 0, 0,"icon_13.png", 1, 1, "", 0),
		(14, 0, 0,"icon_14.png", 1, 1, "", 14),
		(15, 0, 0,"icon_15.png", 1, 1, "", 0),
		(16, 0, 0,"icon_16.png", 1, 1, "", 0),
		(17, 0, 0,"icon_17.png", 1, 1, "", 17);'	
		) OR
		//insert db table csmegamenu_shop
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'csmegamenu_shop` (`id_csmegamenu`, `id_shop`, `number_column`, `width`, `display`, `position`) VALUES		
		(1, "'.$id_shop.'", 2, 380, 1, 1),
		(2, "'.$id_shop.'", 0, 200, 1, 2),
		(3, "'.$id_shop.'", 0, 234, 1, 3),
		(4, "'.$id_shop.'", 6, 900, 1, 4),
		(5, "'.$id_shop.'", 6, 900,1, 5),
		(6, "'.$id_shop.'", 2, 600,1, 6),
		(7, "'.$id_shop.'", 2, 400,1, 7),
		(8, "'.$id_shop.'", 0, 0,1, 8),
		(9, "'.$id_shop.'", 0, 0,1, 9),
		(10, "'.$id_shop.'", 0, 0,1, 10),
		(11, "'.$id_shop.'", 0, 0,1, 11),
		(12, "'.$id_shop.'", 0, 0,1, 12),
		(13, "'.$id_shop.'", 0, 0,1, 13),
		(14, "'.$id_shop.'", 0, 0,1, 14),
		(15, "'.$id_shop.'", 0, 0,1, 15),
		(16, "'.$id_shop.'", 0, 0,1, 16),
		(17, "'.$id_shop.'", 0, 0, 1, 17)
		;'
		) OR
		//insert db table csmegamenu_lang
		!Db::getInstance()->Execute("INSERT INTO `"._DB_PREFIX_."csmegamenu_lang` (`id_csmegamenu`, `id_lang`, `id_shop`, `title`,`link_of_title`,`description`) VALUES 
			(1, '".$id_en."', '".$id_shop."', 'Clothing','index.php?id_category=3&controller=category', ''),
			(1, '".$id_fr."', '".$id_shop."', 'Colthing','index.php?id_category=3&controller=category', ''),
			(2, '".$id_en."', '".$id_shop."', 'Footwear','index.php?id_category=3&controller=category', ''),
			(2, '".$id_fr."', '".$id_shop."', 'Footwear','index.php?id_category=3&controller=category', ''),
			(3, '".$id_en."', '".$id_shop."', 'Mobiles &  Accessories','index.php?id_category=3&controller=category', ''),
			(3, '".$id_fr."', '".$id_shop."', 'Mobiles &amp;  Accessories','index.php?id_category=3&controller=category',  ''),
			(4, '".$id_en."', '".$id_shop."', 'Computers','index.php?id_category=3&controller=category',  ''),
			(4, '".$id_fr."', '".$id_shop."', 'Computers','index.php?id_category=3&controller=category',  ''),
			(5, '".$id_en."', '".$id_shop."', 'Watches, Bags &  Wallets','index.php?id_category=3&controller=category',  ''),
			(5, '".$id_fr."', '".$id_shop."', 'Watches, Bags &amp;  Wallets','index.php?id_category=3&controller=category', ''),
			(6, '".$id_en."', '".$id_shop."', 'Cameras','index.php?id_category=3&controller=category', ''),
			(6, '".$id_fr."', '".$id_shop."', 'Cameras','index.php?id_category=3&controller=category',  ''),
			(7, '".$id_en."', '".$id_shop."', 'Books, Pen &  Stationery','index.php?id_category=3&controller=category',  ''),
			(7, '".$id_fr."', '".$id_shop."', 'Books, Pen &amp;  Stationery','index.php?id_category=3&controller=category',  ''),
			(8, '".$id_en."', '".$id_shop."', 'Home &  Kitchen','index.php?id_category=3&controller=category',  ''),
			(8, '".$id_fr."', '".$id_shop."', 'Home &amp;  Kitchen','index.php?id_category=3&controller=category',  ''),
			(9, '".$id_en."', '".$id_shop."', 'Beauty & Personal Care','index.php?id_category=3&controller=category',  ''),
			(9, '".$id_fr."', '".$id_shop."', 'Beauty & Personal Care','index.php?id_category=3&controller=category',  ''),
			(10, '".$id_en."', '".$id_shop."', 'Gaming','index.php?id_category=3&controller=category',  ''),
			(10, '".$id_fr."', '".$id_shop."', 'Gaming','index.php?id_category=3&controller=category',  ''),
			(11, '".$id_en."', '".$id_shop."', 'TV, Video & Audio','index.php?id_category=3&controller=category',  ''),
			(11, '".$id_fr."', '".$id_shop."', 'TV, Video & Audio','index.php?id_category=3&controller=category',  ''),
			(12, '".$id_en."', '".$id_shop."', 'Music, Movies & Poster','index.php?id_category=3&controller=category',  ''),
			(12, '".$id_fr."', '".$id_shop."', 'Music, Movies & Poster','index.php?id_category=3&controller=category',  ''),
			(13, '".$id_en."', '".$id_shop."', 'Baby Care & Toys','index.php?id_category=3&controller=category',  ''),
			(13, '".$id_fr."', '".$id_shop."', 'Baby Care & Toys','index.php?id_category=3&controller=category',  ''),
			(14, '".$id_en."', '".$id_shop."', 'Sports & Fitness','index.php?id_category=3&controller=category',  ''),
			(14, '".$id_fr."', '".$id_shop."', 'Sports & Fitness','index.php?id_category=3&controller=category',  ''),
			(15, '".$id_en."', '".$id_shop."', 'eBooks (Beta)','index.php?id_category=3&controller=category',  ''),
			(15, '".$id_fr."', '".$id_shop."', 'eBooks (Beta)','index.php?id_category=3&controller=category',  ''),
			(16, '".$id_en."', '".$id_shop."', 'MP3 Downloads','index.php?id_category=3&controller=category',  ''),
			(16, '".$id_fr."', '".$id_shop."', 'MP3 Downloads','index.php?id_category=3&controller=category',  ''),
			(17, '".$id_en."', '".$id_shop."', 'Our Blog','index.php?fc=module&module=csblog&controller=categoryPost',  ''),
			(17, '".$id_fr."', '".$id_shop."', 'Our Blog','index.php?fc=module&module=csblog&controller=categoryPost',  '');
			;"		
		) OR
		//insert db table csmegamenu_option
		!Db::getInstance()->Execute("INSERT INTO `"._DB_PREFIX_."csmegamenu_option` (`id_option`, `id_csmegamenu`, `type_option`, `position_option`, `content_option`) 
		VALUES 
			(1, 1, 0, 0, '".$option_1."'),
			(2, 1, 0, 13, '".$option_2."'),
			(3, 1, 0, 14, '".$option_3."'),
			(4, 1, 0, 16, '".$option_4."'),
			(5, 2, 0, 10, '".$option_5."'),
			(6, 3, 3, 1, '".$option_6."'),
			(7, 4, 0, 4, '".$option_7."'),
			(8, 4, 0, 11, '".$option_8."'),
			(9, 4, 0, 15, '".$option_9."'),
			(10, 4, 0, 17, '".$option_10."'),
			(11, 4, 2, 20, '".pSQL($option_11)."'),
			(12, 4, 2, 22, '".pSQL($option_12)."'),
			(13, 4, 2, 21, '".pSQL($option_13)."'),
			(14, 4, 0, 18, '".$option_14."'),
			(15, 4, 0, 19, '".$option_15."'),
			(16, 5, 2, 1, '".pSQL($option_16)."'),
			(17, 5, 0, 6, '".$option_17."'),
			(18, 5, 0, 9, '".$option_18."'),
			(19, 5, 2, 12, '".pSQL($option_19)."'),
			(20, 6, 1, 1, '".$option_20."'),
			(21, 6, 1, 5, '".$option_21."'),
			(22, 7, 1, 1, '".$option_22."'),
			(23, 7, 1, 2, '".$option_23."')
			;
			"
		) OR
		//insert db table csmegamenu_option_shop
		!Db::getInstance()->Execute("INSERT INTO `"._DB_PREFIX_."csmegamenu_option_shop` (`id_option`, `id_csmegamenu`, `id_shop`, `type_option`, `position_option`, `content_option`)
			VALUES 
			(1, 1, '".$id_shop."', 0, 0, '".$option_1."'),
			(2, 1, '".$id_shop."', 0, 13, '".$option_2."'),
			(3, 1, '".$id_shop."', 0, 14, '".$option_3."'),
			(4, 1, '".$id_shop."', 0, 16, '".$option_4."'),
			(5, 2, '".$id_shop."', 0, 10, '".$option_5."'),
			(6, 3, '".$id_shop."', 3, 8, '".$option_6."'),
			(7, 4, '".$id_shop."', 0, 4, '".$option_7."'),
			(8, 4, '".$id_shop."', 0, 11, '".$option_8."'),
			(9, 4, '".$id_shop."', 0, 15, '".$option_9."'),
			(10, 4, '".$id_shop."', 0, 17, '".$option_10."'),
			(11, 4, '".$id_shop."', 2, 20, '".pSQL($option_11)."'),
			(12, 4, '".$id_shop."', 2, 22, '".pSQL($option_12)."'),
			(13, 4, '".$id_shop."', 2, 21, '".pSQL($option_13)."'),
			(14, 4, '".$id_shop."', 0, 18, '".$option_14."'),
			(15, 4, '".$id_shop."', 0, 19, '".$option_15."'),
			(16, 5, '".$id_shop."', 2, 3, '".pSQL($option_16)."'),
			(17, 5, '".$id_shop."', 0, 6, '".$option_17."'),
			(18, 5, '".$id_shop."', 0, 9, '".$option_18."'),
			(19, 5, '".$id_shop."', 2, 12, '".pSQL($option_19)."'),
			(20, 6, '".$id_shop."', 1, 2, '".$option_20."'),
			(21, 6, '".$id_shop."', 1, 5, '".$option_21."'),
			(22, 7, '".$id_shop."', 1, 1, '".$option_22."'),
			(23, 7, '".$id_shop."', 1, 7, '".$option_23."')
			;	
			")
		)
			return false;
		return true;
	}
	
	function install()
	{
		if (!parent::install() || !$this->registerHook('header')|| !$this->registerHook('csmegamenu') ||
			!$this->registerHook('homeleft') ||
			!$this->registerHook('actionObjectCategoryUpdateAfter') ||
			!$this->registerHook('actionObjectCategoryDeleteAfter') ||
			!$this->registerHook('actionObjectCmsUpdateAfter') ||
			!$this->registerHook('actionObjectCmsDeleteAfter') ||
			!$this->registerHook('actionObjectManufacturerUpdateAfter') ||
			!$this->registerHook('actionObjectManufacturerDeleteAfter') ||
			!$this->registerHook('actionObjectProductUpdateAfter') ||
			!$this->registerHook('actionObjectProductDeleteAfter') ||
			!$this->registerHook('categoryUpdate') ||
			!$this->registerHook('actionUpdateQuantity') ||
			!$this->registerHook('actionShopDataDuplication')
			)
			return false;
		
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'csmegamenu (`id_csmegamenu` int(10) unsigned NOT NULL AUTO_INCREMENT,`number_column` int(10) unsigned default \'1\', `width` int(10) unsigned default \'120\', `icon` varchar(255) default \'\', `display` tinyint(1) NOT NULL default \'1\',`display_icon` tinyint(1) NOT NULL default \'1\',`classes` varchar(150),`position` int(10) unsigned default \'0\',PRIMARY KEY (`id_csmegamenu`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'csmegamenu_shop (`id_csmegamenu` int(10) unsigned NOT NULL ,`id_shop` int(10) unsigned NOT NULL,`number_column` int(10) unsigned default \'1\', `width` int(10) unsigned default \'120\', `display` tinyint(1) NOT NULL default \'1\',`position` int(10) unsigned default \'0\',PRIMARY KEY (`id_csmegamenu`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'csmegamenu_option (`id_option` int(10) unsigned NOT NULL AUTO_INCREMENT,`id_csmegamenu` int(10) unsigned NOT NULL,`type_option` int(10) unsigned NOT NULL, `position_option` int(10) unsigned default \'0\', `content_option` text ,PRIMARY KEY (`id_option`)) ENGINE=InnoDB default CHARSET=utf8'))
			return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'csmegamenu_option_shop (`id_option` int(10) unsigned NOT NULL,`id_csmegamenu` int(10) unsigned NOT NULL,`id_shop` int(10) unsigned NOT NULL,`type_option` int(10) unsigned NOT NULL, `position_option` int(10) unsigned default \'0\', `content_option` text ,PRIMARY KEY (`id_option`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
			return false;
		if (!Db::getInstance()->Execute('CREATE TABLE '._DB_PREFIX_.'csmegamenu_lang (`id_csmegamenu` int(10) unsigned NOT NULL, `id_lang` int(10) unsigned NOT NULL,`id_shop` int(10) unsigned NOT NULL, `title` varchar(255) NOT NULL default \'\', `link_of_title` varchar(1000),`description` varchar(255) default \'\', PRIMARY KEY (`id_csmegamenu`,`id_lang`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8'))
	 		return false;
		$this->init_data();
		return true;
	}
	
	public function uninstall()
	{
	 	if (parent::uninstall() == false)
	 		return false; 	
		if (!Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csmegamenu') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csmegamenu_shop') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csmegamenu_option') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csmegamenu_option_shop') OR !Db::getInstance()->Execute('DROP TABLE '._DB_PREFIX_.'csmegamenu_lang'))
	 		return false;
		$this->_clearCache('csmegamenu.tpl');
	 	return true;
	}
	
	private function _displayHelp() //not write
	{
	}
	//cms
	private function displayRecurseCheckboxes($categories, $selected, $has_suite = array())
	{
		static $irow = 0;	
		$html = '
			<tr '.($irow++ % 2 ? 'class="alt_row"' : '').'>
				<td width="3%"><input type="checkbox" name="content_option[4][footerBox][]" class="cmsBox" id="1_'.$categories['id_cms_category'].'" value="1_'.$categories['id_cms_category'].'" '.
				(in_array('1_'.$categories['id_cms_category'], $selected) ? ' checked="checked"' : '').' /></td>
				<td width="3%">'.$categories['id_cms_category'].'</td>
				<td width="94%">';
		for ($i = 1; $i < $categories['level_depth']; $i++)
		if(isset($has_suite[$i - 1]))
			$html .=	'<img style="vertical-align:middle;" src="../img/admin/lvl_'.$has_suite[$i - 1].'.gif" alt="" />';
		$html .= '<img style="vertical-align:middle;" src="../img/admin/'.($categories['level_depth'] == 0 ? 'lv1' : 'lv2_');
		if(isset($has_suite[$categories['level_depth'] - 1]))
			$html .= 'b.gif" alt="" /> &nbsp;';
		else
			$html .= 'f.gif" alt="" /> &nbsp;';
			$html .= '<label for="1_'.$categories['id_cms_category'].'" class="t"><b>'.$categories['name'].'</b></label></td>
			</tr>';
		if (isset($categories['children']))
			foreach ($categories['children'] as $key => $category)
			{
				$has_suite[$categories['level_depth']] = 1;
				if (sizeof($categories['children']) == $key + 1 AND !sizeof($categories['cms']))
					$has_suite[$categories['level_depth']] = 0;
				$html .= $this->displayRecurseCheckboxes($category, $selected, $has_suite, 0);
			}
		
		$cpt = 0;
		foreach ($categories['cms'] as $cms)
		{
			$html .= '
				<tr '.($irow++ % 2 ? 'class="alt_row"' : '').'>
					<td width="3%"><input type="checkbox" name="content_option[4][footerBox][]" class="cmsBox" id="0_'.$cms['id_cms'].'" value="0_'.$cms['id_cms'].'" '.
					(in_array('0_'.$cms['id_cms'], $selected) ? ' checked="checked"' : '').' /></td>
					<td width="3%">'.$cms['id_cms'].'</td>
					<td width="94%">';
			for ($i = 0; $i < $categories['level_depth']; $i++)
			if(isset($has_suite[$i]))
				$html .=	'<img style="vertical-align:middle;" src="../img/admin/lvl_'.$has_suite[$i].'.gif" alt="" />';
			$html .= '<img style="vertical-align:middle;" src="../img/admin/lv2_'.(++$cpt == sizeof($categories['cms']) ? 'f' : 'b').'.gif" alt="" /> &nbsp;
			<label for="0_'.$cms['id_cms'].'" class="t" style="margin-top:6px;">'.$cms['meta_title'].'</label></td>
				</tr>';
		}
		return $html;
	}
	private function _displayFormCMS($array_check)
	{
		global $currentIndex;
		$id_lang=$this->context->language->id;
		$html ='<div class="margin-form"><table cellspacing="0" cellpadding="0" class="table" width="100%">
				<tr>
					<th width="3%"><input type="checkbox" name="content_option[4][checkme_cms]" class="noborder" onclick="checkallCMSBoxes($(this).attr(\'checked\'))"/></th>
					<th width="3%">'.$this->l('ID').'</th>
					<th width="94%">'.$this->l('Name').'</th>
				</tr>';
				$html .= $this->displayRecurseCheckboxes(CMSCategory::getRecurseCategory($id_lang),$array_check);
		$html .= '</table></div>';
		return $html;
	}
	//cms
	private function initFormOption()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$menus = $this->getMenus();
		$imageCateTypes = ImageType ::getImagesTypes('categories');
		$imageProTypes = ImageType ::getImagesTypes('products');
		$imageManTypes = ImageType ::getImagesTypes('manufacturers');
		$helper = new HelperForm();
		$id_option = Tools::getValue('id_option');
		if (Tools::isSubmit('id_option') && $id_option)
		{
			//die('fas');
			$option = new CsMegaMenuOptionClass($id_option);
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_option111');
			$helper->fields_value['id_option'] = (int)Tools::getValue('id_option', $option->id_option);
		}
		else 
			$option = new CsMegaMenuOptionClass();
			
		if($option->type_option == 2) //check option static block
			$option->content_option =json_decode(htmlspecialchars_decode(($option->content_option)));
		else
			$option->content_option =json_decode($option->content_option);	

		if(isset($option->content_option->footerBox))
			$arr_checked_cms_update = $option->content_option->footerBox;
		else
			$arr_checked_cms_update = array();
			
		$manu_check = isset($option->content_option->opt_list_manu) ? $option->content_option->opt_list_manu : null;
		
		$manu_list = $this->displayManufactureList($manu_check);
		
		$cms_list = $this->_displayFormCMS($arr_checked_cms_update);

		if(isset($option->content_option->opt_id_parent_cat))
			$selected_categories = array($option->content_option->opt_id_parent_cat);
		else
			$selected_categories = array();
		$this->fields_form[0]['form'] = array(
					'tinymce' => true,
					'legend' => array(
					'title' => $this->l('Option item'),
			),
			'input' => array(
				array(
					'type' => 'select',
					'label' => $this->l('Add for menu'),
					'name' => 'id_csmegamenu',
					'options' => array(
						'query' => $menus,
						'id' => 'id_csmegamenu',
						'name' => 'title'
					)
				),
				array(
					'type' => 'select',
					'label' => $this->l('Option type'),
					'name' => 'type_option',
					'class' => 'select_type_option',
					'options' => array(
						'query' => $this->optionsMenu,
						'id' => 'key',
						'name' => 'name'
					)
				),
				array(
					'type' => 'text',
					'label' => $this->l('Fill the column'),
					'name' => 'content_option[0][opt_fill_column]',
					'class' => 'cs_option_cate',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Show name parent category'),
						'name' => 'content_option[0][opt_show_parent_cat]',
						'class' => 'cs_option_cate',
						'values' => array(
									array(
										'id' => 'opt_show_parent_cat_on',
										'value' => 1,
										'label' => $this->l('Enable')
									),
									array(
										'id' => 'opt_show_parent_cat_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			    ),
				array(
						'type' => 'switch',
						'label' => $this->l('Show image parent category'),
						'name' => 'content_option[0][opt_show_image_cat]',
						'values' => array(
									array(
										'id' => 'opt_show_image_cat_on',
										'value' => 1,
										'label' => $this->l('Enable')
									),
									array(
										'id' => 'opt_show_image_cat_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			    ),
				array(
					'type' => 'select',
					'label' => $this->l('Size image (W x H)'),
					'name' => 'content_option[0][opt_image_size_cate]',
					'options' => array(
						'query' => $imageCateTypes,
						'id' => 'name',
						'name' => 'name'
					)
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Show name sub category'),
						'name' => 'content_option[0][opt_show_sub_cat]',
						'values' => array(
									array(
										'id' => 'opt_show_sub_cat_on',
										'value' => 1,
										'label' => $this->l('Enable')
									),
									array(
										'id' => 'opt_show_sub_cat_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			    ),
				array(
						'type' => 'switch',
						'label' => $this->l('Show image sub category'),
						'name' => 'content_option[0][opt_show_image_sub_cat]',
						'values' => array(
							array(
								'id' => 'opt_show_image_sub_cat_on',
								'value' => 1,
								'label' => $this->l('Enable')
							),
							array(
								'id' => 'opt_show_image_sub_cat_off',
								'value' => 0,
								'label' => $this->l('Disabled')
							)
						),
			    ),
				array(
					'type'  => 'categories',
					'label' => $this->l('Parent category:'),
					'name'  => 'content_option[0][opt_id_parent_cat]',
					'tree'  => array(
						'id'      => 'categories-tree',
						'selected_categories' => $selected_categories,
						'disabled_categories' => null
					)
				),
				array( //option product
					'type' => 'switch',
					'label' => $this->l('Show image'),
					'name' => 'content_option[1][opt_show_image_product]',
					'values' => array(
						array(
							'id' => 'opt_show_image_product_on',
							'value' => 1,
							'label' => $this->l('Enable')
						),
						array(
							'id' => 'opt_show_image_product_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					),
			    ),
				array(
					'type' => 'select',
					'label' => $this->l('Size image (W x H)'),
					'name' => 'content_option[1][opt_image_size_product]',
					'options' => array(
						'query' => $imageProTypes,
						'id' => 'name',
						'name' => 'name'
					)
				),
				array(
					'type' => 'product_fill',
					'label' => $this->l('Choose product'),
					'html' => $this->displayProducFill($option),
					'name' => 'product_fill',
					'cols' => 40,
					'rows' => 10
					
				),
				array( //static block
					'type' => 'textarea',
					'label' => $this->l('Content:'),
					'name' => 'opt_content_static',
					'autoload_rte' => true,
					'lang' => true,
					'cols' => 60,
					'rows' => 30
				),
				array( //option manufacture
					'type' => 'switch',
					'label' => $this->l('Show image'),
					'name' => 'content_option[3][opt_show_image_manu]',
					'values' => array(
						array(
							'id' => 'opt_show_image_manu_on',
							'value' => 1,
							'label' => $this->l('Enable')
						),
						array(
							'id' => 'opt_show_image_manu_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					),
			    ),
				array(
					'type' => 'select',
					'label' => $this->l('Size image (W x H)'),
					'name' => 'content_option[3][opt_image_size_manu]',
					'options' => array(
						'query' => $imageManTypes,
						'id' => 'name',
						'name' => 'name'
					)
				),
				array(
					'type' => 'switch',
					'label' => $this->l('Show name'),
					'name' => 'content_option[3][opt_show_name_manu]',
					'values' => array(
						array(
							'id' => 'opt_show_name_manu_on',
							'value' => 1,
							'label' => $this->l('Enable')
						),
						array(
							'id' => 'opt_show_name_manu_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					),
			    ),
				array(
					'type' => 'manu_list',
					'label' => $this->l('Choose manufacturers:'),
					'manu_list' => $manu_list,
					'name' => 'manu_list'
				),
				array( //infomation cms
					'type' => 'cms_list',
					'label' => $this->l('Choose infomation:'),
					'name' => 'content_option[4][footerBox][]',
					'cms_list' => $cms_list
				),
				
			),
			'submit' => array(
				'title' => $this->l('Save'),
			)
		);
		
		$helper->module = $this;
		$helper->name_controller = 'csmegamenu';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveSubmitOptionMenu';
		$helper->base_tpl = 'formOption.tpl';
		
		//get value all both
		if (Tools::isSubmit('id_option') && $id_option)
		{
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_option');
			$helper->fields_value['id_option'] = Tools::getValue('id_option', $option->id_option);
		}
		$helper->fields_value['id_csmegamenu'] = Tools::getValue('id_csmegamenu', $option->id_csmegamenu);
		
		$helper->fields_value['type_option'] = Tools::getValue('type_option', $option->type_option);
		
		$opt_fill_column = isset($option->content_option->opt_fill_column) ? $option->content_option->opt_fill_column : null;
		
		$helper->fields_value['content_option[0][opt_fill_column]'] = Tools::getValue('content_option[0][opt_fill_column]', $opt_fill_column);
		
		//get value file option category
		$opt_show_parent_cat = isset($option->content_option->opt_show_parent_cat) ? $option->content_option->opt_show_parent_cat : null;
		
		$helper->fields_value['content_option[0][opt_show_parent_cat]'] = Tools::getValue('content_option[0][opt_show_parent_cat]', $opt_show_parent_cat);
		
		$opt_show_image_cat = isset($option->content_option->opt_show_image_cat) ? $option->content_option->opt_show_image_cat : null;
		
		$helper->fields_value['content_option[0][opt_show_image_cat]'] = Tools::getValue('content_option[0][opt_show_image_cat]', $opt_show_image_cat);
		
		$opt_image_size_cate = isset($option->content_option->opt_image_size_cate) ? $option->content_option->opt_image_size_cate : null;
		
		$helper->fields_value['content_option[0][opt_image_size_cate]'] = Tools::getValue('content_option[0][opt_image_size_cate]', $opt_image_size_cate);
		
		$opt_show_sub_cat = isset($option->content_option->opt_show_sub_cat) ? $option->content_option->opt_show_sub_cat : null;
		
		$helper->fields_value['content_option[0][opt_show_sub_cat]'] = Tools::getValue('content_option[0][opt_show_sub_cat]', $opt_show_sub_cat);
		
		$opt_show_image_sub_cat = isset($option->content_option->opt_show_image_sub_cat) ? $option->content_option->opt_show_image_sub_cat : null;
		
		$helper->fields_value['content_option[0][opt_show_image_sub_cat]'] = Tools::getValue('content_option[0][opt_show_image_sub_cat]', $opt_show_image_sub_cat);
		
		//get value file option product
		$opt_image_size_product = isset($option->content_option->opt_image_size_product) ? $option->content_option->opt_image_size_product : null;
		
		$helper->fields_value['content_option[1][opt_image_size_product]'] = Tools::getValue('content_option[1][opt_image_size_product]', $opt_image_size_product);
		
		$opt_show_image_product = isset($option->content_option->opt_show_image_product) ? $option->content_option->opt_show_image_product : null;
		
		$helper->fields_value['content_option[1][opt_show_image_product]'] = Tools::getValue('content_option[1][opt_show_image_product]', $opt_show_image_product);

		//get value file option staticblock
		if(isset($option->content_option->opt_content_static))
		{
			foreach (Language::getLanguages(false) as $lang)
			{
				$opt_content_static[$lang['id_lang']] = $option->content_option->opt_content_static->$lang['id_lang'];
			}
		}
		else 
			$opt_content_static = null;
			
		$helper->fields_value['opt_content_static'] = $opt_content_static;
		
		//get value file option manufacture
		$opt_show_image_manu = isset($option->content_option->opt_show_image_manu) ? $option->content_option->opt_show_image_manu : null;
		
		$helper->fields_value['content_option[3][opt_show_image_manu]'] = Tools::getValue('content_option[3][opt_show_image_manu]', $opt_show_image_manu);
		
		$opt_image_size_manu = isset($option->content_option->opt_image_size_manu) ? $option->content_option->opt_image_size_manu : null;
		
		$helper->fields_value['content_option[3][opt_image_size_manu]'] = Tools::getValue('content_option[3][opt_image_size_manu]', $opt_image_size_manu);
		
		$opt_show_name_manu = isset($option->content_option->opt_show_name_manu) ? $option->content_option->opt_show_name_manu : null;
		
		$helper->fields_value['content_option[3][opt_show_name_manu]'] = Tools::getValue('content_option[3][opt_show_name_manu]', $opt_show_name_manu);
		
		$this->_html .= $helper->generateForm($this->fields_form);
	}
	
	
	public function _displayMenuCategories()
	{
		global $currentIndex;
		$this->context->controller->addJs($this->_path.'js/csmegamenu_dnd.js');
		$stringConfirmOption='if (!confirm(\'Are you sure that you want to delete this item option?\')) return false;';
		$html = '<form method="post" name="formMainMenu" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">
		<div class="categorieTitle">
		<fieldset>
		<div class="panel-heading">'.$this->l('Menu Tree').'</div>
		
		<div class="subHeadline">&nbsp;</div>
		<table width="100%" id="menu" class="table csmegamenu tableDnD feature table_grid" cellspacing="0" cellpadding="0">
		<tbody>
		<tr style="height: 40px" class="nodrag nodrop">
			<th class="center"><input type="checkbox" name="checkme" id="idCheckDelBoxesMenu" class="noborder" onclick="checkDelBoxesMenu(this.form, \'checkMenuItem[]\',this.checked)"></th>
			<th colspan="4"><input style="margin-left:9px" type="submit" class="btn btn-default" name="submitDeleteMenus" value="'.$this->l('Delete selected').'"></th>
		</tr>
		';
		$menus = $this->getMenus();
		$id_menu_active = Tools::getValue('id_csmegamenu');
		if (is_array($menus))
		{
			foreach ($menus as $menu)
			{
				$menu_item = new CsMegaMenuClass($menu['id_csmegamenu']);
				$options_list = $menu_item->getOptionForMenu();
				$number_option = $menu_item->getNumberOptionForMenu();
				$html .= '
				<tr class="row_hover" id="'.$menu['id_csmegamenu'].'">
				
					<td class="center"><input type="checkbox" name="checkMenuItem[]" class="noborder" value="'.$menu['id_csmegamenu'].'" onclick="checkCheckItemBox(this.form,\'checkme\',\'checkMenuItem[]\',this.checked)"/></td>
					
					<td class="dragHandle center">'.($menu !== end($menus) ? '<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderMenu&id_csmegamenu='.$menu['id_csmegamenu'].'&way=1&position='.($menu['position']+1).'"><img src="'._PS_ADMIN_IMG_.'down.gif" alt="'.$this->l('Down').'" /></a>' : '').($menu !== reset($menus) ? '<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderMenu&id_csmegamenu='.$menu['id_csmegamenu'].'&way=0&position='.($menu['position']-1).'"><img src="'._PS_ADMIN_IMG_.'up.gif" alt="'.$this->l('Up').'" /></a>' : '').'</td>
					
					<td><div class="categorieWidth" id="categorieWidth'.$menu['id_csmegamenu'].'" onclick="$(\'.categorieWidth\').css(\'font-weight\',\'normal\');$(this).css(\'font-weight\',\'bold\');"><a class="upper" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editMenu&id_csmegamenu='.$menu['id_csmegamenu'].'" '.(isset($id_menu_active) && $id_menu_active ==  $menu['id_csmegamenu'] ? "style=\"font-weight:bold;\"" : "" ).'>'.$menu['title'].'</a></div></td>
					
					<td><b>'.$number_option.'</b></td>
					
					<td><b><img style="cursor:pointer" title="'.$this->l('Show option').'" id="image_more_options'.$menu['id_csmegamenu'].'" src="../img/admin/more.png" alt="'.$this->l('show Options').'" 
					onclick="if ($(\'#option_menu_'.$menu['id_csmegamenu'].'\').is(\':visible\'))$(this).attr(\'src\', \'../img/admin/more.png\'); else $(this).attr(\'src\', \'../img/admin/less.png\');$(\'#option_menu_'.$menu['id_csmegamenu'].'\').slideToggle(\'slow\');" /></b></td>
					
				</tr>';
				$menu_item = new CsMegaMenuClass($menu['id_csmegamenu']);
				$options_list = $menu_item->getOptionForMenu();
				$html .= '
					<script type="text/javascript">
						$(document).ready(function() {
							initTableDnD("table.tableDnDOption'.$menu['id_csmegamenu'].'");
						});
					</script>
					<tr id="option_menu_'.$menu['id_csmegamenu'].'" style="display:none">
					<td>&nbsp;</td>
					<td colspan="4"><table id="tableDnDOption'.$menu['id_csmegamenu'].'" class="tableOption tableDnDOption'.$menu['id_csmegamenu'].' table">';
					if(isset($options_list) && !empty($options_list))
					{
						$number = 1;
						foreach ($options_list as $option)
						{
							$html .= '<tr id="option'.$menu['id_csmegamenu'].'_'.$option['id_option'].'" class="row_hover_opt alt_row" >';
							foreach ($this->optionsMenu as $k=>$ot)
							{
								if($ot['key'] == $option['type_option'])
								{
									$html .='<td class="pointer dragHandle center">'.($option !== end($options_list) ? '
										<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderOptionMenu&id_option='.$option['id_option'].'&way=1&position_option='.($option['position_option']+1).'&id_csmegamenu='.$option['id_csmegamenu'].'">
										<img src="'._PS_ADMIN_IMG_.'down.gif" alt="'.$this->l('Down').'" />
										</a>' : '').($option !== reset($options_list) ? '
										<a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&orderOptionMenu&id_option='.$option['id_option'].'&way=0&position_option='.($option['position_option']-1).'&id_csmegamenu='.$option['id_csmegamenu'].'">
										<img src="'._PS_ADMIN_IMG_.'up.gif" alt="'.$this->l('Up').'" /></a>' : '').'</td>
										<td><a href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&editOptionMenu&id_option='.$option['id_option'].'&id_csmegamenu='.$menu['id_csmegamenu'].'&type_option='.$option['type_option'].'"><span>'.$number++.' - '.$this->l('Optiton ').''.$ot['name'].' (#'.$option['id_option'].')</span></a></td>';
									break; 
								}
							}
							$html .= '<td><b onclick="document.location =\''.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteOptionMenu&id_option='.$option['id_option'].'\'"><i class="icon-trash"></i></b></td>
							</tr>';
						}
					}
					else
					{
						$html .= '<tr><td><a href="#"><span style="margin-left:97px;color:#585a69">'.$this->l('No option').'</span></a></td></tr>';
					}
					$html .= '</table></td>
					</tr>
					';
			}
		}
		
		$html .= '
		<tr style="height: 40px" class="nodrag nodrop">
			<th class="center"><input type="checkbox" name="checkme" id="idCheckDelBoxesMenu" class="noborder" onclick="checkDelBoxesMenu(this.form, \'checkMenuItem[]\',this.checked)"></th>
			<th colspan="4"><input style="margin-left:9px" type="submit" class="btn btn-default" name="submitDeleteMenus" value="'.$this->l('Delete selected').'" ></th>
		</tr>
		</tbody>
		</table>
		</fieldset>
		</div>
		</form>
		';
		return $html;
	}
	
	
	
	public function initFormMenu($id_csmegamenu=null)
	{
	
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$this->fields_form[0]['form'] = array(
					'tinymce' => true,
					'legend' => array(
					'title' => $this->l('Menu item'),
			),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Title'),
					'lang' => true,
					'name' => 'title',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Link of title'),
					'lang' => true,
					'name' => 'link_of_title',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Number of column'),
					'name' => 'number_column',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Width'),
					'name' => 'width',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
					'type' => 'text',
					'label' => $this->l('Class'),
					'name' => 'classes',
					'cols' => 40,
					'rows' => 10
					
				),
				array(
						'type' => 'switch',
						'label' => $this->l('Displayed'),
						'name' => 'display',
						'values' => array(
									array(
										'id' => 'active_on',
										'value' => 1,
										'label' => $this->l('Enabled')
									),
									array(
										'id' => 'active_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			  ),
			  array(
					'type' => 'file',
					'label' => $this->l('Image icon'),
					'name' => 'icon'
					
			),
			array(
						'type' => 'switch',
						'label' => $this->l('Displayed icon'),
						'name' => 'display_icon',
						'values' => array(
									array(
										'id' => 'display_icon_on',
										'value' => 1,
										'label' => $this->l('Enabled')
									),
									array(
										'id' => 'display_icon_off',
										'value' => 0,
										'label' => $this->l('Disabled')
									)
						),
			  ),
			  array(
					'type' => 'text',
					'label' => $this->l('Description'),
					'name' => 'description',
					'lang' => true,
					'cols' => 40,
					'rows' => 10
				),
			),
			
			'submit' => array(
				'title' => $this->l('Save'),
			)
		);
		
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'csmegamenu';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveMenu';
		$helper->toolbar_btn =  array(
			'save' =>
			array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
			),
			'back' =>
			array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'),
				'desc' => $this->l('Back to list')
			)
		);

		$id_csmegamenu = Tools::getValue('id_csmegamenu');
		if (Tools::isSubmit('id_csmegamenu') && $id_csmegamenu && !Tools::isSubmit('saveMenuOptionConfirmation') && !Tools::isSubmit('saveSubmitOptionMenu'))
		{
			$menu = new CsMegaMenuClass((int)$id_csmegamenu);
			$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_csmegamenu');
			$helper->fields_value['id_csmegamenu'] = (int)Tools::getValue('id_csmegamenu', $menu->id_csmegamenu);
			if (isset($menu->icon) && $menu->icon != '')
			{
				$this->fields_form[0]['form']['input'][] = array('type' => 'hidden', 'name' => 'has_picture');
				$helper->fields_value['has_picture'] = $menu->icon;
				$helper->tpl_vars = array(
					'picture_icon' => $menu->icon,
					'base_url' => $this->context->shop->getBaseURL().'/modules/csmegamenu/img/icon/',
					'_PS_ADMIN_IMG_' => _PS_ADMIN_IMG_
				);
			}
				
		}
		else
			$menu = new CsMegaMenuClass();
		foreach (Language::getLanguages(false) as $lang)
		{
			$helper->fields_value['title'][(int)$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'],$menu->title[(int)$lang['id_lang']]);
			$helper->fields_value['link_of_title'][(int)$lang['id_lang']] = Tools::getValue('link_of_title_'.(int)$lang['id_lang'],$menu->link_of_title[(int)$lang['id_lang']]);
			
			$helper->fields_value['description'][(int)$lang['id_lang']] =  Tools::getValue('description_'.(int)$lang['id_lang'],$menu->description[(int)$lang['id_lang']]);
		}
		$helper->fields_value['number_column'] = Tools::getValue('number_column',$menu->number_column);
		$helper->fields_value['width'] = Tools::getValue('width',$menu->width);
		$helper->fields_value['classes'] = Tools::getValue('classes',$menu->classes);
		$helper->fields_value['display'] = Tools::getValue('display',$menu->display);
		$helper->fields_value['display_icon'] = Tools::getValue('display_icon', $menu->display_icon);
		$helper->fields_value['icon'] = Tools::getValue('icon', $menu->icon);

		$this->_html .= $helper->generateForm($this->fields_form);
		
	}
	public function _displayForm()
	{
		$this->_html .= '<div style="overflow:hidden"><div class="panel slider">';
		$this->_html .= $this->_displayMenuCategories().'</div><div class="panel form_content cs_hide_option">';
		if (Tools::isSubmit('addOptionMenu') || Tools::isSubmit('editOptionMenu') || Tools::isSubmit('saveSubmitOptionMenu'))
			$this->initFormOption();
		else
			$this->initFormMenu();
		
		$this->_html .= '</div></div>';
		
	}
	public function displayProducFill($option)
	{
		$id_lang=$this->context->language->id;
		$html = '<div class="col-lg-9 ">
				<input type="text" value="" id="opt_product_autocomplete_input" />
				<p style="margin:5px 0">'.$this->l('Type characters begin name product').'</p>
				</p>
				<input type="hidden" id="input_hidden_id" name="content_option[1][input_hidden_id]" value="'.(isset($option->content_option->input_hidden_id) ? $option->content_option->input_hidden_id : '').'"/>
				<input type="hidden" id="input_hidden_name" name="content_option[1][input_hidden_name]" value="'.(isset($option->content_option->input_hidden_id) ? $option->content_option->input_hidden_name : '').'"/>
				
				<div id="opt_result_product_autocomplete" class="margin-form">';
				if(isset($option->content_option->input_hidden_id))
				{
					$stringIdProducts = $option->content_option->input_hidden_id;
					$arrayIdProducts = explode('-',$stringIdProducts);
					$stringNameProducts = $option->content_option->input_hidden_name;
					$arrayNameProducts = explode('¤',$stringNameProducts);
					$products = array();
					foreach ($arrayIdProducts as $k=>$id_product)
					{
						
							if($id_product !== end($arrayIdProducts))
							{
								$proObj = new Product((int)$id_product,$id_lang);
								if (Validate::isLoadedObject($proObj))
								{
									$html .= $arrayNameProducts[$k].'
									<span class="delProducts" name="'.$id_product.'" style="cursor: pointer;">
									<i class="icon-trash"></i>
									</span><br />';
								}
							}
					}
				}
				$html .= '</div></div>';
			return $html;
	}
	public function displayManufactureList($opt_list_manu = null)
	{
		
		$html ='<table cellspacing="0" cellpadding="0" class="table" width="100%">
				<tbody>
				<tr class="nodrag nodrop">
				<th><input type="checkbox" name="content_option[3][opt_check-manu]" class="noborder" value=""/></th>
				<th>'.$this->l('ID').'</th>
				<th>'.$this->l('Name').'</th>
				</tr>
				';
				$manu_list = Manufacturer ::getManufacturers(false,0,false);
				static $irow_manu = 0;
				foreach($manu_list as $manu)
				{
					$html .= '
					<tr '.($irow_manu++ % 2 ? 'class="alt_row"' : '').'>
					<td><input type="checkbox"';
					if(isset($opt_list_manu))
					{
						
						if(in_array($manu['id_manufacturer'], $opt_list_manu))
						$html .= ' checked=checked';
					}
					$html .= ' name="content_option[3][opt_list_manu][]" value="'.$manu['id_manufacturer'].'"/>'.'
					</td>
					<td>'.$manu['id_manufacturer'].'</td>
					<td>'.$manu['name'].'</td>
					</tr>
					';
				}
				$html .= '</tbody></table>';
		return $html;
	}
	
	private function _postProcess()
	{
		global $currentIndex;
		$errors = array();//
		if (Tools::isSubmit('sortpostition'))
		{
			$positions = Tools::getValue('menu');
			if (is_array($positions))
			{
				$menus = array();
				$i = 0;
				foreach ($positions as $pos)
				{
					if(is_numeric($pos))
					{
						$menus[$i] = $pos;
						$i++;
					}
				}
				$CsMegaMenuClass = new CsMegaMenuClass();
				$CsMegaMenuClass->cleanSortPositions($menus);
				$this->_clearCache('csmegamenu.tpl');
				echo $this->_displayMenuCategories();die;
			}
		}
		else if (Tools::isSubmit('sortpostitionoption'))
		{
			
			$optForMenu = Tools::getValue('table_name');
			$positions = Tools::getValue(''.$optForMenu.'');
			$options = array();
			$i = 0;
			foreach($positions as $pos)
			{
				$temp = explode("_", $pos);
				$options[$i] = $temp[1];
				$i++;
			}
			$CsMegaMenuOptionClass = new CsMegaMenuOptionClass();
			$CsMegaMenuOptionClass->cleanSortPositions($options);
			$this->_clearCache('csmegamenu.tpl');
			echo $this->_displayMenuCategories();
			die;
		}
		elseif (Tools::isSubmit('saveMenu'))
		{
			$mg_menu = new CsMegaMenuClass(Tools::getValue('id_csmegamenu'));
			$mg_menu->copyFromPost();
			$errors = $mg_menu->validateController();
			if (sizeof($errors))
			{
				$this->_html .= $this->displayError(implode('<br />', $errors));
			}
			else
			{
				(Tools::isSubmit('id_csmegamenu')) ? $mg_menu->update() : $mg_menu->add();
				$this->_clearCache('csmegamenu.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveMenuConfirmation');
			}
		}
		elseif (Tools::isSubmit('saveSubmitOptionMenu'))
		{
			$mg_menu_option = new CsMegaMenuOptionClass(Tools::getValue('id_option'));
			$errors =  $mg_menu_option->validateController();
			if (isset($errors) && $errors != '')
			{
				$this->_html .= $this->displayError($errors);
			}
			else
			{
				$mg_menu_option->copyFromPostOption();
				Tools::isSubmit('id_option') ? $mg_menu_option->update() : $mg_menu_option->add();
				$this->_clearCache('csmegamenu.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveMenuOptionConfirmation&id_csmegamenu='.$mg_menu_option->id_csmegamenu);
			}
		}
		elseif (Tools::isSubmit('applyOptions'))
		{
			if ($error = $this->saveXmlOption())
				$this->_html .= $error;
			else
			{
				$this->_clearCache('csmegamenu.tpl');
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
			}
		}
		elseif (Tools::isSubmit('changeStatusMenu') AND Tools::getValue('id_csmegamenu'))
		{
			$mg_menu = new CsMegaMenuClass(Tools::getValue('id_csmegamenu'));
			$mg_menu->updateStatus(Tools::getValue('status'));
			$this->_clearCache('csmegamenu.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules'));
		}
		elseif (Tools::isSubmit('deleteMenu') AND Tools::getValue('id_csmegamenu'))
		{
			$mg_menu = new CsMegaMenuClass(Tools::getValue('id_csmegamenu'));
			$options = $mg_menu->getOptionForMenu();
			if(!empty($options))
			{
				foreach ($options as $option)
				{
					$mg_menu_option = new CsMegaMenuOptionClass($option['id_option']);
					$mg_menu_option->delete();
					$mg_menu_option->cleanPositionsOption();
				}
			}
			$mg_menu->delete();
			$mg_menu->cleanPositions();
			$this->_clearCache('csmegamenu.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteMenuConfirmation');
		}
		elseif (Tools::isSubmit('submitDeleteMenus'))
		{
			if(empty($_POST['checkMenuItem']))
			{
				$this->_html = $this->displayError($this->l('You must select at least one element to delete.'));
				return;
			}
			foreach($_POST['checkMenuItem'] as $IDMenu)
			{
				$mg_menu = new CsMegaMenuClass($IDMenu);
				$options = $mg_menu->getOptionForMenu();
				if(!empty($options))
				{
					foreach ($options as $option)
					{
						$mg_menu_option = new CsMegaMenuOptionClass($option['id_option']);
						$mg_menu_option->delete();
						$mg_menu_option->cleanPositionsOption();
					}
				}
				$mg_menu->delete();
				$mg_menu->cleanPositions();
				$this->_clearCache('csmegamenu.tpl');
			}
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteMenuConfirmation');
		}
		elseif (Tools::isSubmit('orderMenu') AND Validate::isInt(Tools::getValue('id_csmegamenu')) AND Validate::isInt(Tools::getValue('position')))
		{
			$mg_menu = new CsMegaMenuClass(Tools::getValue('id_csmegamenu'));
			$mg_menu->updatePosition(Tools::getValue('way'),Tools::getValue('position'));
			$this->_clearCache('csmegamenu.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&changePositionConfirmation');
		}
		elseif (Tools::isSubmit('orderOptionMenu') AND Validate::isInt(Tools::getValue('id_option')) AND Validate::isInt(Tools::getValue('position_option')))
		{
			$mg_menu_option = new CsMegaMenuOptionClass(Tools::getValue('id_option'));
			$mg_menu_option->updatePositionOption(Tools::getValue('way'),Tools::getValue('position_option'));
			$this->_clearCache('csmegamenu.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&changPositionOptionMenuConfirmation&id_csmegamenu='.Tools::getValue('id_csmegamenu').'');
		}
		elseif (Tools::isSubmit('deleteOptionMenu') AND Tools::getValue('id_option'))
		{
			$mg_menu_option = new CsMegaMenuOptionClass(Tools::getValue('id_option'));
			$mg_menu_option->delete();
			$mg_menu_option->cleanPositionsOption();
			$this->_clearCache('csmegamenu.tpl');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&deleteOptionMenuConfirmation&id_csmegamenu='.$mg_menu_option->id_csmegamenu.'');
		}
		elseif (Tools::isSubmit('saveMenuConfirmation'))
			$this->_html .= $this->displayConfirmation($this->l('Menu has been added successfully'));
		elseif (Tools::isSubmit('deleteOptionMenuConfirmation'))
		{
			$this->_html .= '
			<script type="text/javascript">
			$(document).ready(function() {
				$("#option_menu_'.Tools::getValue('id_csmegamenu').'").show();
				$("#image_more_options'.Tools::getValue('id_csmegamenu').'").attr(\'src\', \'../img/admin/less.png\');
				$("#categorieWidth'.Tools::getValue('id_csmegamenu').'").css("font-weight","bold");
			});</script>';
			$this->_html .= $this->displayConfirmation($this->l('Option has been deleted successfully'));
		}
		elseif (Tools::isSubmit('changPositionOptionMenuConfirmation'))
		{
			$this->_html .= '
			<script type="text/javascript">
			$(document).ready(function() {
				$("#option_menu_'.Tools::getValue('id_csmegamenu').'").show();
				$("#image_more_options'.Tools::getValue('id_csmegamenu').'").attr(\'src\', \'../img/admin/less.png\');
			});</script>';
			$this->_html .= $this->displayConfirmation($this->l('Change position option has been deleted successfully'));
		}
		elseif (Tools::isSubmit('saveMenuOptionConfirmation'))
		{
			$this->_html .= '
				<script type="text/javascript">
				$(document).ready(function() {
					$("#option_menu_'.Tools::getValue('id_csmegamenu').'").show();
					$("#image_more_options'.Tools::getValue('id_csmegamenu').'").attr(\'src\', \'../img/admin/less.png\');
					$("#image_more_options'.Tools::getValue('id_csmegamenu').'").attr(\'src\', \'../img/admin/less.png\');
					$("#categorieWidth'.Tools::getValue('id_csmegamenu').'").css("font-weight","bold");
				});</script>';
			$this->_html .= $this->displayConfirmation($this->l('Option of menu has been saved successfully'));
		}
		elseif (Tools::isSubmit('changePositionConfirmation'))
		{
		$this->_html .= $this->displayConfirmation($this->l('Change position successfully'));
		}
	}
	
	private function _displayOptions()
	{
		
		$option = simplexml_load_file(dirname(__FILE__).'/'.'option.xml');
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		$this->fields_form[0]['form'] = array(
					'tinymce' => true,
					'legend' => array(
					'title' => $this->l('Megamenu Options'),
					),
			'input' => array(
				array(
					'type' => 'text',
					'label' => $this->l('Add More Item for Ipad horizontal:'),
					'name' => 'moreipadh',
					'cols' => 40,
					'rows' => 10,
					'hint' => $this->l('Add More-item after the xth menu item. Ex: 6,7,8... If =0,will not add More-item')
				),
				array(
					'type' => 'text',
					'label' => $this->l('Add More Item for Ipad vertical:'),
					'name' => 'moreipadv',
					'cols' => 40,
					'rows' => 10,
					'hint' => $this->l('Add More-item after the xth menu item. Ex: 5,6,7... If =0,will not add More-item')
					
				),
			),
			'submit' => array(
				'title' => $this->l('Save')
			)
		);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'csmegamenu';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		foreach (Language::getLanguages(false) as $lang)
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0)
			);

		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'applyOptions';
		
		
		$helper->fields_value['moreipadh'] = $option->moreipadh ? $option->moreipadh : 0;
		$helper->fields_value['moreipadv'] = $option->moreipadv ? $option->moreipadv : 0;
		$this->_html .= $helper->generateForm($this->fields_form);
	}
	
	private function saveXmlOption($reset = false)
	{
		$error = false;
		$newXml = '<?xml version=\'1.0\' encoding=\'utf-8\' ?>'."\n".'<options>'."\n";
		
		$newXml .= '<moreipadh>';
		$newXml .= ($reset ? 0 : Tools::getValue('moreipadh'));
		$newXml .= '</moreipadh>'."\n";
		
		$newXml .= '<moreipadv>';
		$newXml .= ($reset ? 0 : Tools::getValue('moreipadv'));
		$newXml .= '</moreipadv>'."\n";
		
		$newXml .= '</options>'."\n";
		if ($fd = @fopen(dirname(__FILE__).'/'.'option.xml', 'w'))
		{
			if (!@fwrite($fd, $newXml))
				$error = $this->displayError($this->l('Unable to write to the editor file.'));
			if (!@fclose($fd))
				$error = $this->displayError($this->l('Can\'t close the editor file.'));
		}
		else
			$error = $this->displayError($this->l('Unable to update the editor file. Please check the editor file\'s writing permissions.'));
		return $error;
	}
	
	public function getContent()
   	{
		global $currentIndex;
		$this->context->controller->addCss($this->_path.'css/csmegamenu_admin.css', 'all');//css for admin form
		$this->_html .= '
		<link href="'._PS_JS_DIR_.'jquery/plugins/autocomplete/jquery.autocomplete.css" rel="stylesheet" type="text/css" media="all" />
		<script type="text/javascript" src="'._PS_JS_DIR_.'jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="'.$this->_path.'js/csmegamenu.js"></script>
		<script type="text/javascript" src="'._PS_JS_DIR_.'jquery/plugins/jquery.tablednd.js"></script>	
		<script type="text/javascript">
            var come_from = "menu";
            var token = "'.Tools::getAdminTokenLite('AdminModules').'";
			var __PS_BASE_URI__ = "'.__PS_BASE_URI__.'";
            var alternate = 1;
			var currentIndex = "'.$currentIndex.'";
			var name = "'.$this->name.'";
        </script>
		<div class="panel">
		<div class="panel-heading">'.$this->displayName.'
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'"><span data-toggle="tooltip" class="label-tooltip" data-original-title="Add new menu" data-html="true"><i class="process-icon-new "></i></span></a>
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&addOptionMenu'.'"><span data-toggle="tooltip" class="label-tooltip" data-original-title="Add new option" data-html="true"><i class="process-icon-new "></i></span>
					</a>
			</span>
		</div>	
		</div>';
		$this->_postProcess();
		$this->_displayForm();
		$this->_displayOptions();
		return $this->_html;
	}
	
	private function getMenus($active = null) //case in : allshop show shop default
	{
		$this->context = Context::getContext();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
	 	if (!$result = Db::getInstance()->ExecuteS(
			'SELECT ms.*, ml.`title`,ml.`description`,m.`icon`
			FROM `'._DB_PREFIX_.'csmegamenu` m
			LEFT JOIN `'._DB_PREFIX_.'csmegamenu_shop` ms ON (m.`id_csmegamenu` = ms.`id_csmegamenu` )
			LEFT JOIN `'._DB_PREFIX_.'csmegamenu_lang` ml ON (m.`id_csmegamenu` = ml.`id_csmegamenu` '.( $id_shop ? 'AND ml.`id_shop` = '.$id_shop : ' ' ).') 
			WHERE ml.id_lang = '.(int)$id_lang.
			($active ? ' AND ms.`display` = 1' : ' ').
			( $id_shop ? 'AND ms.`id_shop` = '.$id_shop : ' ' ).'
			ORDER BY ms.`position` ASC'))
	 		return false;
	 	return $result;
	}
	
	
	/*For front end*/
	public function getTree($resultParents, $resultIds, $maxDepth, $id_category = null, $currentDepth = 0)
	{
		if (is_null($id_category))
			$id_category = $this->context->shop->getCategory();

		$children = array();
		if (isset($resultParents[$id_category]) && count($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
		$return = array('id' => $id_category, 'link' => $this->context->link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => $resultIds[$id_category]['name'], 'desc'=> $resultIds[$id_category]['description'],
					 'children' => $children);
		return $return;
	}
	public function getAllSubCategory ($id_parent)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_customer = intval($this->context->customer->id);
		$maxdepth = 5;
		$row = Db::getInstance()->getRow('
		SELECT `level_depth`
		FROM '._DB_PREFIX_.'category c
		WHERE c.`id_category` = '.intval($id_parent));
		$maxdepth = $maxdepth + $row['level_depth'];
		if (!$result = Db::getInstance()->ExecuteS('
		SELECT DISTINCT c.*, cl.*
		FROM `'._DB_PREFIX_.'category` c 
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.(int)Context::getContext()->language->id.')
		LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
		WHERE c.`active` = 1 AND cl.id_shop = '.$id_shop
		.(intval($maxdepth) != 0 ? ' AND `level_depth` <= '.intval($maxdepth) : '').'
		AND cg.`id_group` '.(!$id_customer ?  '= 1' : 'IN (SELECT id_group FROM '._DB_PREFIX_.'customer_group WHERE id_customer = '.$id_customer.')').'
		ORDER BY `level_depth` ASC'))
			return;
		$resultParents = array();
		$resultIds = array();

		foreach ($result as $row)
		{
			$resultParents[$row['id_parent']][] = $row;
			$resultIds[$row['id_category']] = $row;
		}
		
		$blockCategTree = $this->getTree($resultParents, $resultIds, $maxdepth,$id_parent);
		return $blockCategTree;
	}
	public static function getCMStitles($cmsCategories)
	{
		$content = array();
		$id_cms_temp = 0;
		$id_lang= Context::getContext()->language->id;
		foreach ($cmsCategories AS $key=>$cmsCategory)
		{
			$ids = explode('_', $cmsCategory);
			$cms = new CMS((int)$ids[1],$id_lang);
			if (Validate::isLoadedObject($cms) && $cms->active == 1)
			{
				if ($ids[0] == 1)
				{
					$query = Db::getInstance()->getRow('
					SELECT cl.`name`, cl.`link_rewrite`
					FROM `'._DB_PREFIX_.'cms_category_lang` cl
					INNER JOIN `'._DB_PREFIX_.'cms_category` c ON (cl.`id_cms_category` = c.`id_cms_category`)
					WHERE cl.`id_cms_category` = '.(int)$ids[1].' AND (c.`active` = 1 OR c.`id_cms_category` = 1)
					AND cl.`id_lang` = '.$id_lang);
					$content[$id_cms_temp]['link'] = Context::getContext()->link->getCMSCategoryLink((int)$ids[1], $query['link_rewrite']);
					$content[$id_cms_temp]['meta_title'] = $query['name'];
				}
				elseif (!$ids[0])
				{
					$query = Db::getInstance()->getRow('
					SELECT cl.`meta_title`, cl.`link_rewrite` 
					FROM `'._DB_PREFIX_.'cms_lang` cl
					INNER JOIN `'._DB_PREFIX_.'cms` c ON (cl.`id_cms` = c.`id_cms`)
					WHERE cl.`id_cms` = '.(int)$ids[1].' AND c.`active` = 1
					AND cl.`id_lang` = '.$id_lang);
					
					$content[$id_cms_temp]['link'] = Context::getContext()->link->getCMSLink((int)$ids[1], $query['link_rewrite']);
					$content[$id_cms_temp]['meta_title'] = $query['meta_title'];
				}
				$id_cms_temp++;
			}
		}
		return $content;
	}
	
	private function getMenuDisplay()
	{
		$menus = array();
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		$results = Db::getInstance()->ExecuteS(
					'SELECT ms.`id_csmegamenu` FROM `'._DB_PREFIX_.'csmegamenu` m
					LEFT JOIN `'._DB_PREFIX_.'csmegamenu_shop` ms ON (ms.id_csmegamenu = m.id_csmegamenu)
					LEFT JOIN `'._DB_PREFIX_.'csmegamenu_lang` ml ON (ml.id_csmegamenu = m.id_csmegamenu AND ml.id_shop = '.$id_shop.')
					WHERE (ms.id_shop = '.(int)$id_shop.') AND ml.id_lang = '.$id_lang.'
					AND ms.`display` = 1 ORDER BY ms.`position` ASC
				');
		if (!empty($results))
		foreach ($results as $row)
		{
			$menus[$row['id_csmegamenu']] = new CsMegaMenuClass($row['id_csmegamenu']);
			if($menus[$row['id_csmegamenu']]->number_column !=0)
				$menus[$row['id_csmegamenu']]->width_item = $menus[$row['id_csmegamenu']]->width/($menus[$row['id_csmegamenu']]->number_column!= 0 ? $menus[$row['id_csmegamenu']]->number_column : 1);
			else
				$menus[$row['id_csmegamenu']]->width_item = $menus[$row['id_csmegamenu']]->width;
			$menus[$row['id_csmegamenu']]->options = $menus[$row['id_csmegamenu']]->getOptionForMenu();
			if($menus[$row['id_csmegamenu']]->options)
			{
				foreach ($menus[$row['id_csmegamenu']]->options as $key=>$option)
				{
					
					if($option['type_option'] == 2) //check option static block
					{
						$option['content_option'] = json_decode(htmlspecialchars_decode(($option['content_option'])));
						$languages = Language::getLanguages(false);
						foreach ($languages AS $language)
						{
							if(isset($option['content_option']->opt_content_static->$language['id_lang']))
							$option['content_option']->opt_content_static->$language['id_lang'] = str_replace($this->temp_url, _PS_BASE_URL_.__PS_BASE_URI__, $option['content_option']->opt_content_static->$language['id_lang']);
						}
					}
					else
						$option['content_option'] = json_decode($option['content_option']);
					
					$option['width'] = $menus[$row['id_csmegamenu']]->width_item * $option['content_option']->opt_fill_column;
					//get content for type option
					if($option['type_option'] == 0)//option 0 : type category
					{
						if($option['content_option']->opt_show_parent_cat == 1 || $option['content_option']->opt_show_image_cat == 1)
						{
							$option['category_parent']= new Category($option['content_option']->opt_id_parent_cat,(int)Context::getContext()->language->id);
						}
						$option['sub_category'] = $this->getAllSubCategory($option['content_option']->opt_id_parent_cat);
					}
					if($option['type_option'] == 1) //option 1 : type product
					{
						$stringIdProducts = $option['content_option']->input_hidden_id;
						$arrayIdProducts = explode('-',$stringIdProducts);
						
						$productIds = substr(implode(',',$arrayIdProducts),0,strlen(implode(',',$arrayIdProducts)) - 1);
						$productsImages = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
					SELECT image_shop.id_image, p.id_product, il.legend, product_shop.active, pl.name, pl.description_short, pl.link_rewrite, cl.link_rewrite AS category_rewrite, p.show_price,p.available_for_order,p.out_of_stock,p.id_category_default, p.ean13 
					FROM '._DB_PREFIX_.'product p
					LEFT JOIN '._DB_PREFIX_.'product_lang pl ON ( pl.id_product = p.id_product AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
					LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = p.id_product AND i.cover = 1)'.
						Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
					LEFT JOIN '._DB_PREFIX_.'image_lang il ON (il.id_image = i.id_image)
					'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = product_shop.id_category_default'.Shop::addSqlRestrictionOnLang('cl').')
					WHERE p.id_product IN ('.$productIds.')
					AND (i.id_image IS NULL OR image_shop.id_shop='.(int)$this->context->shop->id.')');
					
					$productsImagesArray = array();
					foreach ($productsImages as $pi)
						$productsImagesArray[$pi['id_product']] = $pi;

					$productsViewedObj = Product::getProductsProperties((int)$this->context->language->id, $productsImagesArray);
						$option['product_list'] = $productsViewedObj;
					}
					//option 2: static block available
					if($option['type_option'] == 3) //option 3 : manufacturer
					{
						if(isset($option['content_option']->opt_list_manu))
						{
							$manu_temp = 0;
							foreach($option['content_option']->opt_list_manu as $k_manu=>$id_manu)
							{
								$manuObj = new Manufacturer((int)$id_manu,$this->context->language->id);
								if(Validate::isLoadedObject($manuObj))
								{
									$option['opt_list_manu_info'][$manu_temp] = $manuObj;
									$manu_temp++;
								}
							}
						}
					}
					if($option['type_option'] == 4) //option 4: cms (information)
					{
						if(isset($option['content_option']->footerBox) && $option['content_option']->footerBox)
						$option['cms'] = $this->getCMStitles($option['content_option']->footerBox);
					}
					$menus[$row['id_csmegamenu']]->options[$key] = $option;
					
				}
			}
			
		}
		return $menus;
		
	}
	
	/*-------------------------------------------------------------*/    
           
        public function _getRespCategories($id_category = 1, $id_lang = false, $id_shop = false){
        
            $id_lang = $id_lang ? (int)$id_lang : (int)Context::getContext()->language->id;
            $category = new Category((int)$id_category, (int)$id_lang, (int)$id_shop);

            if (is_null($category->id)){
                return;
            }

            $children = Category::getChildren((int)$id_category, (int)$id_lang, true, (int)$id_shop);
            
            
            $class = "";
            if (isset($children) && count($children) && $category->level_depth > 1){
                $class .= "parent ";
            }

                        
            if ($category->level_depth > 1){
                $cat_link = $category->getLink();
            }else{
                $cat_link = $this->context->link->getPageLink('index');
            }
            
            $is_intersected = array_intersect($category->getGroups(), $this->user_groups);
                                    
            if (!empty($is_intersected)){
                $this->_respMenu .= '<li class="'.$class.'">';
                $this->_respMenu .= '<a href="'.$cat_link.'"><span>'.$category->name.'</span></a>';
            }
            
            if (isset($children) && count($children)){
                
                $this->_respMenu .= '<ul>';
                
                foreach ($children as $child){
                        $this->_getRespCategories((int)$child['id_category'], (int)$id_lang, (int)$child['id_shop']);
                }
				if($id_category ==1)
				{
					if($this->isInstalled("csblog") && $this->isEnabled("csblog"))
					{	
					$id_lang = Context::getContext()->language->id;
					$url = $this->context->link->getModuleLink("csblog","categoryPost");
					$this->_respMenu.='<li><a href="'.$url.'"><span>'.$this->l('Our Blog').'</span></a></li>';
					}
				}
                $this->_respMenu .= '</ul>';
                
            }
			 if (!empty($is_intersected)){
				$this->_respMenu .= '</li>';
			}
           
            return $this->_respMenu;
     }
    
    
    
/*-------------------------------------------------------------*/
	
    public function _buildResponsiveMenu(){
 
		
        return $this->_getRespCategories(1, (int)Context::getContext()->language->id, $id_shop = false);
        
    }
  	
	public function hookDisplayHeader()
	{
		$this->context->smarty->assign(array(
			'CS_MEGA_MENU' => Hook::Exec('csmegamenu'),
			'LEFT_HOME_COLUMN' => Hook::Exec('homeleft')
		));
		$this->context->controller->addCSS(($this->_path).'css/csmegamenu_front.css', 'all');
		$this->context->controller->addJS(($this->_path).'js/csmegamenu_front.js');
		$this->context->controller->addJS(($this->_path).'js/csmegamenu_addmore.js');
	}
	
	function hookCsMegaMenu($params)
	{
		
		if($this->context->smarty->tpl_vars['page_name']->value == 'index')
		{
			
			if (!$this->isCached('csmegamenu_home.tpl', $this->getCacheId('csmegamenu_home')))
			{
				$this->user_groups = ($this->context->customer->getGroups());	
				$responsive_menu = $this->_buildResponsiveMenu();
				$this->context->smarty->assign(array(
					'responsive_menu' => $responsive_menu
				));				
			}
			return $this->display(__FILE__, 'csmegamenu_home.tpl',$this->getCacheId('csmegamenu_home'));
			
		}
		else
		{
			
			if (!$this->isCached('csmegamenu.tpl', $this->getCacheId('csmegamenu')))
			{
				$this->user_groups = ($this->context->customer->getGroups());
				$option_megamenu = simplexml_load_file(dirname(__FILE__).'/'.'option.xml');
				$menus = $this->getMenuDisplay();
				$this->_respMenu="";
				$responsive_menu = $this->_buildResponsiveMenu();
				$this->context->smarty->assign(array(
					'menus' => $menus,
					'ps_manu_img_dir' => _PS_MANU_IMG_DIR_,
					'ps_cat_img_dir' => _PS_CAT_IMG_DIR_,
					'path_icon' => _PS_BASE_URL_._MODULE_DIR_.'csmegamenu/img/icon/',
					'responsive_menu' => $responsive_menu,
					'option_megamenu' => $option_megamenu
				));	
			}
			return $this->display(__FILE__, 'csmegamenu.tpl',$this->getCacheId('csmegamenu'));
		}
		
	}
	
	function hookHomeLeft($params)
	{
		
		if ($this->context->smarty->tpl_vars['page_name']->value == 'index')
		{
			if (!$this->isCached('csmegamenu_homeleft.tpl', $this->getCacheId('csmegamenu_homeleft')))
			{
				$this->user_groups = ($this->context->customer->getGroups());
				$option_megamenu = simplexml_load_file(dirname(__FILE__).'/'.'option.xml');
				$menus = $this->getMenuDisplay();
				$responsive_menu = $this->_buildResponsiveMenu();
					
				$this->context->smarty->assign(array(
					'menus' => $menus,
					'ps_manu_img_dir' => _PS_MANU_IMG_DIR_,
					'ps_cat_img_dir' => _PS_CAT_IMG_DIR_,
					'path_icon' => _PS_BASE_URL_._MODULE_DIR_.'csmegamenu/img/icon/',
					'responsive_menu' => $responsive_menu,
					'option_megamenu' => $option_megamenu
				));
			}
			return $this->display(__FILE__, 'csmegamenu_homeleft.tpl',$this->getCacheId('csmegamenu_homeleft'));
		}
	}
	
	protected function getCacheId($name = null)
	{
		
		if (version_compare(_PS_VERSION_,'1.5.4','<'))
		{
			if(isset($this->context->currency->id))
				{ $id_currency=$this->context->currency->id;}
			else
				{ $id_currency=Configuration::get('PS_CURRENCY_DEFAULT');}
				
			$smarty_cache_id = $name.'|'.(int)Tools::usingSecureMode().'|'.(int)$this->context->shop->id.'|'.(int)Group::getCurrent()->id.'|'.(int)$this->context->language->id.'|'.$id_currency;
			$this->context->smarty->cache_lifetime = 31536000;
			Tools::enableCache();
			return $smarty_cache_id;
		}
		else 
		{
			parent::getCacheId($name);

			if(isset($this->context->currency->id))
				{ $id_currency=$this->context->currency->id;}
			else
				{ $id_currency=Configuration::get('PS_CURRENCY_DEFAULT');}
			
			$groups = implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id));
			$id_lang = (int)$this->context->language->id;
			
			return $name.'|'.(int)Tools::usingSecureMode().'|'.$this->context->shop->id.'|'.$groups.'|'.$id_lang.'|'.$id_currency;
			
		}	
	}
	
	public function hookActionObjectCategoryUpdateAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectCategoryDeleteAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectCmsUpdateAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectCmsDeleteAfter($params)
	{
		$this->clearCacheMegamenu();
	}

	public function hookActionObjectManufacturerUpdateAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectManufacturerDeleteAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectProductUpdateAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookActionObjectProductDeleteAfter($params)
	{
		$this->clearCacheMegamenu();
	}
	
	public function hookCategoryUpdate($params)
	{
		$this->clearCacheMegamenu();
	}
	public function hookActionUpdateQuantity($params)
	{
		$this->clearCacheMegamenu();
	}

	public function hookActionShopDataDuplication($params)
	{
		//duplicate menu for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'csmegamenu_shop (id_csmegamenu, id_shop, number_column, width, display, position)
		SELECT id_csmegamenu, '.(int)$params['new_id_shop'].', number_column, width, display,  position
		FROM '._DB_PREFIX_.'csmegamenu_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'csmegamenu_lang (id_csmegamenu, id_lang, id_shop, title, link_of_title, description)
		SELECT id_csmegamenu, id_lang, '.(int)$params['new_id_shop'].', title, link_of_title, description
		FROM '._DB_PREFIX_.'csmegamenu_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		//duplicate option for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'csmegamenu_option_shop (id_option, id_csmegamenu, id_shop, type_option, position_option, content_option)
		SELECT id_option, id_csmegamenu, '.(int)$params['new_id_shop'].', type_option, position_option, content_option
		FROM '._DB_PREFIX_.'csmegamenu_option_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		$this->_clearCache('csmegamenu.tpl');
	}
	
	public function clearCacheMegamenu()
	{
		$this->_clearCache('csmegamenu.tpl');
		$this->_clearCache('csmegamenu_homeleft.tpl');	
		$this->_clearCache('csmegamenu_home.tpl');	
	}
}

?>
