<?php
/**
 * Created by PhpStorm.
 * User: kay
 * Date: 2019/3/20
 * Time: 4:05 PM
 */

namespace Polaris\XmlRpc\Eloquent;

use Polaris\XmlRpc\SupervisorClientInterface;
use Zend\XmlRpc\Client;
use Zend\Http\Client as HttpClient;
use Illuminate\Contracts\Foundation\Application;
use Zend\Http\Client\Adapter\Exception\RuntimeException;

class SupervisorClientEloquent implements SupervisorClientInterface
{
    /**
     * @var Client $client
     */
    protected $client;
    /**
     * @var string
     */
    protected $server;
    /**
     * @var string
     */
    protected $port;
    /**
     * @var string
     */
    protected $user;
    /**
     * @var string
     */
    protected $password;

    /**
     * ClientEloquent constructor.
     * @param Application $application
     * @param HttpClient $httpClient
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(Application $application, HttpClient $httpClient)
    {
        $this->setConfig();
        if ($this->user) {
            $httpClient->setAuth($this->user, $this->password);
        }
        $this->client = $application->make(
            Client::class,
            [
                'server'=> $this->server . ":" . $this->port,
                'client' => $httpClient
            ]
        );
    }

    /**
     * 执行
     *
     * @param $method
     * @param array $params
     * @return mixed
     */
    public function exec($method, $params = [])
    {
        try {
            return $this->client->call($method, $params = []);
        } catch (RuntimeException $exception) {
            throw $exception;
        }
    }

    /**
     * 配置
     */
    protected function setConfig()
    {
        $config = config('supervisor');

        $this->server = $config['server'];
        $this->port = $config['port'];
        $this->user = $config['user'];
        $this->password = $config['password'];
    }
}