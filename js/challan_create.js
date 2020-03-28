$(document).ready(function(){
  $("#date").datepicker({
      minDate: 0, // 
  });
  $("#podate").datepicker({
      minDate: 0, // 0 days offset = today
  });
  $.ajaxSetup({
    headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).on('change','.state_name', function(){
    var id = $(this).children('option:selected').val();
    $.ajax({
      type:'GET',
      url:'/getstatelist',
      data:{id:id},
      success:function(data) {
        $(".state_code").val(data);
      }
    })
  });
  var total_invoice_value = $('#total_invoice_value').text();
  var count = 1;
  
  $(document).on('click', '#add_row', function(){
    count++;
    $('#total_item').val(count);
    var html_code = '';
    html_code += '<tr id="row_id_'+count+'">';
    html_code += '<td><span id="sr_no">'+count+'</span></td>';
    
    html_code += '<td><textarea class="desc form-control" name="desc[]" id="desc'+count+'"></textarea></td>';
    html_code += '<td><input type="text" name="unit[]" id="unit'+count+'" class="form-control unit"></td>';
    html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
    html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
    html_code += '</tr>';
    $('#tab_invoice tbody').append(html_code);
  });
  
  $(document).on('click', '.remove_row', function(){
    var row_id = $(this).attr("id");
    $('#row_id_'+row_id).remove();
    count--;
    $('#total_item').val(count);
  });

});