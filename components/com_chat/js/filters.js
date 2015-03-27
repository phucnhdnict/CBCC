/**
 * Created by huuthanh3108 on 11/2/13.
 */
'use strict';
app.filter("timeago", function () {
        //time: the time
        //local: compared to what time? default: now
        //raw: wheter you want in a format of "5 minutes ago", or "5 minutes"
        return function (time, local, raw) {
            if (!time) return "never";
 
            if (!local) {
                (local = Date.now())
            }
 
            if (angular.isDate(time)) {
                time = time.getTime();
            } else if (typeof time === "string") {
                time = new Date(time).getTime();
            }
 
            if (angular.isDate(local)) {
                local = local.getTime();
            }else if (typeof local === "string") {
                local = new Date(local).getTime();
            }
 
            if (typeof time !== 'number' || typeof local !== 'number') {
                return;
            }
 
            var
                offset = Math.abs((local - time) / 1000),
                span = [],
                MINUTE = 60,
                HOUR = 3600,
                DAY = 86400,
                WEEK = 604800,
                MONTH = 2629744,
                YEAR = 31556926,
                DECADE = 315569260;
 
            if (offset <= MINUTE)              span = [ '', raw ? 'now' : ' bây giờ' ];
            else if (offset < (MINUTE * 60))   span = [ Math.round(Math.abs(offset / MINUTE)), 'phút trước' ];
            else if (offset < (HOUR * 24))     span = [ Math.round(Math.abs(offset / HOUR)), 'giờ trước' ];
            else if (offset < (DAY * 7))       span = [ Math.round(Math.abs(offset / DAY)), 'ngày trước' ];
            else if (offset < (WEEK * 52))     span = [ Math.round(Math.abs(offset / WEEK)), 'tuần trước' ];
            else if (offset < (YEAR * 10))     span = [ Math.round(Math.abs(offset / YEAR)), 'năm trước' ];
            else if (offset < (DECADE * 100))  span = [ Math.round(Math.abs(offset / DECADE)), 'decade trước' ];
            else                               span = [ '', 'một thời gian dài' ];
 
            //span[1] += (span[0] === 0 || span[0] > 1) ? 's' : '';
            span = span.join(' ');
 
            if (raw === true) {
                return span;
            }
            return (time <= local) ? ' '+ span + ' ' : 'trong ' + span;
        }
    });