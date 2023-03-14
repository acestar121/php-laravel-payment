<?php
namespace D3CR33\Payment\Exceptions;

use Exception;

class ZarinpalException extends Exception
{
    const MESSAGE = [
        "-1" => "اطلاعات ارسال شده ناقص است.",
        "-2" => "IP و يا مرچنت كد پذيرنده صحيح نيست",
        "-3" => "با توجه به محدوديت هاي شاپرك امكان پرداخت با رقم درخواست شده ميسر نمي باشد",
        "-4" => "سطح تاييد پذيرنده پايين تر از سطح نقره اي است.",
        "-11" => "درخواست مورد نظر يافت نشد.",
        "-12" => "امكان ويرايش درخواست ميسر نمي باشد.",
        "-21" => "هيچ نوع عمليات مالي براي اين تراكنش يافت نشد",
        "-22" => "تراكنش نا موفق ميباشد",
        "-33" => "رقم تراكنش با رقم پرداخت شده مطابقت ندارد",
        "-34" => "سقف تقسيم تراكنش از لحاظ تعداد يا رقم عبور نموده است",
        "-40" => "اجازه دسترسي به متد مربوطه وجود ندارد.",
        "-41" => "اطلاعات ارسال شده مربوط به AdditionalData غيرمعتبر ميباشد.",
        "-42" => "مدت زمان معتبر طول عمر شناسه پرداخت بايد بين 30 دقيه تا 45 روز مي باشد.",
        "-54" => "درخواست مورد نظر آرشيو شده است",
        "101" => "عمليات پرداخت موفق بوده و قبلا PaymentVerification تراكنش انجام شده است.",
    ];

    public function __construct(int $statusCode)
    {
        parent::__construct(self::getMessageFromStatusCode($statusCode));
    }

    /**
     * get message from status code
     * @param int $statusCode
     * @return string|null
     */
    public static function getMessageFromStatusCode(int $statusCode): string|null
    {
        return array_key_exists($statusCode, self::MESSAGE) ? self::MESSAGE[$statusCode] : null;
    }
}
