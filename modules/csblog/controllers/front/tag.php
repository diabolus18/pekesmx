<?php
include_once(dirname(__FILE__).'/../../class/CSBLPost.php');
require_once (dirname(__FILE__).'/../../url/csLink.php');	
include_once(dirname(__FILE__).'/../../class/CSBLTag.php');
class csblogtagModuleFrontController extends ModuleFrontController
{
	protected $id_cs_blog_tag;
	protected $csLink;
	private $imageType;
	public function init()
	{
		$this->imageType = 'jpg';
		parent::init();
	}
	
	public function initContent()
	{
		parent::initContent();
		$this->id_cs_blog_tag = Tools::getValue('id_cs_blog_tag');
		$this->csLink = new csLink();
		$this->_display();
		$this->setTemplate('tag.tpl');
	}
	
	//public function initHeader()
	
	
	
	function _display()
	{
		global $smarty, $link, $cookie;
		$id_shop = Context::getContext()->shop->id;
		$id_lang = Context::getContext()->language->id;	
		
		/*get config*/
		$smarty->assign('cs_b_summary_character_count', Configuration::get('CS_B_SUMMARY_CHARACTER_COUNT',null,null,$id_shop));
		$smarty->assign('cs_imep_list_show', Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop));
		$smarty->assign('cs_posts_per_page', Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop));
		$smarty->assign('cs_allow_category_image', Configuration::get('CS_ALLOW_CATEGORY_IMAGE',null,null,$id_shop));
		$smarty->assign('cs_allow_category_description', Configuration::get('CS_ALLOW_CATEGORY_DESCRIPTION',null,null,$id_shop));

		
		/*get blog_tag*/
		$cs_blog_tag = new CSBLTag($this->id_cs_blog_tag);
		$this->context->smarty->assign('meta_title',$cs_blog_tag->name.'_'.Configuration::get('PS_SHOP_NAME'));
		$smarty->assign('cs_blog_tag', $cs_blog_tag);
		
		$pipe = Configuration::get('PS_NAVIGATION_PIPE');
		if (empty($pipe))
			$pipe = '>';
		$path = '<a href='.$link->getModuleLink('csblog','category').'>'.$this->module->l('Blog').'</a><span class="navigation-pipe">'.$pipe.'</span>'.$cs_blog_tag->name;
		$smarty->assign('path', $path);
		
		/*get post list*/
		$page = Tools::getValue('p');
		if ($page == null)
			$page = 0;
			
		$cs_post_list = $this->getPostes($page,$id_lang, $id_shop);
		if ($cs_post_list != null)
		{
			$smarty->assign('cs_postes_empty', 0);
			$smarty->assign('cs_post_list', $cs_post_list);
        }
		else
		{
			$smarty->assign('cs_postes_empty', 1);
		}
		
		
		/*sort post*/
		$smarty->assign('pl_orderby', (Tools::getValue('orderby') ? Tools::getValue('orderby') : 'post_date_create'));
		$smarty->assign('pl_orderway', (Tools::getValue('orderway') ? Tools::getValue('orderway') : 'DESC'));
		
		$sql = 'SELECT a.*, b.* FROM '._DB_PREFIX_.'cs_blog_post a
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_lang b
				ON (a.id_cs_blog_post= b.id_cs_blog_post AND b.id_shop = '.$id_shop.')
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_shop c
				ON (a.id_cs_blog_post= c.id_cs_blog_post)
				LEFt JOIN '._DB_PREFIX_.'cs_blog_post_tag pt ON (pt.id_cs_blog_post = a.id_cs_blog_post)
				WHERE a.active = 1 AND b.id_lang = '.$id_lang.' AND c.id_shop = '.$id_shop.' AND pt.id_cs_blog_tag = '.$this->id_cs_blog_tag.'';
				
		$count = count(Db::getInstance()->ExecuteS($sql));
		
		$this->_pagination($count,$id_shop);
	
		/* load javascript, css */
		$smarty->assign('_MODULE_DIR_', _MODULE_DIR_);
		/* -load javascript, css */
		$smarty->assign('csLink',$this->csLink);
		$smarty->assign('count',$count);
		
	}
	
	function getPostes($page = 0,$id_lang=null,$id_shop=null)
	{
		global $cookie;
		
		$leng = (Tools::getValue('n') ? Tools::getValue('n') : Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop));
		$start = $leng * ($page == 0 ? 0 : $page-1);

		$end = $leng;
		$orderby = (Tools::getValue('orderby') ? Tools::getValue('orderby') : 'date_add');
		$orderway = (Tools::getValue('orderway') ? Tools::getValue('orderway') : 'DESC');
		
		$sql = 'SELECT a.*, b.* FROM '._DB_PREFIX_.'cs_blog_post a
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_lang b
				ON (a.id_cs_blog_post= b.id_cs_blog_post AND b.id_shop = '.$id_shop.')
				LEFT JOIN '._DB_PREFIX_.'cs_blog_post_shop c
				ON (a.id_cs_blog_post= c.id_cs_blog_post)
				LEFt JOIN '._DB_PREFIX_.'cs_blog_post_tag pt ON (pt.id_cs_blog_post = a.id_cs_blog_post)
				WHERE a.active = 1 AND b.id_lang = '.$id_lang.' AND c.id_shop = '.$id_shop.' AND pt.id_cs_blog_tag = '.$this->id_cs_blog_tag.'
				ORDER BY '.($orderby == 'date_add' ? 'a.' : 'b.').$orderby.' '.$orderway.'
				LIMIT '.$start.','.$end.'
				';
		$posts = Db::getInstance()->ExecuteS($sql);
		$posts_new = array();
		foreach ($posts as $post) {
			$postObj = new CSBLPost($post['id_cs_blog_post']);

			$post['date_add'] = $postObj->formatDateAdd($post['date_add']);
			
			$author = new Employee($post['author']);
			$post['author'] = $author->firstname.' '.$author->lastname;
			
			
			$post['count_comment'] = $postObj->getCountComment($id_lang,$id_shop);
			$post['link'] = $this->csLink->getLinkPostDetail($post['id_cs_blog_post'],$post['link_rewrite'],$post['id_cs_blog_category']);
			$imep = Configuration::get('CS_IMEP_LIST_SHOW',null,null,$id_shop);
		if($imep != 'none')
		{
				$save_path = _PS_MODULE_DIR_.'csblog/media/posts/src/'.$post['id_cs_blog_post'];
				$url_path = __PS_BASE_URI__.'modules/csblog/media/posts/cache/'.$post['id_cs_blog_post'];	
				if (file_exists($save_path.'.'.$this->imageType))
					$post['image'] = $url_path.'_'.$id_shop.'_'.$imep.'.'.$this->imageType;
				else
					$post['image'] = '';
		}
			$posts_new[] = $post;
		}
		
		return $posts_new;
	}
	
	public function _pagination($nbProducts = 10,$id_shop = null)
	{
		if (!self::$initialized)
			$this->init();
		elseif (!$this->context)
			$this->context = Context::getContext();

		$nArray = (int)Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop) != 10 ? array((int)Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop), 10, 20, 50) : array(10, 20, 50);
		// Clean duplicate values
		$nArray = array_unique($nArray);
		asort($nArray);
		$this->n = abs((int)(Tools::getValue('n', ((isset($this->context->cookie->nb_item_per_page) && $this->context->cookie->nb_item_per_page >= 10) ? $this->context->cookie->nb_item_per_page : (int)Configuration::get('CS_POSTS_PER_PAGE',null,null,$id_shop)))));
		$this->p = abs((int)Tools::getValue('p', 1));
		if (!is_numeric(Tools::getValue('p', 1)) || Tools::getValue('p', 1) < 0)
			Tools::redirect(self::$link->getPaginationLink(false, false, $this->n, false, 1, false));

		$current_url = tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']);
		//delete parameter page
		$current_url = preg_replace('/(\?)?(&amp;)?p=\d+/', '$1', $current_url);

		$range = 2; /* how many pages around page selected */

		if ($this->p < 0)
			$this->p = 0;

		if (isset($this->context->cookie->nb_item_per_page) && $this->n != $this->context->cookie->nb_item_per_page && in_array($this->n, $nArray))
			$this->context->cookie->nb_item_per_page = $this->n;

		$pages_nb = ceil($nbProducts / (int)$this->n);
		if ($this->p > $pages_nb && $nbProducts <> 0)
			Tools::redirect(self::$link->getPaginationLink(false, false, $this->n, false, $pages_nb, false));

		$start = (int)($this->p - $range);
		if ($start < 1)
			$start = 1;
		$stop = (int)($this->p + $range);
		if ($stop > $pages_nb)
			$stop = (int)$pages_nb;

		$this->context->smarty->assign('nb_products', $nbProducts);
		$pagination_infos = array(
			'products_per_page' => (int)Configuration::get('PS_PRODUCTS_PER_PAGE',null,null,$id_shop),
			'pages_nb' => $pages_nb,
			'p' => $this->p,
			'n' => $this->n,
			'nArray' => $nArray,
			'range' => $range,
			'start' => $start,
			'stop' => $stop,
			'current_url' => $current_url
		);
		$this->context->smarty->assign($pagination_infos);
	}
	
	
	

	
}