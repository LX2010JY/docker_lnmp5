document.onkeydown = function (ev) {
    if(ev.keyCode == 13 || ev.which == 13) {
        //搜索事件
        $("#search-novel").click();
    }
};

$("#search-novel").bind('click', function () {
    var q = $("#q").val();
    var url = '/index/search/'+q;
    location.href = url;
});