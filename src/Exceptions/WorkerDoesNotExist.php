<?php
namespace xiaodi\Worker\Exceptions;

use InvalidArgumentException;

class WorkerDoesNotExist extends InvalidArgumentException
{
    public static function create(string $workerName)
    {
        return new static("未配置 `{$workerName}` 对应的worker类.");
    }
}