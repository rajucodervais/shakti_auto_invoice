$(document).ready(function(){
  $("#date").datepicker({
      minDate: 0, // 0 days offset = today
      maxDate: 'today',
  });
  $("#podate").datepicker({
      minDate: 0, // 0 days offset = today
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
    
    html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code'+count+'" class="form-control hsn_code"></td>';
    html_code += '<td><input type="text" name="unit[]" id="unit'+count+'" class="form-control unit"></td>';
    html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
    html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
    html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
    
    html_code += '<td><input type="text" name="cgst_rate[]" id="cgst_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only cgst_rate" /></td>';
    html_code += '<td><input type="text" name="cgst_amt[]" id="cgst_amt'+count+'" data-srno="'+count+'" readonly class="form-control input-sm cgst_amt" /></td>';
    html_code += '<td><input type="text" name="sgst_rate[]" id="sgst_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only sgst_rate" /></td>';
    html_code += '<td><input type="text" name="sgst_amt[]" id="sgst_amt'+count+'" data-srno="'+count+'" readonly class="form-control input-sm sgst_amt" /></td>';
    html_code += '<td><input type="text" name="igst_rate[]" id="igst_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only igst_rate" /></td>';
    html_code += '<td><input type="text" name="total_gst_amt[]" id="total_gst_amt'+count+'" data-srno="'+count+'" readonly class="form-control input-sm total_gst_amt" /></td>';
    html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
    html_code += '</tr>';
    $('#tab_invoice tbody').append(html_code);
  });
  
  $(document).on('click', '.remove_row', function(){
    var row_id = $(this).attr("id");
    $('#row_id_'+row_id).remove();
    cal_final_total(count);
    count--;
    $('#total_item').val(count);
  });

  function cal_final_total(count)
  {
    var final_item_total = 0;
    var total_invoice_value = 0;
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
      var tax1_rate = 0;
      var tax1_amount = 0;
      var tax2_rate = 0;
      var tax2_amount = 0;
      var tax3_rate = 0;
      var tax3_amount = 0;
      var item_total = 0;
      quantity = $('#order_item_quantity'+j).val();
      if(quantity > 0)
      {
        price = $('#order_item_price'+j).val();
        if(price > 0)
        {
          actual_amount = parseFloat(quantity) * parseFloat(price);
          $('#order_item_actual_amount'+j).val(actual_amount);
          tax1_rate = $('#cgst_rate'+j).val();
          if(tax1_rate > 0)
          {
            tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
            $('#cgst_amt'+j).val(tax1_amount);
          }
          tax2_rate = $('#sgst_rate'+j).val();
          if(tax2_rate > 0)
          {
            tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
            $('#sgst_amt'+j).val(tax2_amount);
          }
          tax3_rate = $('#igst_rate'+j).val();
          if(tax3_rate > 0)
          {
            tax3_amount = parseFloat(actual_amount)*parseFloat(tax3_rate)/100;
            $('#igst_amount'+j).val(tax3_amount);
          }
          item_total = parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
          $('#total_gst_amt'+j).val(item_total);
          total_invoice_value = parseFloat(total_invoice_value) + parseFloat(actual_amount);
          total_cgst = parseFloat(total_cgst) + parseFloat(tax1_amount);
          total_sgst = parseFloat(total_sgst) + parseFloat(tax2_amount);
          total_igst = parseFloat(total_igst) + parseFloat(tax3_amount);
          $('#total_invoice_value').val(total_invoice_value);
          $('#total_taxable_value').val(total_invoice_value);
          $('#total_cgst').val(total_cgst);
          $('#total_sgst').val(total_sgst);
          $('#total_igst').val(total_igst);
          grand_total = parseFloat(total_invoice_value) + parseFloat(total_cgst) +parseFloat(total_sgst) + parseFloat(total_igst); 
          $('#grand_total').val(grand_total);
        }
      }
    }
  }

  $(document).on('blur', '.order_item_price', function(){
    cal_final_total(count);
  });

  $(document).on('blur', '.cgst_rate', function(){
    cal_final_total(count);
  });

  $(document).on('blur', '.sgst_rate', function(){
    cal_final_total(count);
  });

  $(document).on('blur', '.igst_rate', function(){
    cal_final_total(count);
  });

});