# xiaodi-worker
ThinkPHP5.1 命令行启动多个Workerman 服务

[![Latest Stable Version](https://poser.pugx.org/xiaodi/xiaodi-worker/v/stable)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Total Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/downloads)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Latest Unstable Version](https://poser.pugx.org/xiaodi/xiaodi-worker/v/unstable)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)
[![Monthly Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/d/monthly)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Daily Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/d/daily)](https://packagist.org/packages/xiaodi/xiaodi-worker)

### 安装
```
composer require xiaodi/xiaodi-worker
```

### 配置
以下使用了[think-worker包](https://github.com/top-think/think-worker/tree/2.0)  
`application/Worker/Http.php`

```php
<?php
namespace app\Worker;

use think\worker\Server;

class Http extends Server
{
    protected $socket = 'http://0.0.0.0:55555';

    public function onMessage($connection,$data)
    {
      $connection->send(json_encode($data));
    }
}

```

`config/service.php`  

`Http`: 服务名称 `\app\Worker\Http`: 服务的具体命名空间  

```php
<?php

return [
  'Http' => '\app\Worker\Http'
];
```
### 命令
`参数一` 服务名称  
`参数二` 命令 如 [start|stop|reload|restart|status]  
`参数三` 是否守护进程模式  

`php think service:run 参数一 参数二 参数三`

### 启动
原生支持的命令 [start|stop|reload|restart|status]
```sh
php think service:run Http start
```

### 守护进程
```sh
php think service:run Http start -d
```
