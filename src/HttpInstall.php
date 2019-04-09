<?php

namespace Yiche\Http;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Yiche\Config\Models\SapiConfig;
use Yiche\Http\Models\ERequest;

class HttpInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yiche:http-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'http请求';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sql = dirname(__DIR__) . '/database/sql/http.sql';
        //
        $model     = new ERequest();
        $tableName = $model->getTable();
        if (Schema::hasTable($tableName)) {
            dd("{$tableName}表已经存在");
        }
        DB::unprepared(file_get_contents($sql));
    }
}
