<?php
/**
 * 鉴权类
 * User: 苏近之
 * Date: 2018/10/22
 * Time: 10:30
 */

namespace JinZhiSu\ALiDaYuSms;

class Auth
{

    // AK 和 SK 从阿里云控制台获取
    protected $ak = null;
    protected $sk = null;


    /**
     * 构造函数
     * @param $ak
     * @param $sk
     */
    public function __construct($ak, $sk)
    {
        $this->ak = $ak;
        $this->sk = $sk;
    }

    /**
     * 获取 AK
     * @return null|string
     */
    public function getAk()
    {
        return $this->ak;
    }

    /**
     * 获取SK
     * @return null|string
     */
    public function getSk()
    {
        return $this->sk;
    }

}