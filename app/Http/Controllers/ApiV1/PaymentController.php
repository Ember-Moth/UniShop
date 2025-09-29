<?php

namespace App\Http\Controllers\ApiV1;

use App\Exceptions\RuleValidationException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
//use App\Payments\PaymentException;
use App\Service\OrderProcessService;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * 订单
     * @var \App\Models\Order
     */
    protected $order;
    /**
     * 订单服务层
     * @var \App\Service\OrderService
     */
    protected $orderService;

    /**
     * 订单处理层.
     * @var OrderProcessService
     */
    protected $orderProcessService;

    public function __construct()
    {
        $this->orderService        = app('Service\OrderService');
        $this->orderProcessService = app('Service\OrderProcessService');
    }

    /**
     * 获取支付方式
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaymentMethods(Request $request)
    {
        try {
            $methods = Payment::query()->where('enable', 1)->select(["id",'name'])->orderBy('sort', 'desc')->get();

            return response()->json([
                'code' => 200,
                'message' => '获取成功',
                'data' => $methods
            ]);
        } catch (\Exception $e) {
            Log::error('获取支付方式失败', ['error' => $e->getMessage()]);
            return response()->json([
                'code' => 500,
                'message' => '获取支付方式失败'
            ], 500);
        }
    }


    /**
     * 创建支付
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPayment(Request $request)
    {
        $orderSN = $request->input('order_sn');
        $payway = $request->input('payway',0);
        try {
            $this->checkOrder($orderSN);
            if($this->order->user_id>0)
                throw new \Exception('订单不正确');
            $bccomp = bccomp($this->order->actual_price, 0.00, 2);
            // 如果订单金额为0 代表无需支付，直接成功
            if ($bccomp == 0) {
                $this->orderProcessService->completedOrder($this->order->order_sn, 0.00);
//                return redirect(url('detail-order-sn', ['orderSN' => $this->order->order_sn]));
                return response()->json([
                    'code' => 200,
                    'message' => '创建成功',
                    'data' => [
                        'order_sn' => $this->order->order_sn,
                        'email' => $this->order->email,
                        'title' => $this->order->title,
                        'buy_amount' => $this->order->buy_amount,
                        'payment' => $this->order->payment->name,
                        'created_at' => $this->order->payment->created_at,
                        'type_txt' => $this->order->type == \App\Models\Order::AUTOMATIC_DELIVERY?__('goods.fields.automatic_delivery'):__('goods.fields.manual_processing'),
                        'type' => $this->order->type,
                        'actual_price' => $this->order->actual_price,
                        'status' => $this->order->status,
                    ]
                ]);
            }

            if($payway>0){
                $payment = Payment::find($payway);
                if (!$payment || $payment->enable !== 1)
                    return response()->json([
                        'code' => 500,
                        'message' => __('Payment method is not available'),
                        'data' => null
                    ], 500);
                $this->order->pay_id = $payway;
                $this->order->save();
            }

            $payment = Payment::find($this->order->pay_id);
            if (!$payment || $payment->enable !== 1)
                return response()->json([
                    'code' => 500,
                    'message' => __('Payment method is not available'),
                    'data' => null
                ], 500);
            $paymentService = new PaymentService($payment->payment, $payment->id);
            $result = $paymentService->pay([
                'trade_no' => $orderSN,
                'total_amount' =>  $this->order->actual_price,
                'user_id' => 0,//$this->order->user_id,
//                'stripe_token' => $request->input('token')
            ]);
            return response()->json([
                'code' => 200,
                'message' => '创建成功',
                'data' => $result
            ]);
        } catch (\Exception $exception) {
            Log::error('创建支付失败', ['error' => $exception->getMessage()]);
            Log::error('创建支付失败', ['error' => $exception->getTraceAsString()]);
            return response()->json([
                'code' => 500,
                'message' => $exception->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function userCreatePayment(Request $request)
    {
        $user = $request->user();
        $orderSN = $request->input('order_sn');
        $payway = $request->input('payway',0);

        Log::info('user创建支付', ['orderSN' => $orderSN, 'payway' => $payway]);
        try {
            $this->checkOrder($orderSN,$user->id);
            Log::info('order', ['order' => $this->order]);
            if($this->order->user_id != $user->id){
                throw new \Exception('订单不正确');
            }

            $bccomp = bccomp($this->order->actual_price, 0.00, 2);
            // 如果订单金额为0 代表无需支付，直接成功
            if ($bccomp == 0) {
                $this->orderProcessService->completedOrder($this->order->order_sn, 0.00);
                return response()->json([
                    'code' => 200,
                    'message' => '创建成功',
                    'data' => [
                        'order_sn' => $this->order->order_sn,
                        'email' => $this->order->email,
                        'title' => $this->order->title,
                        'buy_amount' => $this->order->buy_amount,
                        'payment' => $this->order->payment->name,
                        'created_at' => $this->order->payment->created_at,
                        'type_txt' => $this->order->type == \App\Models\Order::AUTOMATIC_DELIVERY?__('goods.fields.automatic_delivery'):__('goods.fields.manual_processing'),
                        'type' => $this->order->type,
                        'actual_price' => $this->order->actual_price,
                        'status' => $this->order->status,
                    ]
                ]);
            }

            if($payway>0){
                $payment = Payment::find($payway);
                if (!$payment || $payment->enable !== 1)
                    return response()->json([
                        'code' => 500,
                        'message' => __('Payment method is not available'),
                        'data' => null
                    ], 500);
                $this->order->pay_id = $payway;
                $this->order->save();
            }

            $payment = Payment::find($this->order->pay_id);
            if (!$payment || $payment->enable !== 1)
                return response()->json([
                    'code' => 500,
                    'message' => __('Payment method is not available'),
                    'data' => null
                ], 500);
            
            $paymentService = new PaymentService($payment->payment, $payment->id);
            
            // 对于余额支付，直接在这里处理
            if ($payment->payment === 'BalancePay') {
                $result = $paymentService->pay([
                    'order_sn' => $orderSN,
                    'trade_no' => $orderSN,
                    'total_amount' => $this->order->actual_price,
                    'user_id' => $user->id,
                ]);
                Log::info("对于余额支付，直接在这里处理",["res"=>$result]);
                
                // 如果余额支付成功
                if (isset($result['type']) && $result['type'] == 2) {
                    $this->orderProcessService->completedOrder(
                        $this->order->order_sn, 
                        $this->order->actual_price,
                        $result['data']['trade_no'],
                        $this->order->user_id
                    );
                    
                    return response()->json([
                        'code' => 200,
                        'message' => '支付成功',
                        'data' => [
                            'order_sn' => $this->order->order_sn,
                            'amount' => $result['data']['amount'],
                            'balance_after' => $result['data']['balance_after'],
                            'type' => 'balance_pay_success'
                        ]
                    ]);
                } else {
                    return response()->json([
                        'code' => 400,
                        'message' => $result['error'] ?? '余额支付失败',
                        'data' => null
                    ], 400);
                }
            }
            
            // 其他支付方式
            $result = $paymentService->pay([
                'trade_no' => $orderSN,
                'total_amount' =>  $this->order->actual_price,
                'user_id' => 0,//$this->order->user_id,
            ]);
            return response()->json([
                'code' => 200,
                'message' => '创建成功',
                'data' => $result
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'message' => $exception->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * 订单检测
     *
     * @param string $orderSN
     * @throws RuleValidationException
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function checkOrder(string $orderSN,$userId=0)
    {
        // 订单
        $this->order = $this->orderService->detailOrderSN($orderSN,$userId);
        if (!$this->order) {
            throw new RuleValidationException(__('dujiaoka.prompt.order_does_not_exist'));
        }
        // 订单过期
        if ($this->order->status == Order::STATUS_EXPIRED) {
            throw new RuleValidationException(__('dujiaoka.prompt.order_is_expired'));
        }
        // 已经支付了
        if ($this->order->status > Order::STATUS_WAIT_PAY) {
            throw new RuleValidationException(__('dujiaoka.prompt.order_already_paid'));
        }
    }


    public function searchOrderBySN(Request $request)
    {
        try {
            return $this->detailOrderSN($request->input('order_sn'));
        } catch (RuleValidationException $exception) {
            return response()->json([
                'code' => 500,
                'message' => $exception->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * 根据订单号获取订单
     *
     * @param string $orderSN
     * @return mixed
     */
    public function detailOrderSN(string $orderSN)
    {
        $order = $this->orderService->detailOrderSN($orderSN);
        // 订单不存在或者已经过期
        if (!$order) {
            throw new RuleValidationException(__('dujiaoka.prompt.order_does_not_exist'));
        }
        return [
            'order_sn'=>$orderSN,
            'status'=>$order->status
        ];
    }
}
