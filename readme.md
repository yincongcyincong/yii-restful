开启gii，yii的restful接口是根据 gii为基础的model类写的，用gii生成一个model
在web/index.php设置Yii_ENV_DEV
远程的话在gii的配置config/web.php  设置allowIPs；

生成model类后建一个controller继承Yii/rest/activeController
设置一个公共属性$modelClass 值为model的命名空间+model名字

完成之后用 域名/+控制器名/+主键可获取信息

代码是配置和控制器代码

加了一些rabc权限控制的例子，主要是rule的运用进行增删改查和增删改查时人的限定
