<?php
class ProcessRequestOneExistPool
{
    private $worker = [];
    private $work_num = 0;
    private $start_time = null;
 
    public function __construct($work_num)
    {
        $this->work_num = $work_num;
    }
 
    public function start($callable)
    {
        $this->start_time = microtime(true);
 
        for ($i=0;$i<$this->work_num;$i++)
        {
            $this->startWorker($i,$callable);
        }
 
        \swoole_process::signal(SIGCHLD, function ($sig) {
            while (true)
            {
                $ret = \swoole_process::wait(false);
                if($ret)
                {
                    if(isset($ret['pid']))
                    {
                        if(array_key_exists($ret['pid'],$this->worker))
                        {
                            unset($this->worker[$ret['pid']]);
                        }
 
                        if(empty($this->worker) || count($this->worker)==0)
                        {
                            echo "all poll work process end,now exit!!".PHP_EOL;
                            echo "cost time:".(microtime(true) - $this->start_time)." s".PHP_EOL;
                            exit;
                        }
                    } else {
                        break;
                    }
                } else {
                    break;
                }
            }
        });
    }
 
    private function startWorker($i,$callable)
    {
        $process = new \swoole_process(function (\swoole_process $process) use ($i,$callable) {
            call_user_func_array($callable,[$i]);
        }, false,0);
        $child_pid = $process->start();
        $this->worker[$child_pid] = $process;
    }
}
 
$s = new ProcessRequestOneExistPool(20);
echo "start time:".microtime(true).PHP_EOL;
$s->start(function () {
    sleep(1);
    echo "my is ".func_get_args()[0]." process,pid:".getmypid().PHP_EOL;
});
