<?php
require_once (dirname(__FILE__).'/../url/csLink.php');
class CSBLTag extends ObjectModel
{
 	/** @var integer Language id */
	public $id_lang;

 	/** @var string Name */
	public $name;
	public $csLink;
	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
		'table' => 'cs_blog_tag',
		'primary' => 'id_cs_blog_tag',
		'fields' => array(
			'id_lang' => 	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
			'name' => 		array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true),
		),
	);


	protected $webserviceParameters = array(
		'fields' => array(
			'id_lang' => array('xlink_resource' => 'languages'),
		),
	);

	public function __construct($id = null, $name = null, $id_lang = null)
	{
		$this->def = CSBLTag::getDefinition($this);
		$this->setDefinitionRetrocompatibility();
		$this->csLink = new csLink();
		if ($id)
			parent::__construct($id);
		else if ($name && Validate::isGenericName($name) && $id_lang && Validate::isUnsignedId($id_lang))
		{
			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT *
			FROM `'._DB_PREFIX_.'cs_blog_tag` t
			WHERE `name` LIKE \''.pSQL($name).'\' AND `id_lang` = '.(int)$id_lang);

			if ($row)
			{
			 	$this->id = (int)$row['id_cs_blog_tag'];
			 	$this->id_lang = (int)$row['id_lang'];
				$this->name = $row['name'];
			}
		}
	}
	
	public function add($autodate = true, $null_values = false)
	{
		if (!parent::add($autodate, $null_values))
			return false;
		else if (isset($_POST['posts']))
			return $this->setPosts(Tools::getValue('posts'));
		return true;
	}
	
	public function delete($autodate = true, $null_values = false)
	{
		if (!parent::delete($autodate, $null_values))
			return false;
		$this->deleteTagsForPost(Tools::getValue('id_cs_blog_tag'));
		return true;
	}

	
	public static function deleteTagsForPost($id_cs_blog_post)
	{
		return Db::getInstance()->execute('DELETE FROM `'._DB_PREFIX_.'cs_blog_post_tag` WHERE `id_cs_blog_post` = '.(int)$id_cs_blog_post);
	}
	
	public function setPosts($array)
	{
		$result = Db::getInstance()->execute('DELETE FROM '._DB_PREFIX_.'cs_blog_post_tag WHERE id_cs_blog_tag = '.(int)$this->id);
		if (is_array($array))
		{
			$array = array_map('intval', $array);
			//$result &= ObjectModel::updateMultishopTable('CSBLTag', array('indexed' => 0), 'a.id_cs_blog_post IN ('.implode(',', $array).')');
			$ids = array();
			foreach ($array as $id_post)
				$ids[] = '('.(int)$id_post.','.(int)$this->id.')';

			if ($result)
			{
				$result &= Db::getInstance()->execute('INSERT INTO '._DB_PREFIX_.'cs_blog_post_tag (id_cs_blog_post, id_cs_blog_tag) VALUES '.implode(',', $ids));
				if (Configuration::get('PS_SEARCH_INDEXATION'))
					$result &= Search::indexation(false);
			}
		}
		return $result;
	}
	
	
	public function getPosts($associated = true, Context $context = null) //get post for tag
	{
		if (!$context)
			$context = Context::getContext();
		$id_lang = $this->id_lang ? $this->id_lang : $context->language->id;
		$id_shop = $this->id_shop ? $this->id_shop : $context->shop->id;

		if (!$this->id && $associated)
			return array();

		$in = $associated ? 'IN' : 'NOT IN';
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT pl.name, pl.id_cs_blog_post
		FROM `'._DB_PREFIX_.'cs_blog_post` p
		LEFT JOIN `'._DB_PREFIX_.'cs_blog_post_lang` pl ON p.id_cs_blog_post = pl.id_cs_blog_post AND pl.id_shop = '.$id_shop.'
		LEFT JOIN `'._DB_PREFIX_.'cs_blog_post_shop` ps ON p.id_cs_blog_post = ps.id_cs_blog_post
		WHERE  ps.id_shop = '.(int)$id_shop.' AND pl.id_lang = '.(int)$id_lang.' AND ps.active = 1
		'.($this->id ? ('AND p.id_cs_blog_post '.$in.' (SELECT pt.id_cs_blog_post FROM `'._DB_PREFIX_.'cs_blog_post_tag` pt WHERE pt.id_cs_blog_tag = '.(int)$this->id.')') : '').'
		ORDER BY pl.name');
	}
	

	
	public static function addTags($id_lang, $id_post, $tag_list, $separator = ',')
	{
	 	if (!Validate::isUnsignedId($id_lang))
			return false;

		if (!is_array($tag_list))
	 		$tag_list = array_filter(array_unique(array_map('trim', preg_split('#\\'.$separator.'#', $tag_list, null, PREG_SPLIT_NO_EMPTY))));

	 	$list = array();
		foreach ($tag_list as $tag)
		{
	 	 	if (!Validate::isGenericName($tag))
	 	 		return false;
			$tag_obj = new CSBLTag(null, trim($tag), (int)$id_lang);

			/* Tag does not exist in database */
			if (!Validate::isLoadedObject($tag_obj))
			{
				$tag_obj->name = trim($tag);
				$tag_obj->id_lang = (int)$id_lang;
				$tag_obj->add();
			}
			if (!in_array($tag_obj->id, $list))
				$list[] = $tag_obj->id;
		}
		$data = '';
		foreach ($list as $tag)
			$data .= '('.(int)$id_post.','.(int)$tag.'),';
		$data = rtrim($data, ',');

		return Db::getInstance()->execute('
		INSERT INTO `'._DB_PREFIX_.'cs_blog_post_tag` (`id_cs_blog_post`, `id_cs_blog_tag`)
		VALUES '.$data);
	}
	
	
	public static function getPostTags($id_cs_blog_post) //get tag for post (admin)
	{
	 	if (!$tmp = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT t.`id_lang`, t.`name`,t.id_cs_blog_tag
		FROM '._DB_PREFIX_.'cs_blog_tag t
		LEFT JOIN '._DB_PREFIX_.'cs_blog_post_tag pt ON (pt.id_cs_blog_tag = t.id_cs_blog_tag)
		WHERE pt.`id_cs_blog_post`='.(int)$id_cs_blog_post))
	 		return false;
	 	$result = array();
	 	foreach ($tmp as $tag)
		{
	 		$result[$tag['id_lang']][] = $tag['name'];
		}

	 	return $result;
	}
	
	public  function getTagsForTag($id_cs_blog_post) //get tag for post
	{
	 	if (!$tmp = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
		SELECT t.`id_lang`, t.`name`,t.id_cs_blog_tag
		FROM '._DB_PREFIX_.'cs_blog_tag t
		LEFT JOIN '._DB_PREFIX_.'cs_blog_post_tag pt ON (pt.id_cs_blog_tag = t.id_cs_blog_tag)
		WHERE pt.`id_cs_blog_post`='.(int)$id_cs_blog_post))
	 		return false;
		$result = array();
		foreach($tmp as $tag)
		{
			$tag['link'] = $this->csLink->getTagLink($tag['id_cs_blog_tag'],$tag['name']);
			$result[]= $tag;
		}
		return $result;
	}
}


