<?php
	$mem = new Memcache;
	$link = $mem->connect('memcached','11211');
	if(!$link) {
		exit("连接失败");
	}
	$mem->set("name","lxiao",0,3600);
	echo $mem->get("name").'<br>';

	//连接本地的 Redis 服务
    $redis = new Redis();
    $redis->connect('redis', 6379);
    echo "Connection to server sucessfully";
	//查看服务是否运行
    echo "Server is running: " . $redis->ping();
?>
