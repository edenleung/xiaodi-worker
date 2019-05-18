# xiaodi-worker
ThinkPHP5.1 命令行启动多个Worker

### 安装
```
composer require xiaodi/xiaodi-worker:dev
```

### 配置
`config/service`
```php
<?php

return [
  'workers' => [
    'Http' => '\app\Worker\Http'
  ]
];
```

### 启动
```sh
php think service Http start
```
