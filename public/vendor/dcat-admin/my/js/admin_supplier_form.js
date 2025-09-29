$(document).ready(function (){
    var val=$('select[name="method"]').val();
    if(!val){
        $('.form-extend-config').parent().parent().parent().hide();
    }else{
        $('.form-extend-config').parent().parent().parent().hide();
        $('.form-extend-config-'+val).parent().parent().parent().show();
    }
    $('select[name="method"]').on('change',function(){
        var v=$(this).val();
        $('.form-extend-config').parent().parent().parent().hide();
        $('.form-extend-config-'+v).parent().parent().parent().show();
    });
});