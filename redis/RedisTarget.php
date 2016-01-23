<?php
/**
 * @link http://github.com/JackyChan/yii2-redis-log
 * @copyright Copyright (c) 2016 Jacky <jacky.hf@gmail.com>
 * @license BSD
 */

namespace jc\yii\redis;

use Yii;
use yii\di\Instance;
use yii\log\Target;
use yii\redis\Connection;

/**
 * RedisTarget store log messages in a redis list.
 */
class RedisTarget extends Target
{
	/**
	 * @var Connection|array|string the Redis connection object or a configuration array for creating the object, or the application component ID of the Redis connection.
	 */
	public $redis = 'redis';
	
	/**
	 * @var string key of the Redis list to store log messages. Default to "log"
	 */
	public $key = 'log';
	
	/**
	 * Initializes the RedisTarget component.
	 * This method will initialize the [[redis]] property to make sure it refers to a valid Redis connection.
	 * @throws InvalidConfigException if [[redis]] is invalid.
	 */
	public function init() {
		parent::init();
		$this->redis = Instance::ensure($this->redis, Connection::className());
	}
	
	/**
	 * Stores log messages to Redis.
	 */
	public function export() {
		foreach ($this->messages as $message) {
			$text = $this->formatMessage($message);
			$this->redis->executeCommand('RPUSH', $this->key, $text);
		}
	}
}