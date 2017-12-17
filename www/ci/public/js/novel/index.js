var Serv = {
    showServerMes: function (mes) {
        var html = '<div>'+mes+'</div>';
        $("#server").append(html);
        var server = document.getElementById('server');
        server.scrollTop = server.scrollHeight;
    }
}

var ws = new WebSocket("ws://127.0.0.1:9501");
ws.onopen = function (event) {
    ws.send("哈哈，我连上了");
    Serv.showServerMes("连接服务器成功！开始下载吧");
};
ws.onmessage = function (p1) {
    Serv.showServerMes(p1.data);
}
ws.onclose = function (p1) {
    Serv.showServerMes('断开连接了，soorry。');
}
ws.onerror = function (event) {
    Serv.showServerMes('出错了！！！');
}

$("#start").bind('click', function () {
    ws.send('download');
    $("#start").attr('disabled', true);
})