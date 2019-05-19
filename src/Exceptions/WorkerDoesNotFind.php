<?php
namespace xiaodi\Worker\Exceptions;

use InvalidArgumentException;

class WorkerDoesNotFind extends InvalidArgumentException
{
    public static function create()
    {
        return new static("缺少启动服务名称");
    }
}