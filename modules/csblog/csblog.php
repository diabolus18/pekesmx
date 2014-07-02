<?php
require_once (dirname(__FILE__).'/url/csLink.php');
require_once (dirname(__FILE__).'/class/CSBLPost.php');
require_once (dirname(__FILE__).'/class/CSPLCategory.php');


class CSBlog extends Module
{
	private $tabParentClass = null;
	
	private $tabClassBlog = 'AdminCSBlog';
	private $tabNameBlog = null;
	private $_html_categories = '';
	private $psVersion = false;
	private $classTab = array();
	private $csLink;
	private $html = '';
	private $imageType;
	private $myHook = array('footer','displayLeftColumn','displayRightColumn','displayLeftRightColumn');
	private $myHookRegister = array('footer','displayLeftColumn','displayRightColumn');
	function __construct()
	{
		$this->name = 'csblog';
		$this->displayName = $this->l('CS Blog');
		$this->description = $this->l('CS Blog Module');
		$this->bootstrap = true;
		$this->version = '1.0';
		$this->author = 'Codespot';
		$this->tab = 'Other';
		$this->csLink = new csLink();
		$this->imageType = 'jpg';
		parent::__construct();

	}
	/*install*/
	function existsTab($tabClass)
	{
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT id_tab AS id 
		FROM `'._DB_PREFIX_.'tab` t 
		WHERE LOWER(t.`class_name`) = \''.pSQL($tabClass).'\'');
		if (count($result) == 0) 
			return false;
		return true;
	}
	function installDb()
	{
		/* Table category and category_lang*/
		// Table category
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_category(
				id_cs_blog_category int(11) NOT NULL AUTO_INCREMENT,
				category_parent int(11) NULL,
				level_depth int(11) NOT NULL,
				id_shop_default int(10) unsigned NOT NULL,
				date_add datetime NULL,
				active boolean NULL,
				position int(11) NULL,
				allow_comment bool NULL,
				PRIMARY KEY (`id_cs_blog_category`)
				)';
		Db::getInstance()->execute($sql);
		
		//Table category shop
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_shop';
		Db::getInstance()->execute($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_category_shop(
				id_cs_blog_category int(11) NOT NULL AUTO_INCREMENT,
				id_shop int(10) unsigned NOT NULL,
				position int(11) NULL,
				PRIMARY KEY (`id_cs_blog_category`,`id_shop`)
				)';
		Db::getInstance()->execute($sql);
		
		// Table category_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_lang';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_category_lang(
				id_cs_blog_category int(11) NOT NULL AUTO_INCREMENT,
				id_lang int(11) NOT NULL,
				id_shop int(10) unsigned NOT NULL,
				name nvarchar(500) NOT NULL,
				description nvarchar(2000) NULL,
				meta_title nvarchar(500) NULL,
				meta_description nvarchar(1000) NULL,
				meta_keywords nvarchar(1000) NULL,
				link_rewrite nvarchar(1000) NOT NULL,
				PRIMARY KEY(id_cs_blog_category, id_lang, id_shop)
				)';
		Db::getInstance()->execute($sql);
		
		//Table category post
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_post';
		Db::getInstance()->execute($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_category_post(
				id_cs_blog_category int(11) unsigned NOT NULL,
				id_cs_blog_post int(11) unsigned NOT NULL,
				PRIMARY KEY (`id_cs_blog_category`,`id_cs_blog_post`)
				)';
		Db::getInstance()->execute($sql);
		
		
		/*insert db for category*/
		$id_shop_default = (int)Configuration::get('PS_SHOP_DEFAULT');
		$sql =' INSERT INTO '._DB_PREFIX_.'cs_blog_category(id_cs_blog_category,category_parent, level_depth, id_shop_default,active, position, allow_comment) VALUES(1, 0, 0, '.$id_shop_default.', 1, 0, 1) ';
		Db::getInstance()->execute($sql);
		
		$langs = Db::getInstance()->ExecuteS('SELECT * FROM '._DB_PREFIX_.'lang');
		$shops = Shop::getShops();
		foreach ($shops as $shop)
		{
			$sql =' INSERT INTO '._DB_PREFIX_.'cs_blog_category_shop(id_cs_blog_category,id_shop,position) VALUES(1,'.$shop['id_shop'].',0) ';
			Db::getInstance()->execute($sql);
			foreach ($langs as $lang)
			{
				$sql = ' INSERT INTO '._DB_PREFIX_.'cs_blog_category_lang(id_cs_blog_category, id_lang, id_shop, name,link_rewrite) VALUES(1, '.$lang['id_lang'].', '.$shop['id_shop'].' , "Blog Home", "blog-home") ';
				Db::getInstance()->execute($sql);
			}
		}
		
		/*Table post and post_lang*/
		// Table post
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_post(
				id_cs_blog_post int(11) NOT NULL AUTO_INCREMENT,
				id_cs_blog_category int(11) NOT NULL,
				id_shop_default int(10) unsigned NOT NULL,
				date_add datetime NULL,
				position int(11) NULL,
				allow_comment boolean NULL,
				active boolean NULL,
				author varchar(255) NULL,
				id_related_posts varchar(255) NULL,
				name_related_posts varchar(4000) NULL,
				id_related_products varchar(255) NULL,
				name_related_products varchar(4000) NULL,
				PRIMARY KEY(id_cs_blog_post)
				)';
		Db::getInstance()->execute($sql);
		
		//Table post_shop
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_shop';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_post_shop(
				id_cs_blog_post int(11) NOT NULL AUTO_INCREMENT,
				id_shop int(11) NOT NULL,
				id_cs_blog_category int(11) NOT NULL,
				id_shop_default int(11) NOT NULL,
				date_add datetime NULL,
				position int(11) NULL,
				active boolean NULL,
				related_posts varchar(255) NULL,
				related_products varchar(255) NULL,
				PRIMARY KEY(id_cs_blog_post,id_shop)
				)';
		Db::getInstance()->execute($sql);
		
		// Table post_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_lang';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_post_lang(
				id_cs_blog_post int(11) NOT NULL AUTO_INCREMENT,
				id_lang int(11) NOT NULL,
				id_shop int(11) NOT NULL,
				name nvarchar(2000) NOT NULL,
				description_short text NULL,
				description text NULL,
				meta_title nvarchar(500) NULL,
				meta_description nvarchar(1000) NULL,
				meta_keywords nvarchar(1000) NULL,
				link_rewrite nvarchar(1000) NOT NULL,
				PRIMARY KEY(id_cs_blog_post, id_lang,id_shop)
				)';
		Db::getInstance()->execute($sql);
		
		/*Table comment and comment_lang*/
		// Table comment
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_comment';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_comment(
				id_cs_blog_comment int(11) NOT NULL AUTO_INCREMENT,
				id_cs_blog_post int(11) NOT NULL,
				id_shop int(11) NOT NULL,
				active boolean NOT NULL,
				author_name nvarchar(100) NULL,
				author_email nvarchar(100) NULL,
				date_add datetime NULL,
				PRIMARY KEY(id_cs_blog_comment)
				)';
		Db::getInstance()->execute($sql);		
		
		// Table comment_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_comment_lang';
		Db::getInstance()->execute($sql);
		
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_comment_lang(
				id_cs_blog_comment int(11) NOT NULL AUTO_INCREMENT,
				id_lang int(11) NOT NULL,
				title nvarchar(500) NOT NULL,
				content text NOT NULL,
				PRIMARY KEY(id_cs_blog_comment, id_lang)
				)';
		Db::getInstance()->execute($sql);		
		
		/* Table tag */
		
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_tag';
		Db::getInstance()->execute($sql);
		$sql = "CREATE TABLE IF NOT EXISTS "._DB_PREFIX_."cs_blog_post_tag(
				id_cs_blog_post int(11) NOT NULL,
				id_cs_blog_tag int(11) NOT NULL,
				PRIMARY KEY (id_cs_blog_post, id_cs_blog_tag))";
		Db::getInstance()->execute($sql);
		
		
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_tag';
		Db::getInstance()->execute($sql);
		$sql = 'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'cs_blog_tag(
				id_cs_blog_tag int(11) NOT NULL AUTO_INCREMENT,
				id_lang int(11) NOT NULL,
				name nvarchar(500) NOT NULL,
				PRIMARY KEY(id_cs_blog_tag))';
		Db::getInstance()->execute($sql);		
		$this->init_data();
		return true;
	}
	function deleteImage()
	{
		#category
		$save_path = _PS_MODULE_DIR_.'csblog/media/categories/';
		
		#folder src
		$images = glob($save_path.'src/'.'*.'.$this->imageType.'');
		foreach($images as $image)
		{
			unlink($save_path.'src/'.basename($image));
		}
		
		#folder cache
		$images = glob($save_path.'cache/'.'*.'.$this->imageType.'');
		foreach($images as $image)
		{
			unlink($save_path.'cache/'.basename($image));
		}
		
		#post
		$save_path = _PS_MODULE_DIR_.'csblog/media/posts/';
		
		#folder src
		$images = glob($save_path.'src/'.'*.'.$this->imageType.'');
		foreach($images as $image)
		{
			unlink($save_path.'src/'.basename($image));
		}
		
		#folder cache
		$images = glob($save_path.'cache/'.'*.'.$this->imageType.'');
		foreach($images as $image)
		{
			unlink($save_path.'cache/'.basename($image));
		}
		
	}
	
	function installConfiguration($id_shop=null)
	{
		Configuration::updateValue('CS_SHOW_BLOCK_CATEGORY', 1,false,null,$id_shop);
		Configuration::updateValue('CS_DISPLAY_CATEGORY', 'displayLeftColumn',false,null,$id_shop);
		Configuration::updateValue('BLOCK_CATEG_DHTML', 1,false,null,$id_shop);
		Configuration::updateValue('CS_SHOW_BLOCK_TAG', 1,false,null,$id_shop);
		Configuration::updateValue('CS_DISPLAY_TAG', 'displayLeftColumn',false,null,$id_shop);
		Configuration::updateValue('CS_NUMBER_TAG_DISPLAYED', 10,false,null,$id_shop);
		Configuration::updateValue('CS_COMMENTS_VALIDATE', 0,false,null,$id_shop);	
		Configuration::updateValue('CS_ALLOW_COMMENTS_BY_GUESTS', '1',false,null,$id_shop);
		Configuration::updateValue('CS_DISPLAY_CAPTCHA', '1',false,null,$id_shop);
		Configuration::updateValue('CS_ALLOW_RELATED_POSTS', '1',false,null,$id_shop);
		Configuration::updateValue('CS_IMAGE_SIZE_RELATED_POSTS', 'none',false,null,$id_shop);
		Configuration::updateValue('CS_ALLOW_RELATED_PRODUCTS', '1',false,null,$id_shop);
		Configuration::updateValue('CS_IMAGE_SIZE_RELATED_PRODUCT', 'medium_default',false,null,$id_shop);
		Configuration::updateValue('CS_ALLOW_CATEGORY_IMAGE', '1',false,null,$id_shop);
		Configuration::updateValue('CS_ALLOW_CATEGORY_DESCRIPTION', '1',false,null,$id_shop);
		Configuration::updateValue('CS_SHOW_BLOCK_LASTEST', 1,false,null,$id_shop);
		Configuration::updateValue('CS_LASTEST_POST', 'displayLeftColumn',false,null,$id_shop);
		Configuration::updateValue('CS_OP_LASTEST_POST', 5,false,null,$id_shop);
		Configuration::updateValue('CS_TBEP_SHOW', '1',false,null,$id_shop);
		Configuration::updateValue('CS_IMEP_SHOW', 'small',false,null,$id_shop);
		Configuration::updateValue('CS_IMIPD_SHOW', 'large',false,null,$id_shop);
		Configuration::updateValue('CS_IMEP_LIST_SHOW', 'medium',false,null,$id_shop);
		Configuration::updateValue('CS_COLP_MAXIMUM', 150,false,null,$id_shop);
		Configuration::updateValue('CS_B_SUMMARY_CHARACTER_COUNT', 250,false,null,$id_shop);
		Configuration::updateValue('CS_POSTS_PER_PAGE', 10,false,null,$id_shop);
		Configuration::updateValue('CS_NUM_RELATED_POSTS', 5,false,null,$id_shop);
		Configuration::updateValue('CS_NUM_RELATED_PRODUCTS', 5,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_SMALL_SIZE', 100,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_SMALL_H_SIZE', 100,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_MEDIUM_SIZE', 124,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_MEDIUM_H_SIZE', 124,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_LARGE_SIZE', 350,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_LARGE_H_SIZE', 350,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_CATEGORY_SIZE', 500,false,null,$id_shop);
		Configuration::updateValue('CS_IMG_CATEGORY_H_SIZE', 150,false,null,$id_shop);
		Configuration::updateValue('CS_SHOW_BLOCK_CURRENT_COMMENT', 1,false,null,$id_shop);
		Configuration::updateValue('CS_POSITION_CURRENT_COMMENT', 'displayLeftColumn',false,null,$id_shop);
		Configuration::updateValue('CS_NUMBER_CURRENT_COMMENT', 5,false,null,$id_shop);
		Configuration::updateValue('CS_COMMENT_SIZE_IMAGE_POST', 'none',false,null,$id_shop);
		Configuration::updateValue('CS_NUMBER_COMMENT_DETAIL', 5,false,null,$id_shop);
		Configuration::updateValue('CATEGORY_RSS_NUMBER', 10,false,null,$id_shop);
		Configuration::updateValue('BLOCK_CATEG_DISPLAY_PAGE',1,false,null,$id_shop);
		Configuration::updateValue('CS_TAG_DISPLAY_PAGE',1,false,null,$id_shop);
		Configuration::updateValue('LASTEST_POST_DISPLAY_PAGE',1,false,null,$id_shop);
		Configuration::updateValue('CURRENT_COMMENT_DISPLAY_PAGE',1,false,null,$id_shop);
	}
	public function init_data()
	{
		$id_en = Language::getIdByIso('en');
		$id_fr = Language::getIdByIso('fr');
		if ($id_fr == '' || !$id_fr)
			$id_fr = 2;
		$id_shop = Configuration::get('PS_SHOP_DEFAULT');
		$timezone = date_default_timezone_get();
		$post_description='<p>Donec mi risus, blandit et mattis nec, venenatis id nisi. Nulla neque sollicitudin vitae nulla. liquam rutrum, ipsum non dignissim accumsan ornare velit odio vel justo. Vestibulum odio risus, volutpat at imperdiet Aenean ut interdum metus.</p>
		<p><em>Donec mi risus, blandit et mattis nec, venenatis id nisi. Nulla neque purus, venenatis egestas viverra a, sollicitudin vitae nulla. Aliquam rutrum, ipsum non dignissim accumsan, ipsum erat gravida tellus</em></p>
		<p>Donec mi risus, blandit et mattis nec, venenatis id nisi. Nulla neque sollicitudin vitae nulla. liquam rutrum, ipsum non dignissim accumsan ornare velit odio vel justo. Vestibulum odio risus, volutpat at imperdiet</p>
		<p><em>Donec mi risus, blandit et mattis nec, venenatis id nisi. Nulla neque purus, venenatis egestas viverra a, sollicitudin vitae nulla. Aliquam rutrum, ipsum non dignissim accumsan, ipsum erat gravida tellus</em></p>
		<p>Aliquam nec facilisis libero. Phasellus ac arcu ante. Donec accumsan tempus dignissim. Integer nulla felis, feugiat nec auctor non, ornare sit amet mi. Aenean nec tempus nisl. Maecenas facilisis massa quis purus feugiat suscipit. Praesent sed odio ut purus condimentum mattis. Nunc convallis, orci ac placerat ornare, risus dolor dictum libero, vel scelerisque odio enim nec felis. Curabitur fringilla eros nec</p>
		<p><em>Aenean ut interdum metus. Vestibulum a mauris quis ligula vehicula vehicula id vitae lacus. In suscipit venenatis odio id euismod. Ut sit amet lacus tortor, non tincidunt libero. Donec eu ipsum ante. </em></p>
		<p>Pellentesque ultricies urna ut consectetur semper. Duis molestie lobortis lorem nec laoreet. Vivamus a felis sed nibh vehicula ornare quis condimentum felis. Pellentesque non mattis tortor, vel suscipit tellus. Mauris metus risus, aliquet id viverra et, elementum vel magna. Nam ultrices nibh et est blandit, a auctor nibh luctus. Sed vitae elit sit amet dolor vestibulum laoreet eget nec risus. Vestibulum malesuada a nisl id porttitor Proin rhoncus vel turpis vel commodo. Nullam sit amet libero non augue dignissim sollicitudin. Maecenas justo nulla, feugiat eu massa sit amet, luctus blandit purus. Vestibulum adipiscing libero quam, ut convallis sem interdum ac. Donec sit amet tellus sed augue porttitor mollis in eu leo. Fusce lacinia, urna quis volutpat condimentum, turpis ipsum posuere ante, ut porttitor sem odio id enim</p>';
		$description_short = '<p>Aliquam nec facilisis libero. Phasellus ac arcu ante. Donec accumsan tempusdigni Integer nulla felis, feugiat nec auctor non, ornare sit amet mi. Aenean nec tempus nisl. Maecenas facilisis massa quis purus feugiat suscipit. Praesent sed odio ut</p>
		<p>Nunc convallis orci ac placerat ornare, risus dolor dictum libero, vel sceleris</p>
		<p><em>Aenean ut interdum metus. Vestibulum a mauris quis ligula vehicula vehicula vitae lacus. In suscipit venenatis odio id euismod. Ut sit amet lacus tortor, non tincidunt l ibero. Donec eu ipsum ante.</em></p>';
		$cat_description = '';
		
		/*insert db default*/
		if(!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_category` (`id_cs_blog_category`, `category_parent`, `level_depth`, `id_shop_default`, `date_add`, `active`, `position`, `allow_comment`) VALUES 
			(2, 1, 0, 1, "'.$timezone.'", 1, 1, 1),
			(3, 1, 1, 1, "'.$timezone.'", 1, 2, 1),
			(4, 1, 1, 1, "'.$timezone.'", 1, 3, 1)
			;'
			) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_category_lang` (`id_cs_blog_category`, `id_lang`, `id_shop`, `name`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `link_rewrite`) VALUES 
			(2, "'.$id_en.'", "'.$id_shop.'", "Category 1", "'.$cat_description.'", "", "", "", "category-1"),
			(2, "'.$id_fr.'", "'.$id_shop.'", "Category 1", "'.$cat_description.'", "", "", "", "category-1"),
			(3, "'.$id_en.'", "'.$id_shop.'", "Category 2", "'.$cat_description.'", "", "", "", "category-2"),
			(3, "'.$id_fr.'", "'.$id_shop.'", "Category 2", "'.$cat_description.'", "", "", "", "category-2"),
			(4, "'.$id_en.'", "'.$id_shop.'", "Category 3", "'.$cat_description.'", "", "", "", "category-3"),
			(4, "'.$id_fr.'", "'.$id_shop.'", "Category 3", "'.$cat_description.'", "", "", "", "category-3")
			;'
			) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_category_shop` (`id_cs_blog_category`, `id_shop`, `position`) VALUES 
			(2, "'.$id_shop.'", 1),
			(3, "'.$id_shop.'", 2),
			(4, "'.$id_shop.'", 3)
			;'
			) OR
			
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_category_post` (`id_cs_blog_category`, `id_cs_blog_post`) VALUES 
			(2, 1),
			(2, 2),
			(2, 3),
			(3, 1),
			(3, 2),
			(3, 3),
			(4, 1),
			(4, 2),
			(4, 3);'
			) OR
			
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_comment` (`id_cs_blog_comment`, `id_cs_blog_post`, `id_shop`, `active`, `author_name`, `author_email`, `date_add`) VALUES 
			(1, 2, "'.$id_shop.'", 1, "UserDemo", "demo@gmail.com", "'.$timezone.'"),
			(2, 2, "'.$id_shop.'", 1, "UserDemo", "demo@gmail.com", "'.$timezone.'")
			;'
			) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_comment_lang` (`id_cs_blog_comment`, `id_lang`, `title`, `content`) VALUES 
			(1, "'.$id_en.'", "Title content", "Nunc consequat auctor neque, ut laoreet augue rhoncus viverra. Maecenas consequat, augue at euismod quam eros egestas magna, laoreet lobortis odio mauris et sem. Cras pharetra dui sodales venenatis consequat. Suspendisse eget dictum tellus"),
			(1, "'.$id_fr.'", "Title content", "Nunc consequat auctor neque, ut laoreet augue rhoncus viverra. Maecenas consequat, augue at euismod quam eros egestas magna, laoreet lobortis odio mauris et sem. Cras pharetra dui sodales venenatis consequat. Suspendisse eget dictum tellus"),
			(2, "'.$id_en.'",  "Title content", "Nunc consequat auctor neque, ut laoreet augue rhoncus viverra. Maecenas consequat, augue at euismod quam eros egestas magna, laoreet lobortis odio mauris et sem. Cras pharetra dui sodales venenatis consequat. Suspendisse eget dictum tellus"),
			(2, "'.$id_fr.'", "Title content", "Nunc consequat auctor neque, ut laoreet augue rhoncus viverra. Maecenas consequat, augue at euismod quam eros egestas magna, laoreet lobortis odio mauris et sem. Cras pharetra dui sodales venenatis consequat. Suspendisse eget dictum tellus")
		;'
		)OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_post` (`id_cs_blog_post`, `id_cs_blog_category`, `id_shop_default`, `date_add`, `position`, `allow_comment`, `active`, `author`, `id_related_posts`, `name_related_posts`, `id_related_products`, `name_related_products`) VALUES
			(1, 2, 1, "'.$timezone.'", 1, 1, 1, "1", "", "", "", ""),
			(2, 2, 1, "'.$timezone.'", 1, 1, 1, "1", "", "", "1-", "Coalesce: Functioning On Impatience T-Shirt¤"),
			(3, 2, 1, "'.$timezone.'", 2, 1, 1, "1", "1-2-", "At vero eos et accusamus et iusto odio dignissimos (id - 1)¤Ducimus qui blanditiis praesentium voluptatum (id - 2)¤", "", "")
		;'
		) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_post_lang` (`id_cs_blog_post`, `id_lang`, `id_shop`, `name`, `description_short`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `link_rewrite`) VALUES
			(1, "'.$id_en.'", "'.$id_shop.'", "post 1", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-1"),
			(1, "'.$id_fr.'", "'.$id_shop.'", "post 1", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-1"),
			(2, "'.$id_en.'", "'.$id_shop.'", "post 2", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-2"),
			(2, "'.$id_fr.'", "'.$id_shop.'", "post 2", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-2"),
			(3, "'.$id_en.'", "'.$id_shop.'", "post 3", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-3"),
			(3, "'.$id_fr.'", "'.$id_shop.'", "post 3", "'.pSQL($description_short).'", "'.pSQL($post_description).'", "", "", "", "post-3")
		;'
		) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_post_shop` (`id_cs_blog_post`, `id_shop`, `id_cs_blog_category`, `id_shop_default`, `date_add`, `position`, `active`, `related_posts`, `related_products`) VALUES
			(1, "'.$id_shop.'", 0, 0, NULL, 1, 1, NULL, NULL),
			(2, "'.$id_shop.'", 0, 0, NULL, 1, 1, NULL, NULL),
			(3, "'.$id_shop.'", 0, 0, NULL, 2, 1, NULL, NULL)
		;'
		) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_post_tag` (`id_cs_blog_post`, `id_cs_blog_tag`) VALUES
			(1, 1),
			(1, 2),
			(2, 3)
		;'
		) OR
		!Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'cs_blog_tag` (`id_cs_blog_tag`, `id_lang`, `name`) VALUES
			(1, "'.$id_en.'", "tag 1"),
			(2, "'.$id_fr.'", "tag 1"),
			(3, "'.$id_en.'", "tag 2"),
			(4, "'.$id_fr.'", "tag 2"),
			(5, "'.$id_en.'", "tag 3"),
			(6, "'.$id_fr.'", "tag 3")
		;'
		)
		)
			return false;
		return true;
	}
	
	function install()
	{
		if (!parent::install())
			return false;
		
		foreach (Shop::getContextListShopID() as $id_shop)
		{
			$this->installConfiguration($id_shop);
		}
		
		
		/*Install Tab*/
		if (!$this->existsTab('AdminCSBlog'))
		{
			if(!$this->addTab('CS Blog', 'AdminCSBlog', 0))
				return false;
		}
		if (!$this->existsTab('AdminCSCategory'))
		{
			if(!$this->addTab('Blog Category', 'AdminCSCategory', $this->getIdTabFromClassName('AdminCSBlog')))
				return false;
		}
		
		if (!$this->existsTab('AdminCSPost'))
		{
			if(!$this->addTab('Blog Post', 'AdminCSPost', $this->getIdTabFromClassName('AdminCSBlog')))
				return false;
		}
		
		if (!$this->existsTab('AdminCSComment'))
		{
			if(!$this->addTab('Blog Comment', 'AdminCSComment', $this->getIdTabFromClassName('AdminCSBlog')))
				return false;
		}
		
		if (!$this->existsTab('AdminCSTags'))
		{
			if(!$this->addTab('Blog Tag', 'AdminCSTags', $this->getIdTabFromClassName('AdminCSBlog')))
				return false;
		}
		
		if (!$this->installDb() || !$this->registerHook('header') || !$this->registerHook('moduleRoutes') || !$this->registerHook('actionShopDataDuplication'))
				return false;
				
		
		foreach ($this->myHookRegister AS $hook){
			if (!$this->registerHook($hook))
				return false;
		}
		$this->deleteImage();
		return true;
	}
	function getIdTabFromClassName($tabName)
	{
		$sql = 'SELECT id_tab FROM '._DB_PREFIX_.'tab WHERE class_name="'.$tabName.'"';
		$tab = Db::getInstance()->getRow($sql);
		return intval($tab['id_tab']);
	}
	private function addTab($tabName, $tabClass , $id_parent)
	{
		$tab = new Tab();	
		$langs = Language::getLanguages();
		foreach ($langs as $lang) {
			$tab->name[$lang['id_lang']] = $tabName;
		}
		$tab->class_name = $tabClass;
		$tab->module = $this->name;
		$tab->id_parent = $id_parent;
		if(!$tab->save())
			return false;
			
		return true;
	}
	/*end install*/
	
	/*uninstall*/
	function uninstallDb()
	{
		// delete table cs_blog_category
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_category_shop
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_shop';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_category_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_lang';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_category_post
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_category_post';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_post
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_post_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_lang';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_post_shop
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_shop';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_comment
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_comment';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_comment_lang
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_comment_lang';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_tag
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_tag';
		Db::getInstance()->execute($sql);
		
		// delete table cs_blog_post_tag
		$sql = 'DROP TABLE IF EXISTS '._DB_PREFIX_.'cs_blog_post_tag';
		Db::getInstance()->execute($sql);
		
		
		return true;
	}
	function uninstallConfiguration()
	{
		Configuration::deleteByName('CS_SHOW_BLOCK_CATEGORY');
		Configuration::deleteByName('CS_DISPLAY_CATEGORY');
		Configuration::deleteByName('BLOCK_CATEG_DHTML');
		Configuration::deleteByName('CS_SHOW_BLOCK_TAG');
		Configuration::deleteByName('CS_DISPLAY_TAG'); 
		Configuration::deleteByName('CS_NUMBER_TAG_DISPLAYED');
		Configuration::deleteByName('CS_COMMENTS_VALIDATE');		
		Configuration::deleteByName('CS_ALLOW_COMMENTS_BY_GUESTS');
		Configuration::deleteByName('CS_DISPLAY_CAPTCHA');
		Configuration::deleteByName('CS_ALLOW_RELATED_POSTS');
		Configuration::deleteByName('CS_IMAGE_SIZE_RELATED_POSTS');
		Configuration::deleteByName('CS_ALLOW_RELATED_PRODUCTS');
		Configuration::deleteByName('CS_IMAGE_SIZE_RELATED_PRODUCT');
		Configuration::deleteByName('CS_ALLOW_CATEGORY_IMAGE');
		Configuration::deleteByName('CS_ALLOW_CATEGORY_DESCRIPTION');
		Configuration::deleteByName('CS_SHOW_BLOCK_LASTEST');
		Configuration::deleteByName('CS_LASTEST_POST');
		Configuration::deleteByName('CS_OP_LASTEST_POST');
		Configuration::deleteByName('CS_TBEP_SHOW');
		Configuration::deleteByName('CS_IMEP_SHOW');
		Configuration::deleteByName('CS_IMIPD_SHOW');
		Configuration::deleteByName('CS_IMEP_LIST_SHOW');
		Configuration::deleteByName('CS_COLP_MAXIMUM');
		Configuration::deleteByName('CS_B_SUMMARY_CHARACTER_COUNT');
		Configuration::deleteByName('CS_POSTS_PER_PAGE');
		Configuration::deleteByName('CS_NUM_RELATED_POSTS');
		Configuration::deleteByName('CS_NUM_RELATED_PRODUCTS');
		Configuration::deleteByName('CS_IMG_SMALL_SIZE');
		Configuration::deleteByName('CS_IMG_SMALL_H_SIZE');
		Configuration::deleteByName('CS_IMG_MEDIUM_SIZE');
		Configuration::deleteByName('CS_IMG_MEDIUM_H_SIZE');
		Configuration::deleteByName('CS_IMG_LARGE_SIZE');
		Configuration::deleteByName('CS_IMG_LARGE_H_SIZE');
		Configuration::deleteByName('CS_IMG_CATEGORY_SIZE');
		Configuration::deleteByName('CS_IMG_CATEGORY_H_SIZE');
		Configuration::deleteByName('CS_SHOW_BLOCK_CURRENT_COMMENT');
		Configuration::deleteByName('CS_POSITION_CURRENT_COMMENT');
		Configuration::deleteByName('CS_NUMBER_CURRENT_COMMENT');
		Configuration::deleteByName('CS_COMMENT_SIZE_IMAGE_POST');
		Configuration::deleteByName('CS_NUMBER_COMMENT_DETAIL');
		Configuration::deleteByName('BLOCK_CATEG_DISPLAY_PAGE');
		Configuration::deleteByName('CS_TAG_DISPLAY_PAGE');
		Configuration::deleteByName('LASTEST_POST_DISPLAY_PAGE');
		Configuration::deleteByName('CURRENT_COMMENT_DISPLAY_PAGE');
		
	}
	private function removeTab($tabClass)
	{
		$idTab = Tab::getIdFromClassName($tabClass);
		if($idTab != 0)
		{
		  $tab = new Tab($idTab);
		  $tab->delete();
		  return true;
		}
		return false;
	}
	function uninstall()
	{
		if (!parent::uninstall())
			return false;
			
		$this->uninstallConfiguration();
		
		if(!$this->removeTab('AdminCSBlog'))
			return false;
		if(!$this->removeTab('AdminCSCategory'))
			return false;
		if(!$this->removeTab('AdminCSPost'))
			return false;
		if(!$this->removeTab('AdminCSComment'))
			return false;
		if(!$this->removeTab('AdminCSTags'))
			return false;
	
		if(!$this->uninstallDb())
			return false;
		$this->deleteImage();
		return true;
	}
	/*end uninstall*/
	
	/*get content hook leftcolumn*/
	
	
	public function getCategories($id_lang,$id_shop)
	{
		$sql = 'SELECT * FROM '._DB_PREFIX_.'cs_blog_category a
				LEFT JOIN '._DB_PREFIX_.'cs_blog_category_lang b
				ON a.id_cs_blog_category = b.id_cs_blog_category AND b.id_shop = '.$id_shop.' AND b.id_lang='.$id_lang.'
				LEFT JOIN '._DB_PREFIX_.'cs_blog_category_shop c
				ON ( a.id_cs_blog_category = c.id_cs_blog_category AND c.id_shop = '.$id_shop.')
				WHERE a.active=1 AND b.id_lang='.$id_lang.' AND c.id_shop = '.$id_shop.'
				ORDER BY c.position ASC
				';
		$data = Db::getInstance()->ExecuteS($sql);
		
		return $data;
	}
	
	
	public function imageResizeThumb($src_path,$des_path,$new_width,$new_height)
	{
		ImageManager::resize($src_path, $des_path, $new_width, $new_height);
	}
	
	function _postProcess()
	{
		global $currentIndex;
		$id_lang = $this->context->language->id;
		if (Tools::getValue('submitConfiguration'))
		{
			$CS_COMMENTS_VALIDATE = Tools::getValue('CS_COMMENTS_VALIDATE');
			$CS_ALLOW_COMMENTS_BY_GUESTS = Tools::getValue('CS_ALLOW_COMMENTS_BY_GUESTS');
			$CS_DISPLAY_CAPTCHA = Tools::getValue('CS_DISPLAY_CAPTCHA');
			$CS_ALLOW_RELATED_POSTS = Tools::getValue('CS_ALLOW_RELATED_POSTS');
			$CS_ALLOW_RELATED_PRODUCTS = Tools::getValue('CS_ALLOW_RELATED_PRODUCTS');
			$CS_ALLOW_CATEGORY_IMAGE = Tools::getValue('CS_ALLOW_CATEGORY_IMAGE');
			$CS_ALLOW_CATEGORY_DESCRIPTION = Tools::getValue('CS_ALLOW_CATEGORY_DESCRIPTION');
			$CS_SHOW_BLOCK_CATEGORY = Tools::getValue('CS_SHOW_BLOCK_CATEGORY');
			$CS_DISPLAY_CATEGORY = Tools::getValue('CS_DISPLAY_CATEGORY'); 
			$BLOCK_CATEG_DHTML = Tools::getValue('BLOCK_CATEG_DHTML');
			$CS_SHOW_BLOCK_TAG = Tools::getValue('CS_SHOW_BLOCK_TAG');
			$CS_DISPLAY_TAG = Tools::getValue('CS_DISPLAY_TAG');
			$CS_NUMBER_TAG_DISPLAYED = Tools::getValue('CS_NUMBER_TAG_DISPLAYED');
			$CS_OP_LASTEST_POST = Tools::getValue('CS_OP_LASTEST_POST');
			$CS_SHOW_BLOCK_LASTEST = Tools::getValue('CS_SHOW_BLOCK_LASTEST');
			$CS_LASTEST_POST = Tools::getValue('CS_LASTEST_POST'); 
			$CS_TBEP_SHOW = Tools::getValue('CS_TBEP_SHOW');
			$CS_IMEP_SHOW = Tools::getValue('CS_IMEP_SHOW');
			$CS_IMIPD_SHOW = Tools::getValue('CS_IMIPD_SHOW');
			$CS_IMEP_LIST_SHOW = Tools::getValue('CS_IMEP_LIST_SHOW');
			$CS_COLP_MAXIMUM = Tools::getValue('CS_COLP_MAXIMUM');
			$CS_B_SUMMARY_CHARACTER_COUNT = Tools::getValue('CS_B_SUMMARY_CHARACTER_COUNT');
			$CS_POSTS_PER_PAGE = Tools::getValue('CS_POSTS_PER_PAGE');
			$CS_NUM_RELATED_POSTS = Tools::getValue('CS_NUM_RELATED_POSTS');
			$CS_NUM_RELATED_PRODUCTS = Tools::getValue('CS_NUM_RELATED_PRODUCTS');
			$CS_IMG_SMALL_SIZE = Tools::getValue('CS_IMG_SMALL_SIZE');
			$CS_IMG_SMALL_H_SIZE = Tools::getValue('CS_IMG_SMALL_H_SIZE');
			$CS_IMG_MEDIUM_SIZE = Tools::getValue('CS_IMG_MEDIUM_SIZE');
			$CS_IMG_MEDIUM_H_SIZE = Tools::getValue('CS_IMG_MEDIUM_H_SIZE');
			$CS_IMG_LARGE_SIZE = Tools::getValue('CS_IMG_LARGE_SIZE');
			$CS_IMG_LARGE_H_SIZE = Tools::getValue('CS_IMG_LARGE_H_SIZE');
			$CS_IMG_CATEGORY_SIZE = Tools::getValue('CS_IMG_CATEGORY_SIZE');
			$CS_IMG_CATEGORY_H_SIZE = Tools::getValue('CS_IMG_CATEGORY_H_SIZE');
			$CS_SHOW_BLOCK_CURRENT_COMMENT = Tools::getValue('CS_SHOW_BLOCK_CURRENT_COMMENT');
			$CS_POSITION_CURRENT_COMMENT = Tools::getValue('CS_POSITION_CURRENT_COMMENT');
			$CS_NUMBER_CURRENT_COMMENT = Tools::getValue('CS_NUMBER_CURRENT_COMMENT');
			$CS_COMMENT_SIZE_IMAGE_POST = Tools::getValue('CS_COMMENT_SIZE_IMAGE_POST');
			$CS_NUMBER_COMMENT_DETAIL = Tools::getValue('CS_NUMBER_COMMENT_DETAIL');
			$CS_IMAGE_SIZE_RELATED_POSTS = Tools::getValue('CS_IMAGE_SIZE_RELATED_POSTS');
			$CS_IMAGE_SIZE_RELATED_PRODUCT = Tools::getValue('CS_IMAGE_SIZE_RELATED_PRODUCT');
			$CATEGORY_RSS_NUMBER = Tools::getValue('CATEGORY_RSS_NUMBER');
			$BLOCK_CATEG_DISPLAY_PAGE = Tools::getValue('BLOCK_CATEG_DISPLAY_PAGE');
			$CS_TAG_DISPLAY_PAGE = Tools::getValue('CS_TAG_DISPLAY_PAGE');
			$LASTEST_POST_DISPLAY_PAGE = Tools::getValue('LASTEST_POST_DISPLAY_PAGE');
			$CURRENT_COMMENT_DISPLAY_PAGE = Tools::getValue('CURRENT_COMMENT_DISPLAY_PAGE');
			//general image size
			$src_path = _PS_MODULE_DIR_.'csblog/media/posts/src/';
			$des_path = _PS_MODULE_DIR_.'csblog/media/posts/cache/';
			$postObj = new CSBLPost();
			$src_path_cat = _PS_MODULE_DIR_.'csblog/media/categories/src/';
			$des_path_cat = _PS_MODULE_DIR_.'csblog/media/categories/cache/';
			$catObj = new CSPLCategory();
			foreach (Shop::getContextListShopID() as $id_shop)
			{
				$cats = $catObj->getIdAllCat($id_lang, $id_shop);
				$posts = $postObj->getIdAllPost($id_lang, $id_shop);
				
				if($CS_IMG_SMALL_SIZE != Configuration::get('CS_IMG_SMALL_SIZE') 
					OR $CS_IMG_SMALL_H_SIZE != Configuration::get('CS_IMG_SMALL_H_SIZE') 
					OR $CS_IMG_SMALL_SIZE != Configuration::get('CS_IMG_MEDIUM_SIZE') 
					OR $CS_IMG_SMALL_H_SIZE != Configuration::get('CS_IMG_MEDIUM_H_SIZE') 
					OR $CS_IMG_SMALL_SIZE != Configuration::get('CS_IMG_LARGE_SIZE') 
					OR $CS_IMG_SMALL_H_SIZE != Configuration::get('CS_IMG_LARGE_H_SIZE'))
				{
					
					foreach($posts as $post)
					{
						$id = $post['id_cs_blog_post'];
						if($CS_IMG_SMALL_SIZE != Configuration::get('CS_IMG_SMALL_SIZE') 
						OR $CS_IMG_SMALL_H_SIZE != Configuration::get('CS_IMG_SMALL_H_SIZE'))
						{
								$this->imageResizeThumb($src_path.$id.'.'.$this->imageType, $des_path.$id.'_'.$id_shop.'_small.'.$this->imageType, $CS_IMG_SMALL_SIZE,$CS_IMG_SMALL_H_SIZE);
						}
						
						if($CS_IMG_MEDIUM_SIZE != Configuration::get('CS_IMG_MEDIUM_SIZE') 
						OR $CS_IMG_MEDIUM_H_SIZE != Configuration::get('CS_IMG_MEDIUM_H_SIZE'))
						{
							$this->imageResizeThumb($src_path.$id.'.'.$this->imageType, $des_path.$id.'_'.$id_shop.'_medium.'.$this->imageType, $CS_IMG_MEDIUM_SIZE,$CS_IMG_MEDIUM_H_SIZE);
						}
						
						if($CS_IMG_LARGE_SIZE != Configuration::get('CS_IMG_LARGE_SIZE') 
						OR $CS_IMG_LARGE_H_SIZE != Configuration::get('CS_IMG_LARGE_H_SIZE'))
						{
							$this->imageResizeThumb($src_path.$id.'.'.$this->imageType, $des_path.$id.'_'.$id_shop.'_large.'.$this->imageType, $CS_IMG_LARGE_SIZE,$CS_IMG_LARGE_H_SIZE);
						}
					}
				}
				
				
				
				if($CS_IMG_CATEGORY_SIZE != Configuration::get('CS_IMG_CATEGORY_SIZE') OR $CS_IMG_CATEGORY_H_SIZE != Configuration::get('CS_IMG_CATEGORY_H_SIZE')) 
				{
					foreach($cats as $cat)
					{
						$id = $cat['id_cs_blog_category'];
							$this->imageResizeThumb($src_path_cat.$id.'.'.$this->imageType, $des_path_cat.$id.'_'.$id_shop.'_category.'.$this->imageType, $CS_IMG_CATEGORY_SIZE,$CS_IMG_CATEGORY_H_SIZE);
					}
				}
			}
			
			//update config other
			foreach (Shop::getContextListShopID() as $id_shop)
			{
				Configuration::updateValue('CS_COMMENTS_VALIDATE', $CS_COMMENTS_VALIDATE,false,null,$id_shop);
				Configuration::updateValue('CS_ALLOW_COMMENTS_BY_GUESTS', $CS_ALLOW_COMMENTS_BY_GUESTS,false,null,$id_shop);
				Configuration::updateValue('CS_DISPLAY_CAPTCHA', $CS_DISPLAY_CAPTCHA,false,null,$id_shop);
				Configuration::updateValue('CS_ALLOW_RELATED_POSTS', $CS_ALLOW_RELATED_POSTS,false,null,$id_shop);
				Configuration::updateValue('CS_ALLOW_RELATED_PRODUCTS', $CS_ALLOW_RELATED_PRODUCTS,false,null,$id_shop);
				Configuration::updateValue('CS_ALLOW_CATEGORY_IMAGE', $CS_ALLOW_CATEGORY_IMAGE,false,null,$id_shop);		
				Configuration::updateValue('CS_ALLOW_CATEGORY_DESCRIPTION', $CS_ALLOW_CATEGORY_DESCRIPTION,false,null,$id_shop);		
				Configuration::updateValue('CS_SHOW_BLOCK_CATEGORY', $CS_SHOW_BLOCK_CATEGORY,false,null,$id_shop);
				Configuration::updateValue('CS_DISPLAY_CATEGORY', $CS_DISPLAY_CATEGORY,false,null,$id_shop);
				Configuration::updateValue('BLOCK_CATEG_DHTML', $BLOCK_CATEG_DHTML,false,null,$id_shop);
				Configuration::updateValue('CS_SHOW_BLOCK_TAG', $CS_SHOW_BLOCK_TAG,false,null,$id_shop);
				Configuration::updateValue('CS_DISPLAY_TAG', $CS_DISPLAY_TAG,false,null,$id_shop);
				Configuration::updateValue('CS_SHOW_BLOCK_LASTEST', $CS_SHOW_BLOCK_LASTEST,false,null,$id_shop);
				Configuration::updateValue('CS_LASTEST_POST', $CS_LASTEST_POST,false,null,$id_shop);
				Configuration::updateValue('CS_TBEP_SHOW', $CS_TBEP_SHOW,false,null,$id_shop);
				Configuration::updateValue('CS_IMEP_LIST_SHOW', $CS_IMEP_LIST_SHOW,false,null,$id_shop);
				Configuration::updateValue('CS_IMEP_SHOW', $CS_IMEP_SHOW,false,null,$id_shop);
				Configuration::updateValue('CS_IMIPD_SHOW', $CS_IMIPD_SHOW,false,null,$id_shop);
				Configuration::updateValue('CS_SHOW_BLOCK_CURRENT_COMMENT', $CS_SHOW_BLOCK_CURRENT_COMMENT,false,null,$id_shop);
				Configuration::updateValue('CS_POSITION_CURRENT_COMMENT', $CS_POSITION_CURRENT_COMMENT,false,null,$id_shop);
				Configuration::updateValue('CS_COMMENT_SIZE_IMAGE_POST', $CS_COMMENT_SIZE_IMAGE_POST,false,null,$id_shop);
				Configuration::updateValue('CS_IMAGE_SIZE_RELATED_POSTS', $CS_IMAGE_SIZE_RELATED_POSTS,false,null,$id_shop);
				Configuration::updateValue('CS_IMAGE_SIZE_RELATED_PRODUCT', $CS_IMAGE_SIZE_RELATED_PRODUCT,false,null,$id_shop);
				Configuration::updateValue('CATEGORY_RSS_NUMBER', $CATEGORY_RSS_NUMBER,false,null,$id_shop);
				Configuration::updateValue('BLOCK_CATEG_DISPLAY_PAGE', $BLOCK_CATEG_DISPLAY_PAGE,false,null,$id_shop);
				Configuration::updateValue('CS_TAG_DISPLAY_PAGE', $CS_TAG_DISPLAY_PAGE,false,null,$id_shop);
				Configuration::updateValue('LASTEST_POST_DISPLAY_PAGE', $LASTEST_POST_DISPLAY_PAGE,false,null,$id_shop);
				Configuration::updateValue('CURRENT_COMMENT_DISPLAY_PAGE', $CURRENT_COMMENT_DISPLAY_PAGE,false,null,$id_shop);
			}
			
			$rs_setting = true;
			
			if ($this->isInt($CS_NUMBER_COMMENT_DETAIL))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_NUMBER_COMMENT_DETAIL', $CS_NUMBER_COMMENT_DETAIL,false,null,$id_shop);
			}
			else
				$rs_setting = false;
				
			if ($this->isInt($CS_NUMBER_TAG_DISPLAYED))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_NUMBER_TAG_DISPLAYED', $CS_NUMBER_TAG_DISPLAYED,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_NUMBER_CURRENT_COMMENT))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_NUMBER_CURRENT_COMMENT', $CS_NUMBER_CURRENT_COMMENT,false,null,$id_shop);
			}
			else
				$rs_setting = false;
				
			if ($this->isInt($CS_OP_LASTEST_POST))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_OP_LASTEST_POST', $CS_OP_LASTEST_POST,false,null,$id_shop);
			}
			else
				$rs_setting = false;	
			
			if ($this->isInt($CS_COLP_MAXIMUM))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_COLP_MAXIMUM', $CS_COLP_MAXIMUM,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_B_SUMMARY_CHARACTER_COUNT))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_B_SUMMARY_CHARACTER_COUNT', $CS_B_SUMMARY_CHARACTER_COUNT,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_POSTS_PER_PAGE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_POSTS_PER_PAGE', $CS_POSTS_PER_PAGE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_NUM_RELATED_POSTS))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_NUM_RELATED_POSTS', $CS_NUM_RELATED_POSTS,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_NUM_RELATED_PRODUCTS))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_NUM_RELATED_PRODUCTS', $CS_NUM_RELATED_PRODUCTS,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			
			if ($this->isInt($CS_IMG_SMALL_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_SMALL_SIZE', $CS_IMG_SMALL_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_SMALL_H_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_SMALL_H_SIZE', $CS_IMG_SMALL_H_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_MEDIUM_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_MEDIUM_SIZE', $CS_IMG_MEDIUM_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_MEDIUM_H_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_MEDIUM_H_SIZE', $CS_IMG_MEDIUM_H_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_LARGE_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_LARGE_SIZE', $CS_IMG_LARGE_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_LARGE_H_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_LARGE_H_SIZE', $CS_IMG_LARGE_H_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CS_IMG_CATEGORY_SIZE))
			{
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_CATEGORY_SIZE', $CS_IMG_CATEGORY_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if ($this->isInt($CATEGORY_RSS_NUMBER))
			{	
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CATEGORY_RSS_NUMBER', $CATEGORY_RSS_NUMBER,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if(Tools::getValue('categoryBox')!='')
			{
				$cat = implode(",", Tools::getValue('categoryBox'));
				foreach (Shop::getContextListShopID() as $id_shop)
				{
					Configuration::updateValue('CATEGORY_RSS', $cat,false,null,$id_shop);
				}
			}
			else
				Configuration::updateValue('CATEGORY_RSS', '',false,null,$id_shop);
				
			if ($this->isInt($CS_IMG_CATEGORY_H_SIZE))
			{	
				foreach (Shop::getContextListShopID() as $id_shop)
					Configuration::updateValue('CS_IMG_CATEGORY_H_SIZE', $CS_IMG_CATEGORY_H_SIZE,false,null,$id_shop);
			}
			else
				$rs_setting = false;
			
			if (!$rs_setting)
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveError');
			else
				Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&saveConfirmation');		
		}
		elseif (Tools::isSubmit('saveConfirmation'))
			$this->_html = $this->displayConfirmation($this->l('Configs updated successfully'));
		elseif (Tools::isSubmit('saveError'))
			$this->_html = $this->displayError($this->l('Configs updated error'));
	}
	public function isInt($value)
	{
		return ((string)(int)$value === (string)$value OR $value === false);
	}
	function getContent()
	{
		$this->_postProcess();
		$this->displayForm();
		return $this->_html;
	}
	public function displayForm()
	{
		$id = (int)Context::getContext()->shop->id;
		$id_shop = $id ? $id: Configuration::get('PS_SHOP_DEFAULT');
		$id_lang = (int)Context::getContext()->language->id;
		$this->_html .= '
			<link href="'.__PS_BASE_URI__.'modules/csblog/css/pladmin.css" rel="stylesheet" type="text/css" media="all" />
			<script type="text/javascript" src="'.__PS_BASE_URI__.'modules/csblog/js/pladmin.js"></script>
			<div class="panel col-lg-12">
			<div class="panel-heading">'.$this->displayName.'</div>
				<div class="productTabs col-lg-2">
							<a class="list-group-item active" id="manager-1" href="javascript:void(0);">'.$this->l('Page Blog List').'</a>
						
							
							<a class="list-group-item active" id="manager-2" href="javascript:void(0);">'.$this->l('Page Blog Detail').'</a>
						
							
							<a class="list-group-item" id="manager-3" href="javascript:void(0);">'.$this->l('Image Setting').'</a>
						
							
							<a class="list-group-item " id="manager-4" href="javascript:void(0);">'.$this->l('Block Blog Categories').'</a>
						
							
							<a class="list-group-item " id="manager-5" href="javascript:void(0);">'.$this->l('Block Blog Tags').'</a>
						
						
							<a class="list-group-item " id="manager-6" href="javascript:void(0);">'.$this->l('Block Lastest Post').'</a>
						
						
							<a class="list-group-item " id="manager-7" href="javascript:void(0);">'.$this->l('Block Current Comments').'</a>
						
						
							<a class="list-group-item " id="manager-8" href="javascript:void(0);">'.$this->l('RSS').'</a>
				</div>
				<div class="panel col-lg-10">
					<form id="plsubmitConfiguration" name="submitConfiguration" method="post" action="">
						<fieldset class="manager-1 tab-manager plblogtabs">
						<h4>'.$this->l('Config page blog list').'</h4>
						
						<div class="form-group">
							<label class="control-label col-lg-3">'.$this->l('Show category image').'</label>
							<div class="col-lg-9">
								<input id="cat_img_on" type="radio" value="1" '.(Configuration::get('CS_ALLOW_CATEGORY_IMAGE',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_ALLOW_CATEGORY_IMAGE" />
								<label class="t" for="cat_img_on">
									<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
								</label>
								<input id="cat_img_off" type="radio" '.(Configuration::get('CS_ALLOW_CATEGORY_IMAGE',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_ALLOW_CATEGORY_IMAGE">
								<label class="t" for="cat_img_off">
									<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
								</label>
								<p class="help-block">'.$this->l('Display or no display image category on post list page.').'</p>
							</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">'.$this->l('Show category description').'</label>
						<div class="col-lg-9">
							<input id="cat_des_on" type="radio" value="1" '.(Configuration::get('CS_ALLOW_CATEGORY_DESCRIPTION',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_ALLOW_CATEGORY_DESCRIPTION" />
							<label class="t" for="cat_des_on">
								<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
							</label>
							<input id="cat_des_off" type="radio" '.(Configuration::get('CS_ALLOW_CATEGORY_DESCRIPTION',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_ALLOW_CATEGORY_DESCRIPTION">
							<label class="t" for="cat_des_off">
								<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
							</label>
							<p class="help-block">'.$this->l('Display or no display description category on post list page.').'</p>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">'.$this->l('Description character number').'</label>
						<div class="col-lg-9">
							<input type="text" size="8" value="'.(Configuration::get('CS_B_SUMMARY_CHARACTER_COUNT',null,null,$id_shop)).'" name="CS_B_SUMMARY_CHARACTER_COUNT" />
							<div style="color:red;">&nbsp;&nbsp;'.Tools::getValue('cs_b_summary_character_count').'</div>
							<p class="help-block">'.$this->l('Description category character number on post list page.').'</p>
						</div>
					</div>	
					
					<div class="form-group">
						<label class="control-label col-lg-3">'.$this->l('Number of post per page').'</label>
						<div class="col-lg-9">
							<input type="text" size="8" value="'.(Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop)).'" name="CS_POSTS_PER_PAGE" />
							<p class="help-block">'.$this->l('Number of post per page is displayed on post list page.').'</p>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-lg-3">'.$this->l('Image size for post list').'</label>
						<div class="col-lg-9">
							<select name="CS_IMEP_LIST_SHOW">
								<option value="small" '.(Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop) == 'small' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Small&nbsp;</option>
								<option value="medium" '.(Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop) == 'medium' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Medium&nbsp;</option>
								<option value="large" '.(Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop) == 'large' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Large&nbsp;</option>
								<option value="none" '.(Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop) == 'none' ? 'selected="selected"' : '').' >&nbsp;&nbsp;-- No image --&nbsp;</option>
							</select>
							<p class="help-block">'.$this->l('Choose image size for each post in list. "No image" is no display image for post list. ').'</p>
						</div>
					</div>
				</fieldset>
				<fieldset class="manager-2 tab-manager plblogtabs" style="display:none;">
				<h4>'.$this->l('Config for comment').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Using captcha').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_DISPLAY_CAPTCHA',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_DISPLAY_CAPTCHA" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_DISPLAY_CAPTCHA',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_DISPLAY_CAPTCHA">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('Using or no captcha for comment.').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('All comments must be validated by an employee').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_COMMENTS_VALIDATE',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_COMMENTS_VALIDATE" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_COMMENTS_VALIDATE',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_COMMENTS_VALIDATE">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('All comments must be validated by an employee').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Allow guest comments').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_ALLOW_COMMENTS_BY_GUESTS',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_ALLOW_COMMENTS_BY_GUESTS" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_ALLOW_COMMENTS_BY_GUESTS',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_ALLOW_COMMENTS_BY_GUESTS">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('Allow or disallow the ability to post comments for unregistered users').'</p>
					</div>
					
					<div id="num_related_posts" style="display:none;">
						<label class="control-label col-lg-3">'.$this->l('Number of comments displayed').'</label>
						<div class="col-lg-9">
							<input type="text" size="8" value="'.(Configuration::get('CS_NUMBER_COMMENT_DETAIL',null,null,$id_shop)).'" name="CS_NUMBER_COMMENT_DETAIL" />
						</div>
					</div>
					<div class="separation"></div>
					<h4>'.$this->l('Related posts').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Show related posts').'</label>
					<div class="col-lg-9">
						<input id="related_posts_on" type="radio" value="1" '.(Configuration::get('CS_ALLOW_RELATED_POSTS',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_ALLOW_RELATED_POSTS" />
						<label class="t" for="related_posts_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="related_posts_off" type="radio" '.(Configuration::get('CS_ALLOW_RELATED_POSTS',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_ALLOW_RELATED_POSTS">
						<label class="t" for="related_posts_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('Display or no related post').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Related posts image size').'</label>
					<div class="col-lg-9">
						<select name="CS_IMAGE_SIZE_RELATED_POSTS">
							<option value="small" '.(Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop) == 'small' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Small&nbsp;</option>
							<option value="medium" '.(Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop) == 'medium' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Medium&nbsp;</option>
							<option value="large" '.(Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop) == 'large' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Large&nbsp;</option>
							<option value="none" '.(Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop) == 'none' ? 'selected="selected"' : '').' >&nbsp;&nbsp;-- No image --&nbsp;</option>
						</select>
						<p class="help-block">'.$this->l('Choose image size for related post image').'</p>
					</div>
					
					<div id="num_related_posts" >
						<label class="control-label col-lg-3">'.$this->l('Number of related posts').'</label>
						<div class="col-lg-9">
							<input type="text" size="8" value="'.(Configuration::get('CS_NUM_RELATED_POSTS',null,null,$id_shop)).'" name="CS_NUM_RELATED_POSTS" />
							<p class="help-block">'.$this->l('Number of related post').'</p>
						</div>
					</div>
					<div class="separation"></div>
					<h4>'.$this->l('Related products').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Show related products').'</label>
					<div class="col-lg-9">
						<input id="related_products_on" type="radio"  value="1" '.(Configuration::get('CS_ALLOW_RELATED_PRODUCTS',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_ALLOW_RELATED_PRODUCTS" />
						<label class="t" for="related_products_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="related_products_off" type="radio" '.(Configuration::get('CS_ALLOW_RELATED_PRODUCTS',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_ALLOW_RELATED_PRODUCTS">
						<label class="t" for="related_products_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('Display or no related product').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Related products image size').'</label>
					<div class="col-lg-9">
						<select name="CS_IMAGE_SIZE_RELATED_PRODUCT">';
							$images = ImageType ::getImagesTypes('products');
							foreach($images as $image)
							{
								$this->_html .= '<option '.($image['name'] == Configuration::get('CS_IMAGE_SIZE_RELATED_PRODUCT',null,null,$id_shop) ? 'selected="selected"' : '').' value="'.$image['name'].'">'.$image['name'].'</option>';
							}
						$this->_html .='</select>
						<p class="help-block">'.$this->l('Choose image size for related products image').'</p>
					</div>
					
					<div id="num_related_products">
						<label class="control-label col-lg-3">'.$this->l('Number of related products').'</label>
						<div class="col-lg-9">
							<input type="text" size="8" value="'.(Configuration::get('CS_NUM_RELATED_PRODUCTS',null,null,$id_shop)).'" name="CS_NUM_RELATED_PRODUCTS" />
							<p class="help-block">'.$this->l('Number of related products').'</p>	
						</div>
						</div>
					<div class="separation"></div>
					<h4>'.$this->l('Other config').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Show tag').'</label>
					<div class="col-lg-9">
						<input id="tbep_on" type="radio" value="1" '.(Configuration::get('CS_TBEP_SHOW',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_TBEP_SHOW" />
						<label class="t" for="tbep_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="tbep_off" type="radio" '.(Configuration::get('CS_TBEP_SHOW',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_TBEP_SHOW">
						<label class="t" for="tbep_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
						<p class="help-block">'.$this->l('Choose status to Allow show tags in post detail').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Main post image size').'</label>
					<div class="col-lg-9">
						<select name="CS_IMIPD_SHOW">
							<option value="small" '.(Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop) == 'small' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Small&nbsp;</option>
							<option value="medium" '.(Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop) == 'medium' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Medium&nbsp;</option>
							<option value="large" '.(Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop) == 'large' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Large&nbsp;</option>
							<option value="none" '.(Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop) == 'none' ? 'selected="selected"' : '').' >&nbsp;&nbsp;-- No image --&nbsp;</option>
						</select>
						<p class="help-block">'.$this->l('Choose image size for main post image').'</p>
					</div>
					</fieldset>
					<fieldset class="manager-3 tab-manager plblogtabs" style="display:none;">
					<h4>'.$this->l('Config image size').'</h4>
					<div class="form-group col-lg-12">
					<label class="control-label col-lg-3">'.$this->l('Post image size small (in px)').'</label>
					<div class="col-lg-9">
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_SMALL_SIZE',null,null,$id_shop)).'" name="CS_IMG_SMALL_SIZE" />
						</div>
						<div class="col-lg-1">x</div>
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_SMALL_H_SIZE',null,null,$id_shop)).'" name="CS_IMG_SMALL_H_SIZE" />
						</div>
						
					</div>
					</div>
					<div class="form-group col-lg-12">
					<label class="control-label col-lg-3">'.$this->l('Post image size medium (in px)').'</label>
					<div class="col-lg-9">
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_MEDIUM_SIZE',null,null,$id_shop)).'" name="CS_IMG_MEDIUM_SIZE" />
						</div>
						<div class="col-lg-1">x</div>
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_MEDIUM_H_SIZE',null,null,$id_shop)).'" name="CS_IMG_MEDIUM_H_SIZE" />
						</div>
					</div>
					</div>
					
					<div class="form-group col-lg-12">
					<label class="control-label col-lg-3">'.$this->l('Post image size large(in px)').'</label>
					<div class="col-lg-9">
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_LARGE_SIZE',null,null,$id_shop)).'" name="CS_IMG_LARGE_SIZE" />
						</div>
						<div class="col-lg-1">x</div>
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_LARGE_H_SIZE',null,null,$id_shop)).'" name="CS_IMG_LARGE_H_SIZE" />
						</div>
					</div>
					</div>
				<div class="form-group col-lg-12">
					<label class="control-label col-lg-3">'.$this->l('Category image size (in px)').'</label>
					<div class="col-lg-9">
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_CATEGORY_SIZE',null,null,$id_shop)).'" name="CS_IMG_CATEGORY_SIZE" />
						</div>
						<div class="col-lg-1">x</div>
						<div class="col-lg-4">
						<input type="text" size="8" value="'.(Configuration::get('CS_IMG_CATEGORY_H_SIZE',null,null,$id_shop)).'" name="CS_IMG_CATEGORY_H_SIZE" />
						</div>
					</div>
				</div>
				</fieldset> 
				
				<fieldset class="manager-4 tab-manager plblogtabs" style="display:none;">
					<h4>'.$this->l('Block categories').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Display block').'</label>
					<div class="col-lg-9">
					<input type="radio" name="CS_SHOW_BLOCK_CATEGORY" value="1" '.(Configuration::get('CS_SHOW_BLOCK_CATEGORY',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="CS_SHOW_BLOCK_CATEGORY" id="dhtml_off" value="0" '.(Configuration::get('CS_SHOW_BLOCK_CATEGORY',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('Display or hide block.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Position display').'</label>
					<div class="col-lg-9">
						<select name="CS_DISPLAY_CATEGORY">';
						foreach($this->myHook as $hook)
						{
							$this->_html .= '<option value="'.$hook.'" '.(Configuration::get('CS_DISPLAY_CATEGORY',null,null,$id_shop) == $hook ? "selected='selected'" : '').'>'.$hook.'</option>';
						}
						$this->_html .= '</select>
						<p class="help-block">'.$this->l('Choose position(hook) for display blog current comment block.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Dynamic').'</label>
					<div class="col-lg-9">
					<input type="radio" name="BLOCK_CATEG_DHTML" value="1" '.(Configuration::get('BLOCK_CATEG_DHTML',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="BLOCK_CATEG_DHTML" id="dhtml_off" value="0" '.(Configuration::get('BLOCK_CATEG_DHTML',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('Activate dynamic (animated) mode for sublevels.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Only display blog page').'</label>
					<div class="col-lg-9">
					<input type="radio" name="BLOCK_CATEG_DISPLAY_PAGE" value="1" '.(Configuration::get('BLOCK_CATEG_DISPLAY_PAGE',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="BLOCK_CATEG_DISPLAY_PAGE" id="dhtml_off" value="0" '.(Configuration::get('BLOCK_CATEG_DISPLAY_PAGE',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('If it is actived, block only display blog page. And contrary, block display all page.').'</p>
					</div>
					
				</fieldset>
				<fieldset class="manager-5 tab-manager plblogtabs" style="display:none;">	
					<h4>'.$this->l('Block tags').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Display block').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_SHOW_BLOCK_TAG',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_SHOW_BLOCK_TAG" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_SHOW_BLOCK_TAG',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_SHOW_BLOCK_TAG">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Position display').'</label>
					<div class="col-lg-9">
					<select name="CS_DISPLAY_TAG">';
						foreach($this->myHook as $hook)
						{
							$this->_html .= '<option value="'.$hook.'" '.(Configuration::get('CS_DISPLAY_TAG',null,null,$id_shop) == $hook ? "selected='selected'" : '').'>'.$hook.'</option>';
						}
					$this->_html .= '</select>
						<p class="help-block">'.$this->l('Choose position(hook) for display blog current comment block.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Only display blog page').'</label>
					<div class="col-lg-9">
					<input type="radio" name="CS_TAG_DISPLAY_PAGE" value="1" '.(Configuration::get('CS_TAG_DISPLAY_PAGE',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="CS_TAG_DISPLAY_PAGE" id="dhtml_off" value="0" '.(Configuration::get('CS_TAG_DISPLAY_PAGE',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('If it is actived, block only display blog page. And contrary, block display all page.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Number tags displayed').'</label>
					<div class="col-lg-9">
						<input type="text" size="8" value="'.(Configuration::get('CS_NUMBER_TAG_DISPLAYED',null,null,$id_shop)).'" name="CS_NUMBER_TAG_DISPLAYED" />
						<p class="help-block">'.$this->l('Set the number of tags to be displayed in this block').'</p>
					</div>
					
					
				</fieldset>
				
				<fieldset class="manager-6 tab-manager plblogtabs" style="display:none;">
					<h4>'.$this->l('Block lastest post').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Display block').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_SHOW_BLOCK_LASTEST',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_SHOW_BLOCK_LASTEST" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_SHOW_BLOCK_LASTEST',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_SHOW_BLOCK_LASTEST">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Position display').'</label>
					<div class="col-lg-9">
					
					<select name="CS_LASTEST_POST">';
						foreach($this->myHook as $hook)
						{
							$this->_html .= '<option value="'.$hook.'" '.(Configuration::get('CS_LASTEST_POST',null,null,$id_shop) == $hook ? "selected='selected'" : '').'>'.$hook.'</option>';
						}
					$this->_html .= '</select>
						<p class="help-block">'.$this->l('Choose position(hook) for display blog current comment block.').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Only display blog page').'</label>
					<div class="col-lg-9">
					<input type="radio" name="LASTEST_POST_DISPLAY_PAGE" value="1" '.(Configuration::get('LASTEST_POST_DISPLAY_PAGE',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="LASTEST_POST_DISPLAY_PAGE" id="dhtml_off" value="0" '.(Configuration::get('LASTEST_POST_DISPLAY_PAGE',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('If it is actived, block only display blog page. And contrary, block display all page.').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Numbers post display').'</label>
					<div class="col-lg-9">
						<input type="text" size="8" value="'.(Configuration::get('CS_OP_LASTEST_POST',null,null,$id_shop)).'" name="CS_OP_LASTEST_POST" />
						<p class="help-block">'.$this->l('Specify the amount of lastest post to be displayed in lastest post block').'</p>
					</div>

					<label class="control-label col-lg-3">'.$this->l('Image size for block').'</label>
					<div class="col-lg-9">
						<select name="CS_IMEP_SHOW">
							<option value="small" '.(Configuration::get('CS_IMEP_SHOW',null,null,$id_shop) == 'small' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Small&nbsp;</option>
							<option value="medium" '.(Configuration::get('CS_IMEP_SHOW',null,null,$id_shop) == 'medium' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Medium&nbsp;</option>
							<option value="large" '.(Configuration::get('CS_IMEP_SHOW',null,null,$id_shop) == 'large' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Large&nbsp;</option>
							<option value="none" '.(Configuration::get('CS_IMEP_SHOW',null,null,$id_shop) == 'none' ? 'selected="selected"' : '').' >&nbsp;&nbsp;-- No image --&nbsp;</option>
						</select>
						<p class="help-block">'.$this->l('Choose image size for block. "No image" is no display image in block.').'</p>
					</div>

					<label class="control-label col-lg-3">'.$this->l('Number character for post').'</label>
					<div class="col-lg-9">
						<input type="text" size="8" value="'.(Configuration::get('CS_COLP_MAXIMUM',null,null,$id_shop)).'" name="CS_COLP_MAXIMUM" />
						<p class="help-block">'.$this->l('Number character for description post (In case : description is displayed.).').'</p>
					</div>
				</fieldset>
				<fieldset class="manager-7 tab-manager plblogtabs" style="display:none;">
				<h4>'.$this->l('Block current comments').'</h4>
					<label class="control-label col-lg-3">'.$this->l('Display block').'</label>
					<div class="col-lg-9">
						<input id="display_on" type="radio" value="1" '.(Configuration::get('CS_SHOW_BLOCK_CURRENT_COMMENT',null,null,$id_shop) == '1' ? "checked='checked'" : '').' name="CS_SHOW_BLOCK_CURRENT_COMMENT" />
						<label class="t" for="display_on">
							<img title="Enabled" alt="Enabled" src="../img/admin/enabled.gif">
						</label>
						<input id="display_off" type="radio" '.(Configuration::get('CS_SHOW_BLOCK_CURRENT_COMMENT',null,null,$id_shop) == '0' ? "checked='checked'" : '').' value="0" name="CS_SHOW_BLOCK_CURRENT_COMMENT">
						<label class="t" for="display_off">
							<img title="Disabled" alt="Disabled" src="../img/admin/disabled.gif">
						</label>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Position display').'</label>
					<div class="col-lg-9">
					
					<select name="CS_POSITION_CURRENT_COMMENT">';
						foreach($this->myHook as $hook)
						{
							$this->_html .= '<option value="'.$hook.'" '.(Configuration::get('CS_POSITION_CURRENT_COMMENT',null,null,$id_shop) == $hook ? "selected='selected'" : '').'>'.$hook.'</option>';
						}
					$this->_html .= '</select>
					<p class="help-block">'.$this->l('Choose position(hook) for display blog current comment block.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Only display blog page').'</label>
					<div class="col-lg-9">
					<input type="radio" name="CURRENT_COMMENT_DISPLAY_PAGE" value="1" '.(Configuration::get('CURRENT_COMMENT_DISPLAY_PAGE',null,null,$id_shop) == '1' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_on"> <img src="../img/admin/enabled.gif" alt="Enabled" title="Enabled"></label>
					<input type="radio" name="CURRENT_COMMENT_DISPLAY_PAGE" id="dhtml_off" value="0" '.(Configuration::get('CURRENT_COMMENT_DISPLAY_PAGE',null,null,$id_shop) == '0' ? "checked='checked'" : '').'>
					<label class="t" for="dhtml_off"> <img src="../img/admin/disabled.gif" alt="Disabled" title="Disabled"></label>
					<p class="help-block">'.$this->l('If it is actived, block only display blog page. And contrary, block display all page.').'</p>
					</div>
					<label class="control-label col-lg-3">'.$this->l('Numbers post display').'</label>
					<div class="col-lg-9">
						<input type="text" size="8" value="'.(Configuration::get('CS_NUMBER_CURRENT_COMMENT',null,null,$id_shop)).'" name="CS_NUMBER_CURRENT_COMMENT" />
						<p class="help-block">'.$this->l('Specify the amount of lastest post to be displayed in lastest post block').'</p>
					</div>
					
					<label class="control-label col-lg-3">'.$this->l('Image size for block').'</label>
					<div class="col-lg-9">
						<select name="CS_COMMENT_SIZE_IMAGE_POST">
							<option value="small" '.(Configuration::get('CS_COMMENT_SIZE_IMAGE_POST',null,null,$id_shop) == 'small' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Small&nbsp;</option>
							<option value="medium" '.(Configuration::get('CS_COMMENT_SIZE_IMAGE_POST',null,null,$id_shop) == 'medium' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Medium&nbsp;</option>
							<option value="large" '.(Configuration::get('CS_COMMENT_SIZE_IMAGE_POST',null,null,$id_shop) == 'large' ? 'selected="selected"' : '').' >&nbsp;&nbsp;Large&nbsp;</option>
							<option value="none" '.(Configuration::get('CS_COMMENT_SIZE_IMAGE_POST',null,null,$id_shop) == 'none' ? 'selected="selected"' : '').' >&nbsp;&nbsp;-- No image --&nbsp;</option>
						</select>
						<p class="help-block">'.$this->l('Choose image size for block. "No image" is no display image in block.').'</p>
					</div>
					
				</fieldset>
				<fieldset class="manager-8 tab-manager plblogtabs" style="display:none;">
					<h4>'.$this->l('Category RSS').'</h4>
					<p class="help-block">'.$this->l('If categories are selected, they will display link rss in front end.').'</p>
					<div>
					<label class="control-label col-lg-3">'.$this->l('Number of post').'</label>
					<div class="col-lg-9">
						<input type="text" size="8" value="'.(Configuration::get('CATEGORY_RSS_NUMBER',null,null,$id_shop)).'" name="CATEGORY_RSS_NUMBER" />
						<p class="help-block">'.$this->l('Number of post are extracted RSS.').'</p>
					</div>
					<table cellspacing="0" cellpadding="0" class="table">
						<tr>
							<th>c</th>
							<th>ID</th>
							<th style="width: 600px">'.$this->l('Category Blog').'</th>
						</tr>';
						$id_root = 1; //home category
						$arrCheck = explode(",",Configuration::get('CATEGORY_RSS',null,null,$id_shop));
						$categories = CSPLCategory::getCategoriesCheckbox($id_lang, $id_shop);
						$this->_html .= $this->getCheckboxCatalog($arrCheck,$categories,$categories[0][1],$id_root,1).
					'</table>
					</div>
				</fieldset>
				<center><input type="submit" name="submitConfiguration" value="Save" class="btn btn-default" /></center>
					</form>
				</div>
			</div>
		';
		
		return $this->_html;
}

public static function getCheckboxCatalog($arrCheck,$categories, $current, $id_category = 1, $level, $has_suite = array())
	{
		global $done;
		static $irow;

		if (!isset($done[$current['infos']['category_parent']]))
			$done[$current['infos']['category_parent']] = 0;
		$done[$current['infos']['category_parent']] += 1;
		if(isset($categories[$current['infos']['category_parent']]))
			$todo = sizeof($categories[$current['infos']['category_parent']]);
		$doneC = $done[$current['infos']['category_parent']];

		//$level = $current['infos']['level_depth'] + 1;
		
		if($id_category != 1)
		{
			$result = '
			<tr class="'.($irow++ % 2 ? 'alt_row' : '').'">
				<td>
					<input type="checkbox" name="categoryBox[]" class="categoryBox" id="categoryBox_'.$id_category.'" value="'.$id_category.'"'.(in_array($id_category, $arrCheck) ? ' checked="checked"' : '').'/>
				</td>
				<td>
					'.$id_category.'
				</td>
				<td>';
				for ($i = 2; $i < $level; $i++)
					if(isset($has_suite[$i - 2]))
					{
						$result .= '<img src="../img/admin/lvl_'.$has_suite[$i - 2].'.gif" alt="" />';
					}
				$result .= '<img style="vertical-align:middle" src="../img/admin/'.($level == 1 ? 'lv1.gif' : 'lv2_'.($todo == $doneC ? 'f' : 'b').'.gif').'" alt="" /> &nbsp;
				<label for="categoryBox_'.$id_category.'" class="t">'.stripslashes($current['infos']['name']).'</label></td>
			</tr>';
		}
		else
			$result = '';
		
		if ($level > 1)
			$has_suite[] = ($todo == $doneC ? 0 : 1);

		if (isset($categories[$id_category]))
			foreach ($categories[$id_category] AS $key => $row)
				if ($key != 'infos')
				{
					$level += 1;
					$result.= self::getCheckboxCatalog($arrCheck,$categories, $categories[$id_category][$key], $key, $level, $has_suite);
				}
		
		return $result;
	}
	
	
	function hookModuleRoutes($params)
	{
		global $smarty, $link;
		
		return array(
		'cs_category' => array(
			'controller' =>	null,
			'rule' =>		'module/{module}{/:controller}/{id_cs_blog_category}-{rewrite}',
			'keywords' => array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'id_cs_blog_category' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_category'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL]*'),
			),
			'params' => array(
				'fc' => 'module',
			),
		),
		'cs_blog_post' => array(
			'controller' =>	null,
			'rule' =>		'module/{module}{/:controller}/{id_cs_blog_post}-{category_parent}-{rewrite}.html',
			'keywords' => array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'category_parent' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'category_parent'),
				'id_cs_blog_post' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_post'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL]*'),
			),
			'params' => array(
				'fc' => 'module',
			),
		),
		'cs_tag' => array(
			'controller' =>	null,
			'rule' =>		'module/{module}{/:controller}/{id_cs_blog_tag}-{name}.html',
			'keywords' => array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'id_cs_blog_tag' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_tag'),
				'name' =>		array('regexp' => '[_a-zA-Z0-9_-]+'),
			), 
			'params' => array(
				'fc' => 'module',
			),
		),
		'cs_rss' => array(
			'controller' =>	null,
			'rule' =>		'module/{module}{/:controller}/{idrss}.html',
			'keywords' => array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'idrss' =>				array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'idrss')
			), 
			'params' => array(
				'fc' => 'module',
			),
		)
		);
	}
	
	public function getTree($resultParents, $resultIds, $maxDepth, $id_category = 1, $currentDepth = 0)
	{
		global $link;

		$children = array();
		if (isset($resultParents[$id_category]) AND sizeof($resultParents[$id_category]) AND ($maxDepth == 0 OR $currentDepth < $maxDepth))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_cs_blog_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
		return array('id' => $id_category, 'link' => $this->csLink->getCategoryPostLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => $resultIds[$id_category]['name'], 'desc'=> '',
					 'children' => $children,
					 'link_rewrite' => $resultIds[$id_category]['link_rewrite']);
	}
	
	function getLastestPost($id_lang=null, $id_shop=null)
	{
		global $cookie;
		
		$post_length = Configuration::get('CS_OP_LASTEST_POST',null,null,$id_shop);
		if ($post_length == null)
				$post_length = 5;
		
		$posts = Db::getInstance()->ExecuteS("
			SELECT ps.*,pl.*,p.* FROM "._DB_PREFIX_."cs_blog_post p
			INNER JOIN "._DB_PREFIX_."cs_blog_post_lang pl
			ON (p.id_cs_blog_post=pl.id_cs_blog_post AND pl.id_lang = ".$id_lang." AND pl.id_shop = ".$id_shop.")
			INNER JOIN "._DB_PREFIX_."cs_blog_post_shop ps
			ON (p.id_cs_blog_post=ps.id_cs_blog_post AND ps.id_shop = ".$id_shop.")
			WHERE ps.active = 1
			ORDER BY p.date_add DESC
			LIMIT 0, ".$post_length."
		");
		
		$posts_new = array();
		$postObj = new CSBLPost();
		foreach ($posts as $post) {
			
			$post['date_add'] = $postObj->formatDateAdd($post['date_add']);
			
			$author = new Employee($post['author']);
			$post['author'] = $author->firstname.' '.$author->lastname;
			$postOb = new CSBLPost($post['id_cs_blog_post']);
			$post['count_comment'] = $postOb->getCountComment($id_lang,$id_shop);
			$post['link'] = $this->csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category']);
			$imep = Configuration::get('CS_IMEP_SHOW',null,null,$id_shop);
			if($imep != 'none')
			{
					$save_path = _PS_MODULE_DIR_.'csblog/media/posts/src/'.$post['id_cs_blog_post'];
					$url_path = 'media/posts/cache/'.$post['id_cs_blog_post'].'_'.$id_shop;
					if (file_exists($save_path.'.'.$this->imageType))
						$post['image'] = $url_path.'_'.$imep.'.'.$this->imageType;
					else
						$post['image'] = '';
			}
			$posts_new[] = $post;
		}
		return $posts_new;
	}
	
	
	public function getCurrentComments($id_lang=null, $id_shop=null, $nb=5)
	{
		$comments = Db::getInstance()->ExecuteS("
			SELECT c.*,cl.* FROM "._DB_PREFIX_."cs_blog_comment c
			INNER JOIN "._DB_PREFIX_."cs_blog_comment_lang cl
			ON (c.id_cs_blog_comment = cl.id_cs_blog_comment AND cl.id_lang = ".$id_lang.")
			WHERE c.id_shop = ".$id_shop." AND c.active = 1
			ORDER BY c.date_add DESC
			LIMIT 0, ".$nb."
		");
		$result = array();
		$postObj = new CSBLPost();
		foreach($comments as $comment)
		{
			$post_comment = new CSBLPost($comment['id_cs_blog_post']);
			$comment['date_add'] = $postObj->formatDateAdd($comment['date_add']);
			
			
			$comment['name_post'] = $post_comment->name[$id_lang];
			$comment['link_post'] = $this->csLink->getLinkPostDetail($post_comment->id_cs_blog_post,$post_comment->link_rewrite[$id_lang],$post_comment->id_cs_blog_category);
			
			$imep = Configuration::get('CS_COMMENT_SIZE_IMAGE_POST',null,null,$id_shop);
			if($imep != 'none')
			{
					$save_path = _PS_MODULE_DIR_.'csblog/media/posts/src/'.$post_comment->id_cs_blog_post;
					$url_path = 'media/posts/cache/'.$post_comment->id_cs_blog_post.'_'.$id_shop;
					if (file_exists($save_path.'.'.$this->imageType))
						$comment['image_post'] = $url_path.'_'.$imep.'.'.$this->imageType;
			}
			
			$result[] = $comment;
		}
		return $result;
	}

	
	
	public function getContentForHook()
	{
		global $smarty,$cookie;
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$smarty->assign('cs_path', $this->_path);
		/*get categories*/
		$smarty->assign('CS_SHOW_BLOCK_CATEGORY', Configuration::get('CS_SHOW_BLOCK_CATEGORY',null,null,$id_shop));
		$smarty->assign('CS_DISPLAY_CATEGORY', Configuration::get('CS_DISPLAY_CATEGORY',null,null,$id_shop));
		$maxdepth = Configuration::get('BLOCK_CATEG_MAX_DEPTH',null,null,$id_shop);
		$result = $this->getCategories($id_lang,$id_shop);
		$resultParents = array();
		$resultIds = array();
		
		foreach ($result as &$row)
		{
			$resultParents[$row['category_parent']][] = &$row;
			$resultIds[$row['id_cs_blog_category']] = &$row;
		}

		$blockCategTree = $this->getTree($resultParents, $resultIds, Configuration::get('BLOCK_CATEG_MAX_DEPTH',null,null,$id_shop));
		unset($resultParents);
		unset($resultIds);
		$isDhtml = (Configuration::get('BLOCK_CATEG_DHTML',null,null,$id_shop) == 1 ? true : false);

		$id_cs_blog_category = (int)Tools::getValue('id_cs_blog_category');
		$id_cs_blog_post = (int)Tools::getValue('id_cs_blog_post');
		
		if (Tools::isSubmit('id_cs_blog_category'))
		{
			$cookie->last_visited_blog_category = $id_cs_blog_category;
			$smarty->assign('id_cs_blog_category_current', (int)$cookie->last_visited_blog_category);
		}
		
		if (Tools::isSubmit('id_cs_blog_post'))
		{
			$cookie->last_visited_blog_category = Tools::getValue('category_parent');
			$this->smarty->assign('id_cs_blog_category_current', (int)$cookie->last_visited_blog_category);
		}
			
		$smarty->assign('cs_blockCategTree', $blockCategTree);

		if (file_exists(_PS_THEME_DIR_.'modules/csblog/views/templates/hook/blockcategories.tpl'))
			$smarty->assign('cs_branche_tpl_path', _PS_THEME_DIR_.'modules/blockcategories/category-tree-branch.tpl');
		else
			$smarty->assign('cs_branche_tpl_path', _PS_MODULE_DIR_.'csblog/views/templates/hook/category-tree-branch.tpl');
		$smarty->assign('cs_isDhtml', $isDhtml);
		
		
		/*get post lastest*/
		$lastest_posts = $this->getLastestPost($id_lang,$id_shop);
		$smarty->assign('lastest_posts', $lastest_posts);
		$smarty->assign('cs_image_size_relate_posts', Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop));
		$smarty->assign('CS_SHOW_BLOCK_LASTEST', Configuration::get('CS_SHOW_BLOCK_LASTEST',null,null,$id_shop));
		$smarty->assign('DISPLAY_LASTEST_POST', Configuration::get('CS_LASTEST_POST',null,null,$id_shop));
		$smarty->assign('cs_imep_show', Configuration::get('CS_IMEP_SHOW',null,null,$id_shop));
		$smarty->assign('CS_COLP_MAXIMUM', Configuration::get('CS_COLP_MAXIMUM',null,null,$id_shop));
		
		/*get tags*/
		$tags = $this->getMainTags($id_lang,$id_shop,Configuration::get('CS_NUMBER_TAG_DISPLAYED',null,null,$id_shop));
		$smarty->assign('CS_SHOW_BLOCK_TAG', Configuration::get('CS_SHOW_BLOCK_TAG',null,null,$id_shop));
		$smarty->assign('CS_DISPLAY_TAG', Configuration::get('CS_DISPLAY_TAG',null,null,$id_shop));
		$smarty->assign('tags', $tags);
		
		/*get comments current*/ 
		if (Configuration::get('CS_SHOW_BLOCK_CURRENT_COMMENT',null,null,$id_shop) == '1')
		{
			$nb = Configuration::get('CS_NUMBER_CURRENT_COMMENT',null,null,$id_shop);
			$position = Configuration::get('CS_POSITION_CURRENT_COMMENT',null,null,$id_shop);
			$comments = $this->getCurrentComments($id_lang, $id_shop,$nb);

			$smarty->assign('position', $position);
			$smarty->assign('blockcomments', $comments);
		}
		/*page display*/
		$smarty->assign('BLOCK_CATEG_DISPLAY_PAGE', Configuration::get('BLOCK_CATEG_DISPLAY_PAGE',null,null,$id_shop));
		$smarty->assign('CS_TAG_DISPLAY_PAGE', Configuration::get('CS_TAG_DISPLAY_PAGE',null,null,$id_shop));
		$smarty->assign('LASTEST_POST_DISPLAY_PAGE', Configuration::get('LASTEST_POST_DISPLAY_PAGE',null,null,$id_shop));
		$smarty->assign('CURRENT_COMMENT_DISPLAY_PAGE', Configuration::get('CURRENT_COMMENT_DISPLAY_PAGE',null,null,$id_shop));
	}
	
	public function getMainTags($id_lang = null,$id_shop = null, $nb = 10)
	{
		
		$tags = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT t.name,t.id_cs_blog_tag, COUNT(pt.id_cs_blog_tag) AS times
		FROM `'._DB_PREFIX_.'cs_blog_post_tag` pt
		LEFT JOIN `'._DB_PREFIX_.'cs_blog_tag` t ON (t.id_cs_blog_tag = pt.id_cs_blog_tag)
		LEFT JOIN `'._DB_PREFIX_.'cs_blog_post` p ON (p.id_cs_blog_post = pt.id_cs_blog_post )
		WHERE t.`id_lang` = '.(int)$id_lang.' AND (pt.id_cs_blog_post IN (SELECT ps.id_cs_blog_post FROM '._DB_PREFIX_.'cs_blog_post_shop ps WHERE ps.id_shop = '.$id_shop.')) 
		GROUP BY t.id_cs_blog_tag
		ORDER BY times DESC
		LIMIT 0, '.(int)$nb);

		$tags_new = array();
		foreach ($tags as $tag) {
			$tag['link'] = $this->csLink->getTagLink($tag['id_cs_blog_tag'],$tag['name']);
			$tags_new[] = $tag;
		}
		return $tags_new;
	
	}
	
	
	
	public function hookActionShopDataDuplication($params)
	{
		//duplicate category for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'cs_blog_category_shop (id_cs_blog_category, id_shop, position)
		SELECT id_cs_blog_category, '.(int)$params['new_id_shop'].', position
		FROM '._DB_PREFIX_.'cs_blog_category_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'cs_blog_category_lang (id_cs_blog_category, id_lang, id_shop, name, description, meta_title, meta_description, meta_keywords, link_rewrite)
		SELECT id_cs_blog_category, id_lang, '.(int)$params['new_id_shop'].', name, description, meta_title, meta_description, meta_keywords, link_rewrite
		FROM '._DB_PREFIX_.'cs_blog_category_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		//duplicate post for shop
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'cs_blog_post_shop (id_cs_blog_post, id_shop, id_cs_blog_category,id_shop_default, date_add, position, active, related_posts, related_products)
		SELECT id_cs_blog_post, '.(int)$params['new_id_shop'].', id_cs_blog_category, id_shop_default, date_add, position, active, related_posts, related_products
		FROM '._DB_PREFIX_.'cs_blog_post_shop
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'cs_blog_post_lang (id_cs_blog_post, id_lang, id_shop, name, description, meta_title, meta_description, meta_keywords, link_rewrite)
		SELECT id_cs_blog_post, id_lang, '.(int)$params['new_id_shop'].', name, description, meta_title, meta_description, meta_keywords, link_rewrite
		FROM '._DB_PREFIX_.'cs_blog_post_lang
		WHERE id_shop = '.(int)$params['old_id_shop']);
		
	}
	
	
	public function hookFooter($params)
	{
		$this->getContentForHook();
		return $this->display(__FILE__, 'views/templates/hook/blogfooter.tpl');
	}
	
	
	public function hookDisplayLeftColumn($params)
	{
		$this->getContentForHook();
		
		return $this->display(__FILE__, 'views/templates/hook/columnleft.tpl');
	}
	
	public function hookDisplayRightColumn($params)
	{
		$this->getContentForHook();
		return $this->display(__FILE__, 'views/templates/hook/columnright.tpl');
	}
	
	
	public function hookHeader($params)
	{
		global $smarty;	
		$this->context->controller->addCSS($this->_path.'css/csblog-block.css');
		if($smarty->tpl_vars['page_name']->value == 'module-csblog-categoryPost' || $smarty->tpl_vars['page_name']->value=='module-csblog-post' || $smarty->tpl_vars['page_name']->value=='module-csblog-tag'){
		$this->context->controller->addCSS($this->_path.'css/csblog.css');
		$this->context->controller->addCSS($this->_path.'css/style.css');
		/* $this->context->controller->addJs($this->_path.'js/csjquery.cookie.js');
		$this->context->controller->addJs($this->_path.'js/jquery.isotope.js');
		$this->context->controller->addJs($this->_path.'js/list.grid.js'); */
		/*js slide*/
		$this->context->controller->addJs($this->_path.'js/carouFredSel/jquery.carouFredSel-6.2.1.js');
		$this->context->controller->addJs($this->_path.'js/carouFredSel/jquery.ba-throttle-debounce.min.js');
		$this->context->controller->addJs($this->_path.'js/carouFredSel/jquery.mousewheel.min.js');
		$this->context->controller->addJs($this->_path.'js/carouFredSel/jquery.touchSwipe.min.js');
		$this->context->controller->addJs($this->_path.'js/carouFredSel/jquery.transit.min.js');
		}		
		
	}
	
}