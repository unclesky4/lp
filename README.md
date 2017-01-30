commit cc7c5aa50f463c1cac9c3bcaefde11de0edb764c
Author: unclesky4 <1292931210@qq.com>
Date:   Mon Jan 16 02:30:09 2017 +0800

    =初步完成界面设计


commit f3ce1cba06ad9103d2fa2af422a74001a41785a0
Author: unclesky4 <1292931210@qq.com>
Date:   Thu Jan 12 23:04:18 2017 +0800

    =2017.01.12


commit 6eeccd2857d24d10e956156521e39a3f6a52717d
Author: unclesky4 <1292931210@qq.com>
Date:   Thu Jan 12 15:44:42 2017 +0800

    =init

建表：
create table `user`(id int(6) primary key auto_increment, uname varchar(10) not null, password varchar(33) not null);

create table `tb`(tname varchar(8) not null primary key, cmd varchar(8) not null, 
	time varchar(20) null, addr varchar(20) null);

create table `at`(name varchar(8) not null primary key, cmd varchar(8) not null, 
	time varchar(20) null, addr varchar(20) null);

create table `$tb`(id int(6) primary key  auto_increment,academy varchar(10) not null, name varchar(8) not null,
	lphone varchar(11) not null, sphone varchar(6) not null, time varchar(12) not null);

