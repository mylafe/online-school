$(document).ready(function() {
    //搜索
    var searchsubmit = $("#searchsubmit");
    if (searchsubmit){
        searchsubmit.click(function () {
            var url = '/site/index';
            //get参数拼接
            var params = [];
            var keywords = $.trim($("#keywords").val());
            if (keywords) {
                params.push('keywords=' + keywords);
            } else {
                Swal.fire({
                    text: "搜索内容不能为空！",
                    icon: 'warning',
                });return;
            }
            if (params.length > 0) {
                var req = params.join('&');
                url = '?' + req;
            }
            window.location = url;
            return;
        });
    }
});
