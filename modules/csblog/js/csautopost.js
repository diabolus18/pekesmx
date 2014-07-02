$(window).load(function(){
		$("#opt_product_autocomplete_input")
			.autocomplete("../modules/csblog/autocompleted/cs_ajax_products_list.php", {
				minChars: 1,
				autoFill: true,
				max:20,
				matchContains: true,
				mustMatch:true,
				scroll:false,
				cacheLength:0,
				formatItem: function(item) {
					return item[1] + " - " + item[0];
				}
		}).result(this.addProductIntoMenu);
		$('#opt_result_product_autocomplete').delegate('.delProducts', 'click', function(){
			self.delProducts($(this).attr('name'));
		});
		$("#opt_post_autocomplete_input")
			.autocomplete("../modules/csblog/autocompleted/cs_ajax_posts_list.php", {
				minChars: 1,
				autoFill: true,
				max:20,
				matchContains: true,
				mustMatch:true,
				scroll:false,
				cacheLength:0,
				formatItem: function(item) {
					return item[1] + " - " + item[0];
				}
		}).result(this.addPostIntoMenu);
		$('#opt_result_post_autocomplete').delegate('.delPosts', 'click', function(){
			self.delPosts($(this).attr('name'));
		});
});



this.addProductIntoMenu = function(event, data, formatted)
{
	if (data == null)
		return false;
	var productId = data[1];
	var productName = data[0];
	var $divResultAutocomplete = $('#opt_result_product_autocomplete');
	var $inputResultAutocompleteId = $('#id_related_products');
	var $inputResultAutocompleteName = $('#name_related_products');
	$divResultAutocomplete.html($divResultAutocomplete.html() + '<br />' + productName + ' <span class="delProducts" name="' + productId + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span>');
		$inputResultAutocompleteName.val($inputResultAutocompleteName.val() + productName + '¤');
		$inputResultAutocompleteId.val($inputResultAutocompleteId.val() + productId + '-');
	$('#opt_product_autocomplete_input').val('');
	$('#opt_product_autocomplete_input').setOptions({
			extraParams: {
				excludeIds : self.getResultProductIds()
			}
		});
	return false;
}

this.addPostIntoMenu = function(event, data, formatted)
{
	if (data == null)
		return false;
	var postId = data[1];
	var postName = data[0];
	var $divResultAutocomplete = $('#opt_result_post_autocomplete');
	var $inputResultAutocompleteId = $('#id_related_posts');
	var $inputResultAutocompleteName = $('#name_related_posts');
	$divResultAutocomplete.html($divResultAutocomplete.html() + '<br />' + postName + ' <span class="delPosts" name="' + postId + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span>');
		$inputResultAutocompleteName.val($inputResultAutocompleteName.val() + postName + '¤');
		$inputResultAutocompleteId.val($inputResultAutocompleteId.val() + postId + '-');
	$('#opt_post_autocomplete_input').val('');
	$('#opt_post_autocomplete_input').setOptions({
			extraParams: {
				excludeIds : self.getResultPostIds()
			}
		});
	return false;
}

this.getResultProductIds = function(data)
	{
		if (data == null)
		return false;
		var id_product = data[1];
		if ($('#id_related_products').val() === undefined)
			return '';
		var ids = id_product + ',';
		ids += $('#id_related_products').val().replace(/\\-/g,',').replace(/\\,$/,'');
		ids = ids.replace(/\,$/,'');

		return ids;
	}

this.getResultPostIds = function(data)
	{
		if (data == null)
		return false;
		var id_post = data[1];
		if ($('#id_related_posts').val() === undefined)
			return '';
		var ids = id_post + ',';
		ids += $('#id_related_posts').val().replace(/\\-/g,',').replace(/\\,$/,'');
		ids = ids.replace(/\,$/,'');

		return ids;
	}

this.delProducts = function(id)
{
	var div = getE('opt_result_product_autocomplete');
	var input = getE('id_related_products');
	var name = getE('name_related_products');

	// Cut hidden fields in array
	var inputCut = input.value.split('-');
	var nameCut = name.value.split('¤');

	if (inputCut.length != nameCut.length)
		return jAlert('Bad size');

	// Reset all hidden fields
	input.value = '';
	name.value = '';
	div.innerHTML = '';
	for (i in inputCut)
	{
		// If empty, error, next
		if (!inputCut[i] || !nameCut[i])
			continue ;

		// Add to hidden fields no selected products OR add to select field selected product
		if (inputCut[i] != id)
		{
			input.value += inputCut[i] + '-';
			name.value += nameCut[i] + '¤';
			div.innerHTML += nameCut[i] + ' <span class="delProducts" name="' + inputCut[i] + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span><br />';
		}
		else
			$('#selectAccessories').append('<option selected="selected" value="' + inputCut[i] + '-' + nameCut[i] + '">' + inputCut[i] + ' - ' + nameCut[i] + '</option>');
	}
	$('#opt_product_autocomplete_input').setOptions({
		extraParams: {excludeIds : self.getResultProductIds()}
	});
};

this.delPosts = function(id)
{
	var div = getE('opt_result_post_autocomplete');
	var input = getE('id_related_posts');
	var name = getE('name_related_posts');

	// Cut hidden fields in array
	var inputCut = input.value.split('-');
	var nameCut = name.value.split('¤');

	if (inputCut.length != nameCut.length)
		return jAlert('Bad size');

	// Reset all hidden fields
	input.value = '';
	name.value = '';
	div.innerHTML = '';
	for (i in inputCut)
	{
		// If empty, error, next
		if (!inputCut[i] || !nameCut[i])
			continue ;

		// Add to hidden fields no selected products OR add to select field selected product
		if (inputCut[i] != id)
		{
			input.value += inputCut[i] + '-';
			name.value += nameCut[i] + '¤';
			div.innerHTML += nameCut[i] + ' <span class="delPosts" name="' + inputCut[i] + '" style="cursor: pointer;"><img src="../img/admin/delete.gif" /></span><br />';
		}
		else
			$('#selectAccessories').append('<option selected="selected" value="' + inputCut[i] + '-' + nameCut[i] + '">' + inputCut[i] + ' - ' + nameCut[i] + '</option>');
	}
	$('#opt_post_autocomplete_input').setOptions({
		extraParams: {excludeIds : self.getResultPostIds()}
	});
};