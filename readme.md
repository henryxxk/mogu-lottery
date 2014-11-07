## 基于AngularJS + Laravel 实现的抽奖程序

这是一个非常小的程序，利用了目前比较流行的一些技术实现。
其实本来不需要使用到这些技术的，主要是考虑在实际项目中已经开始逐步使用起来，写起来效率也蛮高的。


对于技术方面的资料，大家可以前往以下网站获得:

* [AngularJS 中文参考资料](http://www.ngnice.com)
* [Laravel 中文资料站](http://golaravel.com)
* [Bower 官方网站 ](http://bower.io/)


### 功能说明

* 支持创建多轮抽奖,每轮抽奖可以多次开奖，每次开奖可以设定中奖人数
* 可以方便控制每轮抽奖的启动
* 每次开奖点击开始后，10s后自动结束


### 部署说明

#### 数据库

本程序使用的数据库为MySQL，初始化脚本位于`app/storage/data/init.sql`

#### 应用部署

* 保证`app/storage` 目录具有可写权限
* 创建`public/bower_resources`目录,用于下载安装bower管理的前端资源文件.
* 目前参与抽奖者信息是直接编写在代码中，位于`app/controllers/LotteryController.php` line 46 行左右


### 软件许可

本程序的协议基于 [MIT license](http://opensource.org/licenses/MIT)
