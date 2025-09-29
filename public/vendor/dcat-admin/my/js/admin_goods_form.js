$(document).ready(function (){
    $('input[name="supplier_price_type_rule"]').blur(function() {
        var type = $('input[name="supplier_price_type"]:radio:checked').val();
        if(type==1){
            console.log('price_type_1',parseFloat($('input[name="supplier_price"]').val())+parseFloat($(this).val()));
            $('input[name="actual_price"]').val(parseFloat($('input[name="supplier_price"]').val())+parseFloat($(this).val()));

        }
        else{
            console.log('price_type_2',parseFloat($('input[name="supplier_price"]').val())*parseFloat($(this).val()));
            $('input[name="actual_price"]').val(parseFloat($('input[name="supplier_price"]').val())*parseFloat($(this).val()));

        }
    });

});