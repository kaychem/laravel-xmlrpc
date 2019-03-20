<?php
/**
 * Created by PhpStorm.
 * User: kay
 * Date: 2019/3/20
 * Time: 4:05 PM
 */

namespace Polaris\XmlRpc;

interface SupervisorClientInterface
{
    /**
     * 执行
     *
     * @param $method
     * @param array $params
     * @return mixed
     */
    public function exec($method, $params = []);
}