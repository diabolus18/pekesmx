<?php
include_once(dirname(__FILE__).'/../../class/CSBLComment.php');
include_once(dirname(__FILE__).'/../../class/CSBLPost.php');
include_once(dirname(__FILE__).'/../../class/CSBLTag.php');
include_once(dirname(__FILE__).'/../../class/CSPLCategory.php');
require_once (dirname(__FILE__).'/../../url/csLink.php');
class csblogpostModuleFrontController extends ModuleFrontController
{
	private $blog_post;
	private $csLink;
	private $csTag;
	public function __construct()
	{
		parent::__construct();

		$this->context = Context::getContext();
	}
	
	public function init()
	{
		parent::init();
		$this->context->smarty->assign($this->getMetaTags($this->context->language->id,$this->context->shop->id));
	}
	
	public function initContent()
	{
		$this->id_cs_blog_post = Tools::getValue('id_cs_blog_post');
		$this->csLink = new csLink();
		$this->csTag = new CSBLTag();
		parent::initContent();
		$this->_display();
		$this->setTemplate('post.tpl');
	}
	
	function _display()
	{
		global $smarty, $link, $cookie;	
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		/*get content detail post*/
		$image_size = Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop);
		$post = $this->getPostById($image_size,$this->id_cs_blog_post,$id_lang,$id_shop);
		$smarty->assign('csLink', $this->csLink); 
		$smarty->assign('capchatpath', __PS_BASE_URI__.'modules/csblog/'); 
		$smarty->assign('cs_b_summary_character_count', Configuration::get('CS_B_SUMMARY_CHARACTER_COUNT'));
		if ($post != null)
		{
			/*js tinymvc*/
			$smarty->assign('cs_js_blog', __PS_BASE_URI__.'modules/csblog/js/tiny_mce/tiny_mce.js');
			
			/*post*/
			$smarty->assign('post', $post);

			
			//breadcurm
			$pipe = Configuration::get('PS_NAVIGATION_PIPE');
			if (empty($pipe))
				$pipe = '>';
			$path = '<a href='.$link->getModuleLink('csblog','categoryPost').'>'.$this->module->l('Blog').'</a><span class="navigation-pipe">'.$pipe.'</span>';
			$id_category = Tools::getValue('category_parent');
			
			$cat = new CSPLCategory($id_category);
			
			$result = $cat->getParentsCategories($cat->id_cs_blog_category,$id_lang,$id_shop);
			$varPath = '<a href="'.$this->csLink->getCategoryPostLink($cat->id_cs_blog_category, $cat->link_rewrite[$id_lang]).'">'.$cat->name[$id_lang].'</a><span class="navigation-pipe">'.$pipe.'</span>';
			
			$path .= $this->csLink->getPath($result,$varPath.$post['name']);
			
			//echo $path ;die;
			$smarty->assign('path', $path);
			
			/*tag*/
			$show_tab = Configuration::get('CS_TBEP_SHOW',null,null,$id_shop);
			if(isset($show_tab) && $show_tab == 1)
			{
				$tags= $this->csTag->getTagsForTag($this->id_cs_blog_post);
				$smarty->assign('cstags', $tags);
			}
			
			/*related post*/
			$allow_related_post = Configuration::get('CS_ALLOW_RELATED_POSTS',null,null,$id_shop);
			if(isset($allow_related_post) && $allow_related_post == 1)
			{
				
				$id_related_posts = explode('-',$post['id_related_posts']);
				$related_posts = array();
				$image_size_related_post = Configuration::get('CS_IMAGE_SIZE_RELATED_POSTS',null,null,$id_shop);
				foreach($id_related_posts as $k=>$id)
				{
					if($id !== end($id_related_posts) && $k < Configuration::get('CS_NUM_RELATED_POSTS',null,null,$id_shop))
					{
						$item = $this->getPostById($image_size_related_post,$id,$id_lang,$id_shop);
						$related_posts[$k] = $item;
					}
				}
				$smarty->assign('allow_related_post', $allow_related_post);
				$smarty->assign('related_posts', $related_posts);
			}
			
			/*related product*/
			$allow_related_product = Configuration::get('CS_ALLOW_RELATED_PRODUCTS',null,null,$id_shop);

			if(isset($allow_related_product) && $allow_related_product == 1)
			{
				
				$id_related_products = explode('-',$post['id_related_products']);
				if($post['id_related_products'] != '')
				{
					$productIds = substr(implode(',',$id_related_products),0,strlen(implode(',',$id_related_products)) - 1);

					$products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
						SELECT DISTINCT image_shop.id_image, p.id_product, il.legend, product_shop.active, pl.name, pl.description_short, pl.link_rewrite, cl.link_rewrite AS category_rewrite, p.show_price,p.available_for_order,p.out_of_stock,p.id_category_default, p.ean13
						FROM '._DB_PREFIX_.'product p
						LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = p.id_product'.Shop::addSqlRestrictionOnLang('pl').')
						LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = p.id_product AND i.cover = 1)'.
							Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
						LEFT JOIN '._DB_PREFIX_.'image_lang il ON (il.id_image = i.id_image)
						'.Shop::addSqlAssociation('product', 'p').'
						LEFT JOIN '._DB_PREFIX_.'product_attribute pa ON (pa.id_product = p.id_product)
						'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.default_on=1').'
						LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = product_shop.id_category_default'.Shop::addSqlRestrictionOnLang('cl').')
						WHERE p.id_product IN ('.$productIds.')
						AND (i.id_image IS NULL OR image_shop.id_shop='.(int)$id_shop.')
						AND pl.id_lang = '.(int)$id_lang.'
						AND cl.id_lang = '.(int)$id_lang.'
						LIMIT 0,'.Configuration::get('CS_NUM_RELATED_PRODUCTS',null,null,$id_shop).'');
					$related_products = array();
					foreach ($products as $p)
						$related_products[$p['id_product']] = $p;
						
					$related_products_result = Product::getProductsProperties((int)$id_lang,$related_products);
					

					$smarty->assign('related_products_result', $related_products_result);
					$image_size_related_product = Configuration::get('CS_IMAGE_SIZE_RELATED_PRODUCT',null,null,$id_shop);

					$smarty->assign('image_size_related_product', $image_size_related_product);
				}
				$smarty->assign('allow_related_product', $allow_related_product);
			}
			
			
			/*comment*/
			$url_rewrite = Configuration::get('PS_REWRITING_SETTINGS');
			$smarty->assign('url_rewrite', $url_rewrite);
		
			$smarty->assign('id_shop', $id_shop);
			$postObj = new CSBLPost($this->id_cs_blog_post,$id_lang,$id_shop);
			$nb = Configuration::get('CS_NUMBER_COMMENT_DETAIL',null,null,$id_shop);
			if(Tools::issubmit('viewall'))
			{
				$viewall = true;
				$smarty->assign('viewall', $viewall);
			}
			else
				$viewall = false;
			$temps = $postObj->getCommentForPost($id_lang,$id_shop,$nb,$viewall);
			$comments = array();
			foreach($temps as $comment)
			{
				$comment['date_add'] = $postObj->formatDateAdd($comment['date_add']);
				$comments[] = $comment;
			}
			
			$count_comment = $postObj->getCountComment($id_lang, $id_shop);
			$smarty->assign('count_comment_total', $count_comment);
			$smarty->assign('count_comment_show', $nb);
			$smarty->assign('comments', $comments);

			$category_allow_comment = Db::getInstance()->getValue("
			SELECT allow_comment
			FROM "._DB_PREFIX_."cs_blog_category
			WHERE id_cs_blog_category=".$post['id_cs_blog_category']."
			");
			$post_allow_comment = $post['allow_comment'];
			if ($category_allow_comment && $post_allow_comment && $this->allowComment($id_shop)) 
			{
				$using_captcha = Configuration::get('CS_DISPLAY_CAPTCHA',null,null,$id_shop);
				$validate_comment = Configuration::get('CS_COMMENTS_VALIDATE',null,null,$id_shop);
				
				$smarty->assign('using_captcha', $using_captcha);
				$smarty->assign('validate_comment', $validate_comment);
				$smarty->assign('display_form_comment', 1);

				//msg error comment
				if (Tools::getValue('cssubmitcomment') == "true")
				{
					$error = $this->ProcessSubmit();
					if(is_array($error))
						$smarty->assign('error', $error);
					else
						Tools::redirect($this->csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category']).($url_rewrite == 1 ? '?' : '&').'sb');
				}
				if (Tools::issubmit('sb'))
				{
					$smarty->assign('success', true);
				}
			}
			else
			{
				$smarty->assign('display_form_comment', 0);
			}

			$smarty->assign('cs_imipd_show', Configuration::get('CS_IMIPD_SHOW',null,null,$id_shop));
		}
		else 
		{
			$smarty->assign('errorposts', 1);
		}
		
	}
	
	function ProcessSubmit()
	{
		if (Tools::getValue('cssubmitcomment') == "true")
		{
			$comment = new CSBLComment(Tools::getValue('id_cs_blog_comment'));
			$comment->copyFromPost();
			
			$errors = $comment->validateController();
			if (count($errors)<=0)
			{
				Tools::getValue('id_cs_blog_comment') ? $comment->update() : $comment->add();
				return true;
			}
			else
			{
				return $errors;
			}
		}
	}
	function getPostById($image_size,$id_cs_blog_post = null,$id_lang=null,$id_shop=null)
	{
		global $cookie;
		$sql = 'SELECT b.*,a.* FROM '._DB_PREFIX_.'cs_blog_post a
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_lang b
				ON (a.id_cs_blog_post= b.id_cs_blog_post AND b.id_shop = '.$id_shop.')
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_shop c
				ON (a.id_cs_blog_post= c.id_cs_blog_post)
				WHERE (c.active=1) AND b.id_lang = '.$id_lang.' AND c.id_shop = '.$id_shop.' AND a.id_cs_blog_post = '.$id_cs_blog_post.'';
				
		$row = Db::getInstance()->getRow($sql);
		if($row)
		{
			//$date = new DateTime(''.$row['date_add'].'');
			$row['date_add'] = CSBLPost::formatDateAdd($row['date_add']);
			
			$author = new Employee($row['author']);
			$row['author'] = $author->firstname.' '.$author->lastname;
			
			
			$blogCategory = new CSPLCategory($row['id_cs_blog_category'],$id_lang,$id_shop);
			$row['category'] = $blogCategory;
			
			if ($image_size != 'none')
			{
				$save_path = _PS_MODULE_DIR_.'csblog/media/posts/src/'.$id_cs_blog_post;
				$url_path = __PS_BASE_URI__.'modules/csblog/media/posts/cache/'.$id_cs_blog_post.'_'.$id_shop;
				
				if (file_exists($save_path.'.jpg'))
					$ext = '.jpg';
				else
					$ext = '';
				if($ext != '')
				{
					$row['image'] = $url_path.'_'.$image_size.$ext;
				}
			}
			
			return $row;
		}
		return false;
	}
	
	function allowComment($id_shop=null)	
	{
		global $cookie;
		$allowComment = Configuration::get('CS_ALLOW_COMMENTS_BY_GUESTS',null,null,$id_shop);
		if (!$allowComment AND !$cookie->id_customer) {
			return false;
		}
		return true;
	}
	
	public function getBlogPostMetas($id_cs_blog_post, $id_lang = null,$id_shop=null)
	{
		$sql = 'SELECT `name`, `meta_title`, `meta_description`, `meta_keywords`
				FROM `'._DB_PREFIX_.'cs_blog_post` p
				LEFT JOIN `'._DB_PREFIX_.'cs_blog_post_lang` pl ON (p.`id_cs_blog_post` = pl.`id_cs_blog_post` AND pl.id_shop = '.$id_shop.')
				LEFT JOIN `'._DB_PREFIX_.'cs_blog_post_shop` ps ON (p.`id_cs_blog_post` = ps.`id_cs_blog_post`)
				WHERE pl.id_lang = '.(int)$id_lang.' AND ps.id_shop = '.(int)$id_shop.'
					AND pl.id_cs_blog_post = '.(int)$id_cs_blog_post.'
					AND ps.active = 1';
		if ($row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql))
		{
			$result = array();
			if (empty($row['meta_description']))
				$row['meta_description'] = strip_tags($row['name']);
			if (!empty($row['meta_title']))
				$row['meta_title'] = $row['meta_title'].' - '.Configuration::get('PS_SHOP_NAME');
			else
				$row['meta_title'] = $row['name'].' - '.Configuration::get('PS_SHOP_NAME');
			return $row;
		}
	}
	
	public function getMetaTags($id_lang,$id_shop)
	{
		if($id_cs_blog_post = Tools::getValue('id_cs_blog_post'))
			return $this->getBlogPostMetas($id_cs_blog_post, $id_lang,$id_shop);
	}

	
}