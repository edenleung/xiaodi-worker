<?php
namespace xiaodi\Worker\Command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use xiaodi\Worker\Exceptions\WorkerDoesNotExist;
use xiaodi\Worker\Exceptions\WorkerClassDoesNotExist;

class Worker extends Command
{
    protected $config;

    public function __construct($name = null)
    {
        $this->config = !empty(config('service.')) ? config('service.') : [];

        parent::__construct($name);
    }

    protected function configure()
    {
        $services = array_keys($this->config);
        $des  = !empty($services) ? 'Workers:' . implode('|', $services) : '未配置任何Worker!';

        $this->setName('service')
            ->addArgument('name', Argument::REQUIRED, "worker name.")
            ->addArgument('commands', Argument::OPTIONAL, "workerman worker command.")
            ->addOption('-d', '-d', Option::VALUE_OPTIONAL, 'workerman worker in daemon mode.', '-d')
            ->setDescription($des);
    }

    protected function execute(Input $input, Output $output)
    {
        $class = $this->getWorkerClass($input);
        $command = $this->getCommand($input);

        $this->start($class, $command);
    }

    /**
     * 执行服务
     *
     * @param [type] $class
     * @param [type] $command
     * @return void
     */
    protected function start($class, $command = '')
    {
        global $argv;
        $argv[0] = __FILE__;

        if (false === $this->isWin()) {
            $argv[1] = $command;

            // 开启守护进程模式
            if ($this->input->hasOption('-d')) {
                \Workerman\Worker::$daemonize = true;
            }
        }
       
        $worker = new $class;

        \Workerman\Worker::runAll();
    }

    /**
     * 获取命令
     *
     * @param Input $input
     * @return void
     */
    protected function getCommand(Input $input)
    {
        $command = $input->getArgument('commands');

        return $command;
    }

    /**
     * 获取启动Worker名称
     *
     * @param Input $input
     * @return void
     */
    protected function getWorkerClass(Input $input)
    {
        $name = $input->getArgument('name');

        if (!isset($this->config[$name])) {
            throw WorkerDoesNotExist::create($name);
        }

        $class = $this->config[$name];
        if (false === class_exists($class)) {
            throw WorkerClassDoesNotExist::create($class);
        }

        return $this->config[$name];
    }

    /**
     * 是否windows环境
     *
     * @return boolean
     */
    protected function isWin()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return true;
        }

        return false;
    }
}
