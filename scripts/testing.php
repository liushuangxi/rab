<?php
/**
 * 测试脚本
 */

//项目根目录
$rootDir = dirname(__DIR__) . "/";

//config文件检查
$config = isset($argv[1]) ? trim($argv[1]) : '';
if (empty($config)) {
    echo "config不能为空; 例:demo(对应configs/demo.js)\n";
    exit;
}

$config = $rootDir . "configs/" . trim($config, ".js") . ".js";
if (!file_exists($config)) {
    echo "config不存在; 例:demo(对应configs/demo.js)\n";
    exit;
}

//输出文件
$output_name = date("YmdHis");
$output = $rootDir . "framework/html/data/" . $output_name . ".js";

//执行命令
$command = $rootDir . "framework/bin/runjava com.rabbitmq.perf.PerfTestMulti $config $output";

@exec($command);

echo "http://localhost:8080/output/consume.html?js_file=" . $output_name."\n";
echo "http://localhost:8080/output/message-sizes-and-producers.html?js_file=" . $output_name."\n";
echo "http://localhost:8080/output/message-sizes-large.html?js_file=" . $output_name."\n";
echo "http://localhost:8080/output/rate-vs-latency.html?js_file=" . $output_name."\n";

