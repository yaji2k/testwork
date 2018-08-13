(function ($) {
    $.fn.trackCoords = function (obj) {
        var settingsDefault = {
            "checkInterval": 30,
            "sendInterval": 3000,
            "url": undefined
        };
        var settings = $.extend(settingsDefault, obj);
        var arrOfObj = [];
        var resultArray = [];
        var parentCoord = this.offset();

        checkData();
        setRequest();

        this.on("mousemove", function () {
            arrOfObj.push({
                "x": event.pageX - parentCoord.left,
                "y": event.pageY - parentCoord.top,
                "start": event.timeStamp,
                "end": null
            });
            if (arrOfObj.length > 1) {
                arrOfObj[arrOfObj.length - 2].end = event.timeStamp;
            }
        });

        this.on("mouseleave", function () {
            arrOfObj[arrOfObj.length - 1].end = event.timeStamp;
        });

        // Отправка данных

        function setRequest() {
            setTimeout(function () {
                var arr =  resultArray.splice(0, resultArray.length);
                if(arr.length > 0) {
                    var json = JSON.stringify(arr);
                    $.post(settings.url, {"json": json}, function (data, status) {
                        console.log(data);
                        console.log(status);
                    });
                }
                setRequest();
            }, settings.sendInterval);
        }

        function checkData() {
            setTimeout(function () {
                getArrayOfObjects();
                checkData();
            }, settings.checkInterval);
        }

        function getArrayOfObjects() {
            for (var k = 0; k < arrOfObj.length; k++) {
                if (arrOfObj[k].end !== null) {
                    var arr = arrOfObj.splice(k, 1);
                    resultArray.push({
                        "x": arr[0].x,
                        "y": arr[0].y,
                        "time": arr[0].end - arr[0].start
                    });
                }
            }
        }
    };
})(jQuery);