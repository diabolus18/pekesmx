<?php
require_once (dirname(__FILE__).'/class/CSBLComment.php');
class AdminCSComment extends ModuleAdminController
{
	function __construct()
	{
		global $cookie;
		
		$this->className = 'CSBLComment';
		$this->table = 'cs_blog_comment';
		
		$this->lang = true;
		$this->add = false;
		$this->bootstrap = true;
		
		$this->allow_export = true;
		
		$this->fields_list = array(
			'id_cs_blog_comment' => array(
				'title' => $this->l('ID'),
				'align' => 'center',
				'width' => 20
			),
			'title' => array(
				'title' => $this->l('Title'), 
				'width' =>100
			),
			'author_name' => array(
				'title' => $this->l('Author'), 
				'width' =>100
			),
			'content' => array(
				'title' => $this->l('Content'), 
				'maxlength' => 190, 
				'width' =>200
			),
			'date_add' => array(
				'title' => $this->l('Date comment'),
				'align' => 'center',
				'width' => 20,
				'search' => false,
			),
			'active' => array(
				'title' => $this->l('Validated'),
				'active' => 'status',
				'align' => 'center',
				'type' => 'bool',
				'width' => 70,
				'orderby' => false
			)
			
			
		);

		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
		
		parent::__construct();
	}
	public function setMedia()
	{
		parent::setMedia();
		$this->addJqueryUi('ui.widget');
		$this->addJqueryPlugin('tagify');
	}
	public static function getNameCategory($category_parent)
	{
		$cat_parrent = new CSPLCategory($category_parent);
		return $cat_parrent->name[Configuration::get("PS_LANG_DEFAULT")];
	}
	public function init()
	{
		parent::init();
		if (Shop::getContext() == Shop::CONTEXT_SHOP && Shop::isFeatureActive())
			$this->_where = ' AND a.`id_shop` = '.(int)Context::getContext()->shop->id;
	}
	
	
	public function renderList()
	{
		global $currentIndex;
		$id_lang = Context::getContext()->language->id;
		if (Tools::isSubmit('viewcs_blog_comment'))
		{
			parent::renderList();
			$id_comment = Tools::getValue('id_cs_blog_comment');
			$comment = new CSBLComment($id_comment);
			$html = '
			<div class="panel">
			<fieldset>
					<div class="panel-heading">'.$this->l('Detail comment ').$comment->title[$id_lang].'</div>
					<div style="margin:20px 0;">
					<label>'.$this->l('Author').'</label>
					<div>'.$comment->author_name.'</div>
					</div>
					<div style="margin:20px 0;">
					<label>'.$this->l('Email').'</label>
					<div>'.$comment->author_email.'</div>
					</div>
					<div style="margin:20px 0;">
					<label>'.$this->l('Title').'</label>
					<div>'.$comment->title[$id_lang].'</div>
					</div>
					<div style="margin:20px 0;">
					<label>'.$this->l('Content').'</label>
					<div>'.$comment->content[$id_lang].'</div>
					</div>
					</fieldset>
					<div class="panel-footer">
					<a id="desc-cs_blog_category-back" class="btn btn-default" href="'.self::$currentIndex.'&token='.$this->token.'">
						<i class="process-icon-back "></i> <span>Back to list</span>
					</a>
					</div></div>
					';
			return $html;
		}
		else
		{
			$this->addRowAction('delete');
			$this->addRowAction('view');
			return '<style type="text/css">#desc-cs_blog_comment-new {display:none}</style>'.parent::renderList();
		}
	}
	public function renderView()
	{
		//$this->initToolbar();
		return $this->renderList();
	}


}