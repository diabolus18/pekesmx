$(window).load(function(){
	resizeWidth();
});
(function($,sr){
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null; 
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100); 
      };
  }
// smartresize 
 jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

var TO = false;
$(window).resize(function(){
 resizeWidth();
});

function resizeWidth()
{
	var menuWidth = 1200 - $("#menu").outerWidth();
	var numColumn = 6;
	var currentWidth = $('.mode_container .container_24').width() - $("#menu").outerWidth();
	if (currentWidth <=menuWidth) {
		new_width_column = currentWidth / numColumn;
		$('#menu div.options_list').each(function(index, element) { 
			var options_list = $(this).next();
			$(this).width(parseInt(options_list.css("width"))/menuWidth*numColumn * new_width_column); 	
				
		});
		
		$('#menu div.option').each(function(index, element) {
			var option = $(this).next();
			$(this).width(parseInt(option.css("width"))/menuWidth*numColumn * new_width_column);
			$("ul", this).width(parseInt(option.css("width"))/menuWidth*numColumn * new_width_column);
		
		});
		$('#menu ul.column').each(function(index, element) {
			var column = $(this).next();
			$(this).width(parseInt(column.css("width"))/menuWidth*numColumn * new_width_column);
		});
	}
}

$('document').ready(function(){
	$('#megamenu-responsive-root li.parent').prepend('<p>+</p>');
	
	$('.menu-toggle').click(function(){
		$('.root').toggleClass('open');
	});
	
	$('#megamenu-responsive-root li.parent > p').click(function(){

		if ($(this).text() == '+'){
			$(this).parent('li').children('ul').slideDown(300);
			$(this).text('-');
		}else{
			$(this).parent('li').children('ul').slideUp(300);
			$(this).text('+');
		}  
		
	});
	
	$("li a.title_menu_parent").hover(
		  function () {
			$(this).next().slideDown(200);
		  },
		  function () {
			$(this).parent().mouseleave(function() {
				$(".options_list").slideUp(100);
			});
			}
		); 
	
});



