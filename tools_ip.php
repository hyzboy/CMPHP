<?php

    /**
     * 获取用户真实 IP
     */
    function get_real_ip()
    {
        if (isset($_SERVER))
        {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            else
            if (isset($_SERVER["HTTP_CLIENT_IP"]))
            {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            }
            else
            {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        }
        else
        {
            if (getenv("HTTP_X_FORWARDED_FOR"))
            {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }
            else
            if (getenv("HTTP_CLIENT_IP"))
            {
                $realip = getenv("HTTP_CLIENT_IP");
            }
            else
            {
                $realip = getenv("REMOTE_ADDR");
            }
        }

        return $realip;
    }

    /*
    *根据新浪IP查询接口获取IP所在地
    */
    function getIPLoc($queryIP)
    {
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP;

        $ch = curl_init($url);

        //curl_setopt($ch,CURLOPT_ENCODING ,'utf8');

        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回

        $location = curl_exec($ch);

        if($location[0]=='-')return $location;

        $location = json_decode($location);

        curl_close($ch);

        $loc = "";

        if($location===FALSE) return "未知";

        if (empty($location->desc))
        {
            $loc = $location->province.$location->city.$location->district.$location->isp;
        }
        else
        {
            $loc = $location->desc;
        }

        return $loc;
    }

    function get_ip_local($ip)
    {
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回
        $result=json_decode(curl_exec($ch));

        if((string)$result->code=='1')
            return false;

        return (array)$result->data;
    }

//     $ip=$_GET["IP"];
//
//     echo 'IP: '.$ip.'<br/>';
//
//     $obj=get_ip_local($ip);
//
//     if($ip==false)
//     {
//         echo "erro";
//         return;
//     }
//
//     echo 'country:'.$obj["country"].'<br/>';
//     echo 'area:'.$obj["area"].'<br/>';
//     echo 'region:'.$obj["region"].'<br/>';
//     echo 'city:'.$obj["city"].'<br/>';
//     echo 'isp:'.$obj["isp"].'<br/>';
