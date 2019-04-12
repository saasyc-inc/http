# http

http请求




## 集成
```shell
composer require yiche/http:dev-master
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

# 版本更新
### 1.1版本
 - $http->setReqSaveLog(true/false);动态关闭该服务是否写入查询日志
 - 修复日志写入生成id构造方法放入具体调用生成
