var targetDiv = 'forecastWidget';
var fdays = 5;
var fhours = fdays*24;

WgWidget({s      : 25747,
          odh    : 6,
          doh    : 21,
          wj     : 'knots',
          tj     : 'c',
          waj    : 'm',
          fhours : fhours,
          lng    : 'en',
          params: ['MWINDSPD',
                   'GUST',
                   'SMER',
                   'TMPE',
                   'APCPs'],
          first_row       : true,
          spotname        : true,
          first_row_minfo : true,
          last_row        : true,
          lat_lon         : false,
          tz              : true,
          sun             : true,
          link_archive    : false,
          link_new_window : false},
    targetDiv);

days = ['Su','Mo','Tu','We','Th','Fr','Sa'];

times = ['06h','09h','12h','15h','18h','21h'];

var date = [];
var day = [];
var time = [];

var current = new Date();

for (d = 0; d < fdays; d++) {

    for (hr = 0; hr < times.length; hr++) {
        date.push(("0" + current.getDate() + ".").slice(-3));
        day.push(days[current.getDay()]);
        time.push(times[hr]);
    }

    current.setDate(current.getDate() + 1);
}

$(document).ready(function() {
    var iid = setInterval(function(){
        if ( $("td.wgfcst-day1").length && $("td.wgfcst-day2").length ) {
            console.log("success");
            $(".wgfcst td.wgfcst-day1").remove();
            $(".wgfcst td.wgfcst-day2").remove();
            clearInterval(iid)
        } else {
            console.log("try again");
        }
    },100);
});

