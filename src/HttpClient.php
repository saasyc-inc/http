<?php

namespace Yiche\Http;

use Yiche\Generate\Generate;
use Yiche\Http\Models\ERequest;

/**
 * 现在时间，毫秒
 */
if (!function_exists('nowTimeMicro')) {
    function nowTimeMicro()
    {
        return Carbon::now() . '.' . Carbon::now()->micro;
    }
}

/**
 * Http请求类
 *
 * Class HttpService
 * @package App\Services\Http
 * User: lifei
 * Date: 2018-11-28 12:57
 */
class HttpClient
{

    public $client; //Object
    public $res;
    public $headers = array(); //请求头
    public $method;
    public $url;

    public $status;

    public $log_data = [
        'id' => 0,
        'relation_id' => '',
        'type' => '2', //请求第三方
        'method' => '',
        'path' => '',
        'query' => '',
        'status' => '',
        'body' => '',
        'cookies' => '',
        'headers' => '',
        'ip' => '',
        'created_at' => '',
        'updated_at' => '',
        'finish_time' => '',
    ];

    public function __construct(array $config = [])
    {
        //todo 写入日志等
        $this->client = new \GuzzleHttp\Client($config);

        $this->log_data['id'] = Generate::id(61);
        $this->log_data['created_at'] = $this->log_data['updated_at'] = nowTimeMicro();
    }

    //发送get请求
    public function get($url, $data)
    {
        if (!empty($data)) {
            $url .= (stripos($url, '?') !== false) ? '&' : '?';
            $url .= (is_string($data)) ? $data : http_build_query($data, '', '&');
        }
        return $this->request('get', $url);
    }

    //发送post请求，$type:表单提交或者json，xml
    public function post($url, $data = [], $type = 'json')
    {
        $type = strtolower($type);
        if ($type == 'json') {
            $this->setHeader('Content-Type', 'application/json;charset=UTF-8');
            $options['body'] = $data;
        } elseif ($type == 'form_params') {
            $options['form_params'] = $data;
        } elseif ($type == 'xml') {
            $this->setHeader('Content-Type', 'application/xml');
            $options['body'] = $data;
        } elseif ($type == 'multipart') {
            $this->setHeader('Content-Type', 'multipart/form-data');
            $options['multipart'] = $data;
        }
        return $this->request('POST', $url, $options);
    }

    public function request($method, $url = '', array $options = [])
    {
        if ($this->headers) {
            $options['headers'] = $this->headers;
        }
        $this->res = $this->client->request($method, $url, $options);

        // 写入日志等,队列
        $this->method = $method;
        $this->url = $url;
        $this->setLogData($options);
        //  SapiRequestLogJob::dispatch($this->log_data); //分发队列 ->onQueue('low');
        $e_request = new ERequest;
        $e_request->insert($this->log_data);
        return $this->res;
    }

    public function getStatusCode()
    {
        return $this->status = $this->res->getStatusCode();
    }

    //设置请求头参数
    public function setHeader($k, $v)
    {
        $this->headers[$k] = $v;
    }

    //获取响应headers
    public function getHeaders()
    {
        return $this->res->getHeaders();
    }

    //获取响应headers
    public function getHeader($key)
    {
        $res_headers = $this->res->getHeaders();
        return $res_headers[$key][0];
    }

    //获取响应body
    public function getBody()
    {
        return $this->res->getBody();
    }

    //获取响应body contnets
    public function getContents()
    {
        return $this->res->getBody()->__toString();
    }

    public function setLogData($options)
    {
        if (is_array($this->headers)) {
            $this->log_data['headers'] = json_encode($this->headers);
        } else {
            $this->log_data['headers'] = $this->headers;
        }
        $this->log_data['method'] = $this->method;
        $this->log_data['path'] = $this->url;
        $query = '';
        if (isset($options['body'])) {
            $query = $options['body'];
        } elseif (isset($options['form_params'])) {
            $query = $options['form_params'];

        } elseif (isset($options['multipart'])) {
            $query = $options['multipart'];
        }
        $this->log_data['query'] = $query;
        $this->log_data['status'] = $this->getStatusCode();
        $this->log_data['body'] = $this->getContents();
        $this->log_data['finish_time'] = nowTimeMicro();
    }

}
