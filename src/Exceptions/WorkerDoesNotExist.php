<?php
namespace xiaodi\Worker\Exceptions;

use InvalidArgumentException;

class WorkerDoesNotExist extends InvalidArgumentException
{
    public static function create(string $workerName)
    {
        return new static("找不到 `{$workerName}` 类.");
    }
}