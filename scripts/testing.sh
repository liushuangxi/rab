#!/bin/bash

#检查配置文件
if [ ! -n "$1" ]
then
echo "config不能为空; 例:demo(对应configs/demo.js)

可选参数:"

#列出可选配置
configs=$(ls -l configs/ | awk '/.js/ {print $NF}')

for config in $configs
do
    echo "    "${config/%.js/}
done
exit
fi

#输出文件配置
fileName=`date --date='0 days ago' +%Y%m%d%H%M%S`
filePath="framework/html/data/"$fileName".js"

cmd="framework/bin/runjava com.rabbitmq.perf.PerfTestMulti configs/"$1".js "$filePath

eval $cmd

#打开链接
url="http://localhost:8080/output/show.html?js_file="$fileName"&category="$1;
echo $url
