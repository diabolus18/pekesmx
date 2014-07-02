<?php
class CSBLComment extends ObjectModel
{
	public $id_cs_blog_comment;
	public $id_cs_blog_post;
	public $id_shop;
	public $active;
	public $author_name;
	public $author_email;
	public $date_add;

	public $title;
	public $content;
	
	//protected $fieldsRequiredLang = array('title','content');
	//protected $fieldsValidateLang = array('title' => 'isString','content' => 'isString');
	public static $definition = array(
		'table' => 'cs_blog_comment',
		'primary' => 'id_cs_blog_comment',
		'multilang' => true,
		'fields' => array(
			//basic fields
			'id_cs_blog_post' => 	array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId'),
			'id_shop' =>		array('type' => self::TYPE_INT, 'validate' => 'isInt'),
			'author_name' =>			array('type' => self::TYPE_STRING,'required' => true, 'size' => 100),
			'author_email' =>			array('type' => self::TYPE_STRING,'required' => true, 'size' => 100),
			'date_add' => 			array('type' => self::TYPE_DATE, 'validate' => 'isString'),
			'active'  => array('type' => self::TYPE_BOOL,'validate' => 'isBool'),
			
			// Lang fields
			'title' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 200),
			'content' => 	array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isString'),
		)
	);
	public	function __construct($cs_blog_comment = null, $id_lang = null, $id_shop = null, Context $context = null)
	{
		parent::__construct($cs_blog_comment, $id_lang);
		
		/*if ($this->id)
		{
			$this->title = $this->getFieldLang('title');
			$this->content = $this->getFieldLang('content');
		}*/
		
	}

	public function getFieldLang($field)
	{
		$id_lang = (int)Context::getContext()->language->id;
		$sql = 'SELECT cml.'.$field.' FROM '._DB_PREFIX_.'cs_blog_comment cm
		LEFT JOIN '._DB_PREFIX_.'cs_blog_comment_lang cml ON (cm.id_cs_blog_comment = cml.id_cs_blog_comment)
		WHERE cm.id_cs_blog_comment = '.$this->id_cs_blog_comment.' AND cml.id_lang = '.$id_lang.'';
		$result = Db::getInstance()->getValue($sql);
		return $result;
	}
	function isEmail($email)
	{
		return (empty($email) OR preg_match('/^[a-z0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z0-9]+[._a-z0-9-]*\.[a-z0-9]+$/ui', $email));
	}
	function isName($name)
	{
		return preg_match('/^[^<>;=#{}]*$/u', $name);
	}
	public function validateController($htmlentities = true, $copy_post = false)
	{
		session_start();
		//echo $_SESSION['captcha'];die;
		$error = array();
		if (!$this->isEmail($_POST['author_email']))
		{
			$error['author_email'] = 'Invalid e-mail address';
		}			
		elseif (empty($_POST['author_email']))
		{
			$error['author_email'] = 'Email address required';
		}
		
		if (!$this->isName($_POST['author_name']) || $_POST['author_name'] == null) 
		{
			$error['author_name'] = 'Full name required';
		}
		
		if ( strlen($_POST['author_name']) > 100 ) 
		{
			$error['author_name'] = 'Full name is too long (100 chars max)';
		}
		if ($_POST['title'] == null)
		{
			$error['title'] = 'Title required';
		}
		if ($_POST['content'] == null)
		{
			$error['content'] = 'Comment required';
		}
		if(isset($_POST['captcha']))
		{
			if( $_SESSION['captcha'] != $_POST['captcha'] || empty($_SESSION['captcha'] ) ) 
			{
				$error['captcha'] = 'Captcha invalid';
			}
		}
		if (strlen($_POST['content']) > 1500)
		{
			$error['content'] = 'Comment is too long (1500 chars max)';
		}
		
		return $error;
	}
	public function copyFromPost()
	{
		foreach ($_POST AS $key => $value)
			if (key_exists($key, $this) AND $key != 'id_'.$this->table)
			{
				$this->{$key} = $value;
			}
		
			
	}
	
	function getDateCreate()
	{
		return date('Y-m-d H:i:s');
	}
	
	public function add($autodate = true, $null_values = false)
	{
		$sql = 'INSERT INTO '._DB_PREFIX_.'cs_blog_comment (id_cs_blog_post, id_shop, active, author_name, author_email, date_add) VALUES ('.$this->id_cs_blog_post.','.$this->id_shop.', '.$this->active.', "'.$this->author_name.'","'.$this->author_email.'","'.$this->getDateCreate().'")';
		Db::getInstance()->execute($sql);
		
		// get id_cs_blog_comment
		$rs = Db::getInstance()->Executes('SELECT * FROM '._DB_PREFIX_.'cs_blog_comment ORDER BY id_cs_blog_comment DESC LIMIT 0,1');
		$row = $rs[0];
		$id_cs_blog_comment = (int) $row['id_cs_blog_comment'];
		
		// insert table pl_blog_comment_lang	
		$langs = Db::getInstance()->ExecuteS('SELECT * FROM '._DB_PREFIX_.'lang');		
		foreach ($langs as $lang)
		{
			$id_lang = $lang['id_lang'];
			$sql = "
				INSERT INTO "._DB_PREFIX_."cs_blog_comment_lang(id_cs_blog_comment, id_lang, title, content)
				VALUES(".$id_cs_blog_comment.",".$id_lang.", '".$this->title."' , '".pSQL($this->content)."')";
			
			Db::getInstance()->execute($sql);
		}
		return 1;
	}

}