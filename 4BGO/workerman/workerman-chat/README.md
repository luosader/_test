workerman-chat
=======
基于workerman的GatewayWorker框架开发的一款高性能支持分布式部署的聊天室系统。
GatewayWorker框架文档：http://www.workerman.net/gatewaydoc/

特性
======
 * 使用websocket协议
 * 多浏览器支持（浏览器支持html5或者flash任意一种即可）
 * 多房间支持
 * 私聊支持
 * 掉线自动重连
 * 微博图片自动解析
 * 聊天内容支持微博表情
 * 支持多服务器部署
 * 业务逻辑全部在一个文件中，快速入门可以参考这个文件[Applications/Chat/Event.php](https://github.com/walkor/workerman-chat/blob/master/Applications/Chat/Event.php)   
  
下载安装
=====
1、git clone https://github.com/walkor/workerman-chat
2、composer install
3、composer require workerman/gatewayclient  与ThinkPHP等框架结合

启动停止(Linux系统)
=====
```shell
# 启动
# 以debug（调试）方式启动
php start.php start

# 以daemon（守护进程）方式启动
php start.php start -d

# 停止
php start.php stop

# 重启
php start.php restart

# 平滑重启 更改业务代码
php start.php reload

# 查看状态
php start.php status
```
## debug 和 daemon 方式区别
1、以debug方式启动，代码中echo、var_dump、print等打印函数会直接输出在终端。
2、以daemon方式启动，代码中echo、var_dump、print等打印会默认重定向到/dev/null文件，可以通过设置Worker::$stdoutFile = '/your/path/file';来设置这个文件路径。
3、以debug方式启动，终端关闭后workerman会随之关闭并退出。
4、以daemon方式启动，终端关闭后workerman继续后台正常运行。

启动(windows系统)
======
双击 start_for_win.bat  

注意：
    windows系统下无法使用 stop reload status 等命令  
    如果无法打开页面请尝试关闭服务器防火墙  

测试
=======
浏览器访问 http://服务器ip或域:55151,例如http://127.0.0.1:55151

[更多请访问www.workerman.net](http://www.workerman.net/workerman-chat)


工作原理
=======
1、Register、Gateway、BusinessWorker进程启动
2、Gateway、BusinessWorker进程启动后向Register服务进程发起长连接注册自己
3、Register服务收到Gateway的注册后，把所有Gateway的通讯地址保存在内存中
4、Register服务收到BusinessWorker的注册后，把内存中所有的Gateway的通讯地址发给BusinessWorker
5、BusinessWorker进程得到所有的Gateway内部通讯地址后尝试连接Gateway
6、如果运行过程中有新的Gateway服务注册到Register（一般是分布式部署加机器），则将新的Gateway内部通讯地址列表将广播给所有BusinessWorker，BusinessWorker收到后建立连接
7、如果有Gateway下线，则Register服务会收到通知，会将对应的内部通讯地址删除，然后广播新的内部通讯地址列表给所有BusinessWorker，BusinessWorker不再连接下线的Gateway
8、至此Gateway与BusinessWorker通过Register已经建立起长连接
9、客户端的事件及数据全部由Gateway转发给BusinessWorker处理，BusinessWorker默认调用Events.php中的onConnect onMessage onClose处理业务逻辑。
10、BusinessWorker的业务逻辑入口全部在Events.php中，包括onWorkerStart进程启动事件(进程事件)、onConnect连接事件(客户端事件)、onMessage消息事件（客户端事件）、onClose连接关闭事件（客户端事件）、onWorkerStop进程退出事件（进程事件）

Gateway/Worker 的进程模型
特点： 从图上我们可以看出Gateway负责接收客户端的连接以及连接上的数据，然后Worker接收Gateway发来的数据做处理，然后再经由Gateway把结果转发给其它客户端。
优点：
    1、可以方便的实现客户端之间的通讯
    2、Gateway与Worker之间是基于socket长连接通讯，也就是说Gateway、Worker可以部署在不同的服务器上，非常容易实现分布式部署，扩容服务器
    3、Gateway进程只负责网络IO，业务实现都在Worker进程上，可以reload Worker进程，实现在不影响用户的情况下完成代码热更新。
适用范围： 适用于客户端与客户端需要实时通讯的项目


说明
业务开发只需要关注 Applications/项目/Events.php一个文件即可。
一般来说开发者只需要关注Applications/YourApp/Events.php。 因为所有业务代码都在这里开始的。vendor目录为框架目录，开发者不要改动，也不用去理解。

其它start_gateway.php start_businessworker.php start_register.php分别是进程启动脚本，开发者一般不需要改动这三个文件。三个脚本统一由根目录的start.php启动。

Events.php 业务逻辑层
start_gateway.php
    start_gateway.php为gateway进程启动脚本，主要定义了客户端连接的端口号、协议等信息，具体参见 Gateway类的使用一节。
    客户端连接的就是start_gateway.php中初始化的Gateway端口。
start_businessworker.php
    start_businessworker.php为businessWorker进程启动脚本，也即是调用Events.php的业务处理进程，具体参见 BusinessWorker类的使用一节。
start_register.php
    start_register.php为注册服务启动脚本，用于协调GatewayWorker集群内部Gateway与Worker的通信，参见Register类使用一节。
    注意：客户端不要连接Register服务端口，客户端应该连接Gateway端口

与ThinkPHP等框架结合
=======
总体原则:
现有mvc框架项目与GatewayWorker独立部署互不干扰
所有的业务逻辑都由网站页面post/get到mvc框架中完成
GatewayWorker不接受客户端发来的数据，即GatewayWorker不处理任何业务逻辑，GatewayWorker仅仅当做一个单向的推送通道
仅当mvc框架需要向浏览器主动推送数据时才在mvc框架中调用Gateway的API GatewayClient完成推送。

GatewayClient安装
参考地址 https://github.com/walkor/GatewayClient

具体实现步骤
1、网站页面建立与GatewayWorker的websocket连接
2、GatewayWorker发现有页面发起连接时，将对应连接的client_id发给网站页面
3、网站页面收到client_id后触发一个ajax请求(假设是bind.php)将client_id发到mvc后端
4、mvc后端bind.php收到client_id后利用GatewayClient调用Gateway::bindUid($client_id, $uid)将client_id与当前uid(用户id或者客户端唯一标识)绑定。如果有群组、群发功能，也可以利用Gateway::joinGroup($client_id, $group_id)将client_id加入到对应分组
5、页面发起的所有请求都直接post/get到mvc框架统一处理，包括发送消息
6、mvc框架处理业务过程中需要向某个uid或者某个群组发送数据时，直接调用GatewayClient的接口Gateway::sendToUid Gateway::sendToGroup 等发送即可


创建wss服务 http://doc2.workerman.net/secure-websocket-server.html
======= 
准备工作：
    1、Workerman版本不小于3.3.7
    2、PHP安装了openssl扩展
    3、已经申请了证书（pem/crt文件及key文件）放在磁盘某个目录(位置任意)






