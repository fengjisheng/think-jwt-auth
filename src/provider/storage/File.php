<?php

namespace thans\jwt\provider\storage;


use thans\jwt\contract\Storage;
use think\facade\Cache;

class File implements Storage
{
    /**
     * 缓存驱句柄
     * @var Cache
     */
    protected $handler;

    public function __construct()
    {
        $this->handler = Cache::store('file');
    }

    public function getKey($key)
    {
        return 'JWT_TOKEN_' . $key;
    }

    public function delete($key)
    {
        $key = $this->getKey($key);
        return $this->handler->delete($key);
    }

    public function get($key)
    {
        $key = $this->getKey($key);
        return $this->handler->get($key);
    }

    public function set($key, $val, $time = 0)
    {
        $key = $this->getKey($key);
        return $this->handler->tag('JWT')->set($key, $val, $time);
    }
}
