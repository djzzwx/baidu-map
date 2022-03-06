# baidu-map
百度地图 SDK.

## 环境要求

- PHP >= 7.2.5
- [Composer](https://getcomposer.org/)
- fileinfo 扩展

## 安装

```shell
$ composer require "rr-earring/baidu-map" -vvv
```

## 使用

```php
<?php
use RrEarring\BaiduMap\Factory;
$config = [
    'ak' => 'your ak',
//    'sk' => 'your sk',
    'log' => [
        'file' => './map.log',
        'name' => 'map.log',
    ],
    'response_type' => 'array',
];
$webApi = Factory::baiduApi($config);
$result = $webApi->geocoding->get('北京市海淀区上地十街10号');

//Array
//(
//    [status] => 0
//    [result] => Array
//(
//    [location] => Array
//    (
//        [lng] => 116.307887147
//                    [lat] => 40.0572204451
//                )
//
//            [precise] => 1
//            [confidence] => 80
//            [comprehension] => 100
//            [level] => 门址
//        )
//
//)
```

## Features
- [x] [Web服务API](http://lbsyun.baidu.com/index.php?title=webapi)

# Credits
This project was created with phpstorm with open source licence.
Thank you [jetBrains](https://www.jetbrains.com/)

![image.png](https://i.loli.net/2021/11/12/GwFznf5SNERQuLd.png)

## License

MIT
