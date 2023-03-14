<?php
namespace D3CR33\Payment\Requests;

use Exception;
use D3CR33\Payment\Exceptions\PaymentRequestException;
use D3CR33\Payment\Port\PortConfig;

final class PaymentRequest
{
    /**
     * store userId
     * @var int
     */
    public int $userId;

    /**
     * store modelType
     * @var string
     */
    public string $modelType;

    /**
     * store modelId
     * @var int
     */
    public int $modelId;

    /**
     * store module unique id ( which module call payment )
     * @var int
     */
    public int $module;

    /**
     * store amount
     * @var int
     */
    public int $amount;

    /**
     * store description
     * @var string
     */
    public string $description;

    /**
     * store port
     * @var int
     */
    public int $port;

    /**
     * set available module
     * @var array
     */
    private const MODULE = [
        'management' => 112,
        'salon' => 113
    ];

    public function __construct(array $paymentData)
    {
        $this->setUp($paymentData);
    }

    /**
     * set property from payment data
     * @param array $paymentData
     * @return void
     */
    public function setUp(array $paymentData): void
    {
        try{
            $this->userId = $paymentData['user_id'];
            $this->modelType = $paymentData['model_type'];
            $this->modelId = $paymentData['model_id'];
            $this->module = $this->checkModule($paymentData['module']);
            $this->amount = $paymentData['amount'];
            $this->description = $paymentData['description'];
            $this->port = $this->checkPort($paymentData['port']);
        }catch(Exception $e){
            throw new PaymentRequestException($e);
        }
    }

    /**
     * check module is available or not
     * @param string $module
     * @return int
     */
    public function checkModule(string $module): int
    {
        try{
            return self::MODULE[$module];
        }catch(Exception $e){
            throw new PaymentRequestException("module data ($module) is not valid data");
        }
    }

    /**
     * check port is available or not
     * @param int $port
     * @return int
     */
    public function checkPort(int $port): int
    {
        if ( key_exists($port, PortConfig::AVAILABLE_PORT) ){
            return $port;
        } else {
            throw new PaymentRequestException("port id ($port) is not valid data");
        }
    }

    /**
     * to array paymentRequest object
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'   =>  $this->userId,
            'model_type'    =>  $this->modelType,
            'model_id'  =>  $this->modelId,
            'module'    =>  $this->module,
            'amount'    =>  $this->amount,
            'description'   =>  $this->description,
            'port'  =>  $this->port
        ];
    }
}