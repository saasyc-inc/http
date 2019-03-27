<?php

namespace Yiche\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Yiche\TableShard\Models\SapiDbTbl;

class ERequest extends Model
{

    public $timestamps = false;
    protected $table = 'e_request';

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
