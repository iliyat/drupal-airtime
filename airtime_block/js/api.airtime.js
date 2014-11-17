
/*todo: rewrite on Drupal-way */
function requestAPI(hash, callback){
	jQuery.ajax({
		url: 'ajax/airtime/api/'+hash,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			//console.log(data);
			callback(data);
		},
		error: function(xhr, statusText){
			console.log(xhr);
		}
	});
}

