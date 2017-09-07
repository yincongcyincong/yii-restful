<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Yii;

class SwooleController extends Controller 
{
	private $consume;

	public function actionConsume()
	{
		$this->consume = new \Swoole\Process(function($work){
			while (1) {
				$data = $work->pop();
				if ($data == 'done') {
					//子进程停止
					$work->exit(0);
				} else {
					//消费者业务逻辑
					echo $data;
				}
			}
		});	
		$this->consume->useQueue(1);
		$this->consume->start();
		//阻塞并防止僵尸进程
		$this->consume->wait();
	}

	public function actionProduct()
	{
		$product  = new \Swoole\Process(function($work){
			//声称这业务逻辑
			$work->push('done');
			$work->exit(0);
		});
		$product->useQueue(1);
		$product->start();
		$product->wait();
	}
}
