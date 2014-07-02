var clickEv = 'click';
if($.cookie('display'))
	modeDisplay = $.cookie('display');
else
	modeDisplay = 'fitRows';
function csViewListGrid()
{
	$("#" + modeDisplay + "").addClass('selected');
	if(modeDisplay == 'straightDown')
	{
		$('#post_list').removeClass('post_grid');
		$('#post_list').addClass('post_list');
		$('#post_list li.ajax_block_post').removeClass('col-sm-6');
		$('#post_list li.ajax_block_post').addClass('col-xs-12');
	}
	else
	{
		$('#post_list').removeClass('post_list');
		$('#post_list').addClass('post_grid');
		$('#post_list li.ajax_block_post').removeClass('col-xs-12');
		$('#post_list li.ajax_block_post').addClass('col-sm-6');
	}

	  /*list-grid*/
	$('#straightDown').on(clickEv, function(e){
	$('#post_list').removeClass('post_grid');
	$('#post_list').addClass('post_list');
	$('#post_list li.ajax_block_post').removeClass('col-sm-6');
	$('#post_list li.ajax_block_post').addClass('col-xs-12');
	$.cookie('display','straightDown');
    if(clickEv == 'touchstart'){
      $(this).click();
      return true;
    }
  });
  
  $('#fitRows').on(clickEv, function(e){
	$('#post_list').removeClass('post_list');
    $('#post_list').addClass('post_grid');
	$('#post_list li.ajax_block_post').removeClass('col-xs-12');
	$('#post_list li.ajax_block_post').addClass('col-sm-6');
    $.cookie('display','fitRows');
    if(clickEv == 'touchstart'){
      $(this).click();
      return true;
    }
  });
	/**/
	$('#post_list').isotope({
				itemSelector: '.ajax_block_post',
				layoutMode : modeDisplay,
				getSortData : {
					name : function( $elem ) {
					return $elem.attr('data-name');
					},
					date : function( $elem ) {
					return parseFloat($elem.attr('data-date'));
					}
				},
				sortBy:'position',sortAscending:true
			});
      var $optionSets = $('.option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }		
		
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  
        // make option object dynamically, i.e. { filter: '.my-filter-class' }
		var filters=$('.selectPostSort').val().split(':');
		var key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        value = value === 'false' ? false : value;
        var options={sortBy:filters[0],sortAscending:filters[1]=='asc'?true:false,layoutMode:value};
		console.log(options);
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options);
        } else {
          // otherwise, apply new options		
			$('#post_list').isotope( options );
        }	
        return false;
      });
} 



$(window).load(function() {
	csViewListGrid();
});