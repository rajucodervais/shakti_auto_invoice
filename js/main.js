$(document).ready(function(){
	$("#from_date").datepicker();
	$("#to_date").datepicker();
    $.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	$(".serach").on('blur',function(){
		console.log('hii')
	});
    $(document).on('click','.serach_btn',function(){
    	console.log('hii');
    })
    // $('.serach').on('keyup',function(){
    // 	console.log('hii');
    // })
	// $('.serach').on('keyup',function(){
	// 	console.log('keyup')
	//     var value = $(this).val();
	//     console.log(value)
	//     // $.ajax({
	//     //     type : 'get',
	//     //     // url : '',
	//     //     data:{search:value},
	//     //     success:function(data){
	//     //         // $('tbody').html(data);
	//     //     }
	// 	// });    
 //    });
})