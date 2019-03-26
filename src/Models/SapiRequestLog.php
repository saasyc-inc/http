<?php

namespace Yiche\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Yiche\TableShard\Models\SapiDbTbl;

class SapiRequestLog extends Model
{

    public $timestamps = false;
    protected $table = 'sapi_request_log';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = SapiDbTbl::tblNameLatest($this->table);

    }

    // //存日志
    // public  store($data)
    // {
    //     if (empty($data)) {
    //         return false;
    //     }
    //     self::insert($data);
    // }
}
