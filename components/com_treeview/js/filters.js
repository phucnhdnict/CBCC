'use strict';

/* Filters */
app.filter('number_format', function() {
    return function (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
});
app.filter('str_repeat', function() {
    return function str_repeat (input, multiplier) {
        // *    huuthanh3108@gmail.com
        // *    example 1: str_repeat('-=', 10);
        // *    returns 1: '-=-=-=-=-=-=-=-=-=-='

        var y = '';
        while (true) {
            if (multiplier & 1) {
                y += input;
            }
            multiplier >>= 1;
            if (multiplier) {
                input += input;
            }
            else {
                break;
            }
        }
        return y;
    }
});
app.filter('trees', function() {
    return function (data) {
            //console.log(data);
            var source = [];
            var items = [];
            // build hierarchical source.
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                var label = item["name"];
                var parents = item["parents"];
                var id = item["id"];
                if (items[parents]) {
                    var item = { parents: parents, label: label };
                    if (!items[parents].children) {
                        items[parents].children = [];
                    }
                    items[parents].children[items[parents].children.length] = item;
                    items[id] = item;
                }
                else {
                    items[id] = { parents: parents, label: label };
                    source[id] = items[id];
                }
            }
            return source;
    }
});
app.filter('i18n', ['currentLocale', function (locale) {
    return function (key, p) {
        if (typeof locale[key] != 'undefined' && locale[key] != '') {
            return (typeof p === "undefined") ?
                locale[key] : locale[key].replace('@{}@', p);
        }
    }
}]);