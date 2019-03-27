# http

http请求




## 集成
```shell
composer require yiche/http 1.0
```


## 使用

```shell
use Yiche\Http\HttpClient;

//get
$http = new HttpClient();
$body = $http->get('https://www.baidu.com', ['a' => '111']);

//post
$http = new HttpClient();
$body = $http->post('https://www.baidu.com', json_encode(['a' => '111']));

```

