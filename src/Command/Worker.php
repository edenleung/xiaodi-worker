<?php
namespace xiaodi\Worker\Command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class Worker extends Command
{
    protected $config;

    public function __construct($name = null)
    {
        $this->config = config('service.workers');

        parent::__construct($name);
    }

    protected function configure()
    {
        $services = array_keys($this->config);
        $des  = !empty($services) ? 'Workers:' . implode('|', $services) : '未检测到任何Worker!';

        $this->setName('service')
            ->addArgument('name', Argument::OPTIONAL, "worker name")
            ->addArgument('commands', Argument::OPTIONAL, "worker command")
            ->setDescription($des);
    }

    protected function execute(Input $input, Output $output)
    {
        global $argv;
        
        $class = $this->getWorkerClass($input);

        new $class;
        $argv[0] = __FILE__;
        $argv[1] = $this->getCommand($input);

        Worker::runAll();
    }

    /**
     * Undocumented function
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
     * Undocumented function
     *
     * @param Input $input
     * @return void
     */
    protected function getWorkerClass(Input $input)
    {
        $name = $input->getArgument('name');

        return $this->config[$name];
    }
}
