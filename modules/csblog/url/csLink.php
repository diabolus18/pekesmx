<?php
require_once (dirname(__FILE__).'../../../../classes/Dispatcher.php');
class csLink extends Link
{
	public function createLinkPostDetail($module, $controller = 'default', array $params = array(), $ssl = false, $id_lang = null)//ok
	{
		global $link;
		if (!$id_lang)
			$id_lang = Context::getContext()->language->id;
		$id_shop = Context::getContext()->shop->id;
		$url = $link->getBaseLink($id_shop).$this->getLangLink($id_lang, null, $id_shop);
		$params['module'] = $module;
		$params['controller'] = $controller ? $controller : 'default';
		$dispatcher = Dispatcher::getInstance();
		$dispatcher->addRoute("cs_blog_post","module/{module}{/:controller}/{id_cs_blog_post}-{category_parent}-{rewrite}.html",null,1,array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'category_parent' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'category_parent'),
				'id_cs_blog_post' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_post'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL]*'),
			),array('fc' => 'module',));
		// If the module has its own route ... just use it !
		if ($dispatcher->hasRoute('module-'.$module.'-'.$controller, $id_lang))
			return $link->getPageLink('module-'.$module.'-'.$controller, $ssl, $id_lang, $params);
		else
			return $url.$dispatcher->createUrl('cs_blog_post', $id_lang, $params);
	}
	
	public function getLinkPostDetail($id_pl_blog_post, $link_rewrite,$category_parent)//ok
	{
		global $link;
		$params = array();
		$params['id_cs_blog_post'] = $id_pl_blog_post;
		$params['rewrite'] = $link_rewrite;
		$params['category_parent'] = $category_parent;
		$url = $this->createLinkPostDetail('csblog', 'post', $params);

		return $url;
	}
	
	
	
	public function getModuleLink2($module, $controller = 'default', array $params = array(), $ssl = false, $id_lang = null)
	{
	
		global $link;
		if (!$id_lang)
			$id_lang = Context::getContext()->language->id;
		$id_shop = Context::getContext()->shop->id;
		$url = $link->getBaseLink($id_shop).$this->getLangLink($id_lang, null, $id_shop);
		
		$params['module'] = $module;
		$params['controller'] = $controller ? $controller : 'default';

		$dispatcher = Dispatcher::getInstance();
		$dispatcher->addRoute("cs_category","module/{module}{/:controller}/{id_cs_blog_category}-{rewrite}",null,1,array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'id_cs_blog_category' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_category'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL]*'),
			),array('fc' => 'module',));
		// If the module has its own route ... just use it !
		if ($dispatcher->hasRoute('module-'.$module.'-'.$controller, $id_lang))
			return $link->getPageLink('module-'.$module.'-'.$controller, $ssl, $id_lang, $params);
		else
			return $url.$dispatcher->createUrl('cs_category', $id_lang, $params);
	}
	
	public function getCategoryPostLink($id_cs_blog_category, $link_rewrite)
	{
		global $link;
		$params = array();
		$params['id_cs_blog_category'] = $id_cs_blog_category;
		$params['rewrite'] = $link_rewrite;
		//$id
		$id_lang = Context::getContext()->language->id;
		$url = $this->getModuleLink2('csblog', 'categoryPost', $params,false,$id_lang);

		return $url;
	}
	
	
	
	public function getTagLink($id_cs_blog_tag, $name)
	{
		global $link;
		$params = array();
		$params['id_cs_blog_tag'] = $id_cs_blog_tag;
		$params['name'] = str_replace(" ","_",$name);

		$url = $this->creatLinkForTag('csblog', 'tag', $params);

		return $url;
	}
	
	public function creatLinkForTag($module, $controller = 'default', array $params = array(), $ssl = false, $id_lang = null)
	{
		global $link;
		if (!$id_lang)
			$id_lang = Context::getContext()->language->id;
		$id_shop = Context::getContext()->shop->id;
		$url = $link->getBaseLink($id_shop).$this->getLangLink($id_lang, null, $id_shop);

		// Set available keywords
		$params['module'] = $module;
		$params['controller'] = $controller ? $controller : 'default';

		$dispatcher = Dispatcher::getInstance();
		$dispatcher->addRoute("cs_tag","module/{module}{/:controller}/{id_cs_blog_tag}-{name}.html",null,1,array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'id_cs_blog_tag' =>				array('regexp' => '[0-9]+', 'param' => 'id_cs_blog_tag'),
				'name' =>		array('regexp' => '[_a-zA-Z0-9_-]+'),
			),array('fc' => 'module',));
		// If the module has its own route ... just use it !
		if ($dispatcher->hasRoute('module-'.$module.'-'.$controller, $id_lang))
			return $link->getPageLink('module-'.$module.'-'.$controller, $ssl, $id_lang, $params);
		else
			return $url.$dispatcher->createUrl('cs_tag', $id_lang, $params);
	}
	
	public function getPaginationLinkBlog($url)
	{
		if (Tools::getValue('n'))
			$url = $url.(!strstr($url, '?') ? '?' : '&amp;').'n='.(int)(Tools::getValue('n'));	
		return $url;
	}

	public function getPath($categories, $path = '')	
	{
		
		$html = '';
		$pipe = Configuration::get('PS_NAVIGATION_PIPE');
		if (empty($pipe))
			$pipe = '>';
		$full_path = '';
		foreach ($categories as $category)
		{
			$full_path .= '<a href='.$this->getCategoryPostLink($category['id_cs_blog_category'], $category['link_rewrite']).'>'.htmlentities($category['name'], ENT_NOQUOTES, 'UTF-8').'</a><span class="navigation-pipe">'.$pipe.'</span>';
			
		}
		$full_path = $full_path.$path;
		return $full_path;
	}
	public  function creatLinkForRSS($module, $controller = 'default', array $params = array(), $ssl = false, $id_lang = null)
	{
		global $link;
		if (!$id_lang)
			$id_lang = Context::getContext()->language->id;
		$id_shop = Context::getContext()->shop->id;
		$url = $link->getBaseLink($id_shop).$this->getLangLink($id_lang, null, $id_shop);

		// Set available keywords
		$params['module'] = $module;
		$params['controller'] = $controller ? $controller : 'default';

		$dispatcher = Dispatcher::getInstance();
		$dispatcher->addRoute("cs_rss","module/{module}{/:controller}/{idrss}.html",null,1,array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
				'idrss' =>				array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'idrss'),
			),array('fc' => 'module',));
		// If the module has its own route ... just use it !
		if ($dispatcher->hasRoute('module-'.$module.'-'.$controller, $id_lang))
			return $link->getPageLink('module-'.$module.'-'.$controller, $ssl, $id_lang, $params);
		else
			return $url.$dispatcher->createUrl('cs_rss', $id_lang, $params);
	}
	
	
	public function getRSSLink($idrss)
	{
		$params = array();
		$params['idrss'] = $idrss;
		$url = $this->creatLinkForRSS('csblog', 'rss', $params);

		return $url;
	}
	
}