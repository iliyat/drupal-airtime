
function requestAPI(chanel, method, callback){
	jQuery.ajax({
		url: '/airtime/api/'+method+'/'+chanel,
		type: 'GET',
		dataType: 'json',
		success: function(data){
			console.log(data);
			callback(data);
		},
		error: function(xhr, statusText){
			console.log(xhr);
		}
	});
}

