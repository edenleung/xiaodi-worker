# xiaodi-worker
ThinkPHP5.1 命令行启动多个Worker

[![Latest Stable Version](https://poser.pugx.org/xiaodi/xiaodi-worker/v/stable)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Total Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/downloads)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Latest Unstable Version](https://poser.pugx.org/xiaodi/xiaodi-worker/v/unstable)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![License](https://poser.pugx.org/xiaodi/xiaodi-worker/license)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Monthly Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/d/monthly)](https://packagist.org/packages/xiaodi/xiaodi-worker)
[![Daily Downloads](https://poser.pugx.org/xiaodi/xiaodi-worker/d/daily)](https://packagist.org/packages/xiaodi/xiaodi-worker)

### 安装
```
composer require xiaodi/xiaodi-worker:dev-master
```

### 配置
`config/service.php`
```php
<?php

return [
  'Http' => '\app\Worker\Http'
];
```

### 启动
```sh
php think service Http start
```

### 守护进程
```sh
php think service Http start -d
```
