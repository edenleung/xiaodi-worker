<?php
namespace xiaodi\Worker\Exceptions;

use InvalidArgumentException;

class WorkerClassDoesNotExist extends InvalidArgumentException
{
    public static function create(string $className)
    {
        return new static("未找到 `{$className}` 类.");
    }
}