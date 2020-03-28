$(document).ready(function(){
  $("#date").datepicker({
      minDate: 0, 
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
  var sub_total = $('#sub_total').text();
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
    html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
    html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
    html_code += '<td><input type="text" name="discount[]" id="discount'+count+'" data-srno="'+count+'" class="form-control input-sm number_only discount" readonly/></td>';
    html_code += '<td><input type="text" name="taxable_amount[]" id="taxable_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm taxable_amount" /></td>';
    html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
    html_code += '</tr>';
    $('#tab_quotation tbody').append(html_code);
  });
  
  $(document).on('click', '.remove_row', function(){
    var row_id = $(this).attr("id");
    $('#row_id_'+row_id).remove();
    cal_final_total(count);
    count--;
    $('#total_item').val(count);
  });

  function cal_final_total(count, state_code)
  {
    var final_total_item = 0;
    var sub_total = 0;
    var total_taxable_value = 0;
    var total_cgst = 0;
    var total_sgst = 0;
    var total_igst = 0;
    var grand_total = 0;
    for(j=1; j<=count; j++)
    {
      var quantity = 0;
      var price = 0;
      var actual_amount = 0;
      var discount = 0;
      var total_item = 0;
      var taxable_amount = 0;
      console.log(count);
      quantity = $('#order_item_quantity'+j).val();
      if(quantity > 0)
      {
        price = $('#order_item_price'+j).val();
        if(price > 0)
        {
          actual_amount = parseFloat(quantity) * parseFloat(price);
          $('#order_item_actual_amount'+j).val(actual_amount);
          var discount = actual_amount*(7/100);
          $('#discount'+j).val(discount.toFixed(2));
          taxable_amount = parseFloat(actual_amount) - parseFloat(discount);
          $('#taxable_amount'+j).val(taxable_amount.toFixed(2));
          sub_total = parseFloat(sub_total) + parseFloat(taxable_amount);
          $('#sub_total').val(sub_total.toFixed(2));
          $('#total_taxable_value').val(sub_total.toFixed(2));
          if(state_code == 23){
            total_cgst = sub_total*(9/100);
            total_sgst = sub_total*(9/100);
            $('#cgst').val(total_cgst.toFixed(2));
            $('#sgst').val(total_sgst.toFixed(2));
            grand_total = parseFloat(sub_total) + parseFloat(total_cgst) +parseFloat(total_sgst); 
            $('#grand_total').val(grand_total.toFixed(2));
          }
          if(state_code != 23){
            total_igst = sub_total*(18/100);  
            $('#igst').val(total_igst.toFixed(2));
            grand_total = parseFloat(sub_total) + parseFloat(total_igst); 
            $('#grand_total').val(grand_total.toFixed(2));
          }
        }
      }
    }
  }

  $(document).on('blur', '.order_item_price', function(){
    var state_code = $('#state_code').val();
    cal_final_total(count, state_code);
  });

});