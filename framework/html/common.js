$(document).ready(function () {
    //加载配置页面
    var category = getQueryString('category');

    $("body").load(category + ".html");

    //加载配置文件
    var js_file = getQueryString('js_file');

    $.ajax({
        url: "/data/" + js_file + '.js',
        success: function (data) {
            console.log(data);
            render_graphs(JSON.parse(data));
        },
        fail: function () {
            alert('error loading ' + js_file + '.js');
        }
    });
});

/**
 * 获取URL参数
 * @param name
 * @returns {null}
 */
function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);

    if (r != null) {
        return unescape(r[2]);
    }

    return null;
}