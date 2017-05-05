<?php
/**
 * 测试脚本
 */

//项目根目录
$rootDir = dirname(__DIR__) . "/";

//config文件检查
$configName = isset($argv[1]) ? trim($argv[1]) : '';
if (empty($configName)) {
    echo "config不能为空; 例:demo(对应configs/demo.js)\n";
    showConfigs($rootDir . "configs/");
    exit;
}

$config = $rootDir . "configs/" . str_replace('.js', '', $configName) . ".js";
if (!file_exists($config)) {
    echo "config不存在; 例:demo(对应configs/demo.js)\n";
    showConfigs($rootDir . "configs/");
    exit;
}

//输出文件
$outputName = date("YmdHis");
$output = $rootDir . "framework/html/data/" . $outputName . ".js";

//执行命令
$command = $rootDir . "framework/bin/runjava com.rabbitmq.perf.PerfTestMulti $config $output";

@exec($command);

$url = "http://localhost:8080/output/show.html?";
$url .= "js_file=$outputName&category=$configName";

echo $url . "\n";

function showConfigs($path)
{
    echo "\n可选参数:\n";
    $list = glob($path . "*.js");
    foreach ($list as $v) {
        echo str_replace($path, '    ', str_replace('.js', '', $v)) . "\n";
    }
}
