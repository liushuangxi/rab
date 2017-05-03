<?php
/**
 * 服务器脚本
 */

//脚本目录
$scriptDir = dirname(__DIR__) . "/framework";

//启动命令
$command = "cd $scriptDir; bin/runjava com.rabbitmq.perf.WebServer";

@exec($command);