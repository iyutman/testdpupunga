console.log('tada');
function actionStringInput() {
	console.log('tada###');
	var data = $('#string-form').val(), _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: 'post',
        data: {_token:_token, 'input':data},
        url: '/convertstring',
        success: function(t) {
        	$('#result').text(t);
        },
        error: function(t) { 
        	alert('something error');
        }
    });
}