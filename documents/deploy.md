Openlab门禁系统部署流程
========================

硬件准备
-----------
* 树莓派一台
* 继电器一个
* 杜邦线三根（一头公一头母）
* 带开关的电子门禁一套

软件准备
-----------
* Raspbian系统镜像（[下载](http://downloads.raspberrypi.org/images/raspbian/2013-02-09-wheezy-raspbian/2013-02-09-wheezy-raspbian.zip)）

服务器部署
-----------
* 为树莓派安装`Raspbian`系统（具体流程可参考[这里](http://zhangshenjia.com/exprience/mac-raspbian/)）
* 为树莓派连接网线，配置固定IP
* 更新apt-get

	```
	sudo apt-get update
	```
	
* 将服务端代码部署到`/home/pi/opendoor`
* 执行部署脚本

	```
    cd /home/pi/opendoor/deploy
    chmod +x ./deploy.sh
    ./deploy.sh
	```
	