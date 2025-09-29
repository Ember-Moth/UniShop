<script src="{{ asset('assets/vue/2.7/vue' . (!config('app.debug') ? '.min' : '') . '.js') }}"></script>
<div id="payment-app" class="card">
    <div class="card-header">支付配置新增/修改</div>
    <div class="card-body">
        <select @change="handleChange">
            <option value="option1">选项1</option>
            <option value="option2">选项2</option>
            <option value="option3">选项3</option>
        </select>
        <form class="needs-validation"
              :model="form"
              method="POST">
            <div class="form-group">
                <label>显示名称</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>显示名称</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>支付接口</label>
                <select @change="handlePaymentChange" @click="onClick" name="payment" id="" class="form-control short wp-400">
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
        </form>
    </div>
</div>
<script>
    (function() {
        var vm = new Vue({
            el: '#app',
            components: {},
            data() {
                return {
                    selectedOption: "",
                    form: {
                        name: "test",
                        payment_configs:<?php echo json_encode($payment_configs); ?>,
                    }
                }
            },
            methods: {
                handleChange(event) {
                    this.selectedOption = event.target.value;
                },
                handlePaymentChange: (event) => {
                    debugger;
                },
                onClick() {
                    debugger;
                }
            }
        });
    })()
</script>