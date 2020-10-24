(function($) {
    $.extend({
        toast: function(obj) {
            if ($("#daftplugPublicToastMessage").length) {
                return
            }
            var title = obj.title;
            var showTime = obj.duration || 2000;
            var width = obj.width || "auto";
            var height = obj.height || "20px";
            var position = obj.position || '';
            var backgroundColor = obj.backgroundColor || 'rgba(0, 0, 0, .7)';
            var textColor = obj.textColor || '#fff';
            var flag = obj.flag || !0;
            var lineheight = obj.lineheight || height;
            if (position == 'bottom') {
                position = "bottom: 50px;"
            } else if (position == 'middle') {
                position = "top: calc(45% - 15px);"
            } else if (position == 'top') {
                position = "top: 0px;"
            } else if (position === '') {
                position = "top: 80%;"
            } else {}
            if (flag) {
                var content = "<div id='daftplugPublicToastMessage' style='position: fixed;display: none; z-index:999;font-size: 18px; " + position + ";left: 0;width:100%; height: " + height + "; text-align: center'>"
            } else {
                var content = "<div id='daftplugPublicToastMessage' style='position: fixed; display: none;z-index:999; top: 0; left: 0;width:100%; height:100%; text-align: center'>"
            }
            content += '<div id="toast-content" style="display: inline-block; width: ' + width + ';min-height: ' + height + ';padding: 8px 14px;background-color: ' + backgroundColor + ';text-align: center;line-height: ' + lineheight + ';border-radius: 15px;color: ' + textColor + ';">' + title + '</div>';
            content += '</div>';
            $("body").append(content);
            $("#daftplugPublicToastMessage").fadeIn(200);
            setTimeout(function() {
                $("#daftplugPublicToastMessage").fadeOut(200)
            }, showTime);
            setTimeout(function() {
                $("#daftplugPublicToastMessage").remove()
            }, showTime + 300)
        }
    })
})(jQuery)