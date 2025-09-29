<div id="payment-app" class="card">
    <div class="card-header">支付配置新增/修改</div>
    <div class="card-body">
        <form class="needs-validation"
              action="{{ $payment->id? url('admin/payment/update/'.$payment->id): url('admin/payment/save') }}"
              method="POST">
            @csrf
            <div class="form-group">
                <label>显示名称</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>排序</label>
                <input type="number" class="form-control" name="sort">
            </div>

            <div class="form-group">
                <label>支付接口</label>
                <select name="payment" id="" class="form-control short wp-400">
                    <option value="0">--请选择支付接口--</option>
                    @foreach ($payment_configs as $key=>$value)
                        @if ($payment->id)
                            <option value="{{ $key }}" {{ $key == $payment->payment ? 'selected' : '' }}>{{ $key }}</option>
                        @else
                            <option value="{{ $key }}">{{ $key }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-extend">

            </div>
            <div class="box-footer row d-flex">
                <div class="col-md-2"> &nbsp;</div>
                <div class="col-md-8"><button type="reset" class="btn btn-white pull-left"><i class="feather icon-rotate-ccw"></i> 重置</button><button type="submit" class="btn btn-primary pull-right"><i class="feather icon-save"></i> 提交</button></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function (){

        $('select[name="payment"]').on('change',function(val){
            let payment_configs=JSON.parse('<?php echo json_encode($payment_configs); ?>');
            let payment_config=payment_configs[$(this).val()];
            $('div.form-extend').empty();
            for (let key in payment_config) {
                let div = $('<div class="form-group"></div>');
                $(div).append('<label>'+payment_config[key]['label']+'</label>');
                $(div).append(' <input placeholder="'+payment_config[key]['description']+'" type="text" class="form-control" name="config['+key+']"/> ');
                $('div.form-extend').append($(div));
            }
        });
    });
</script>