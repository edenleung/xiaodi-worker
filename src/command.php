<?php

// 注册命令行命令

\think\Console::addDefaultCommands([
    'service:run' => \xiaodi\Worker\Command\Worker::class
]);
