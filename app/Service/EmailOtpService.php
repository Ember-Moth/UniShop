<?php

namespace App\Service;
use App\Exceptions\RuleValidationException;
use App\Jobs\MailSend;
use App\Models\EmailOtpLog;
use App\Models\Emailtpl;
use App\Models\Emailtpl as EmailTplModel;
use App\Models\EmailOtpLog as EmailOtpLogModel;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailOtpService
{
    /**
     * @var EmailtplService
     */
    private $emailtplService;

    public function __construct()
    {
        $this->emailtplService = app(EmailtplService::class);
    }

    /**
     * 发邮件验证码
     * @param string $email
     * @param string $type
     * @return int
     * @throws RuleValidationException
     */
    public function sendEmailOtp($email, $type){
        $log = EmailOtpLogModel::query()
            ->where('email', $email)
            ->where("type",$type)
            ->orderBy("created_at", "desc")
            ->first();

        //已经发送验证码短信的情况
        if ($log) {
            if (time() - strtotime((string)$log->created_at) < $log->resend_time && $log->is_used === 0) {
                throw new RuleValidationException('发送失败，不要重复发送');
            }
        }

        $code = rand(100000, 999999);
        $data=[
            'email'=>$email,
            'code'=>$code,
            'type'=>$type,
            'status'=>1,
            'resend_time'=>60,
            'expire_time'=>600,
            'created_at'=>date("Y-m-d H:i:s"),
        ];
        $emailOtpLogId = EmailOtpLog::query()->insertGetId($data);

        $tpl = $this->emailtplService->detailByToken('mail_otp_'.$type);
        Log::info('mail_otp_'.$type);
        $mailBody = replace_mail_tpl($tpl, $data);
        Log::info($mailBody);
        // 邮件发送
        $this->smtpSend($email, $mailBody['tpl_name'], $mailBody['tpl_content']);
        return $emailOtpLogId;
    }

    /**
     * Check Email OTP
     *
     * @param string $email
     * @param string $type
     * @param string $code
     * @return bool
     * @throws RuleValidationException
     */
    public function checkEmailOtp($email, $type,$code){
        $log = EmailOtpLogModel::where('email', $email)
            ->where("type",$type)
            ->where("is_used",0)
            ->orderBy("id", "desc")
            ->first();
        Log::info($log);
        //已经发送验证码短信的情况
        if (!$log) {
            throw new RuleValidationException('请重新获取验证码');
        }
        if ($log['code'] !== $code)
            throw new RuleValidationException('验证码错误');//验证码错误

        //sms过期时间设置
        if (strtotime(date("Y-m-d H:i:s")) - strtotime((string)$log['created_at']) > $log['expire_time']) {
            throw new RuleValidationException('验证码过期');//驗證碼過期
        }
        $log->is_used = 1;
        $log->save();

        return true;
    }

    /**
     * 发邮件
     * @param $to
     * @param $title
     * @param $body
     * @return void
     * @throws \Exception
     */
    public function smtpSend($to,$title,$body)
    {
        $sysConfig = cache('system-setting');
        $mailConfig = [
            'driver' => $sysConfig['driver'] ?? 'smtp',
            'host' => $sysConfig['host'] ?? '',
            'port' => $sysConfig['port'] ?? '465',
            'username' => $sysConfig['username'] ?? '',
            'from'      =>  [
                'address'   =>   $sysConfig['from_address'] ?? '',
                'name'      =>  $sysConfig['from_name'] ?? '独角发卡'
            ],
            'password' => $sysConfig['password'] ?? '',
            'encryption' => $sysConfig['encryption'] ?? 'ssl'
        ];
        //  覆盖 mail 配置
        config([
            'mail'  =>  array_merge(config('mail'), $mailConfig)
        ]);
        // 重新注册驱动
        (new MailServiceProvider(app()))->register();
        Mail::send(['html' => 'email.mail'], ['body' => $body], function ($message) use ($to, $title){
            $message->to($to)->subject($title);
        });
    }
}