(function($) {
	
	$('#accordion-panel-widgets, #widgets-right').on('change', '.cd-fa-order-select', function(e){
		var selectedAuthors = $(this).closest('.widget-content').find('.widget_cd_fa-authors:checked');
		var selectedAuthorsArr = [];
		selectedAuthors.each(function(){
			selectedAuthorsArr.push($(this).attr('value'));
		});
		console.log(selectedAuthorsArr);
		var data = {
			'action': 'cd_fa_order_change',
			'instance_number': $(this).data('instance-number'),
			'order': $(this).attr('value'),
			'selected_authors': selectedAuthorsArr
			}
		$.ajax({
			context: this,
			type: "post",
			url: ajaxurl, 
			data: data, 
			success: function(response) {
				console.log($(this));
				$(this).closest('.widget-content').find('.cd-fa-authors-list').html(response);
			}
		});

	});
	
})( jQuery );