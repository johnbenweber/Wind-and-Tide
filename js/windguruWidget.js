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
          params: ['WINDSPD',
                   'GUST',
                   'SMER',
                   'TMPE',
                   'APCPs'],
          first_row       : true,
          spotname        : true,
          first_row_minfo : true,
          last_row        : false,
          lat_lon         : false,
          tz              : false,
          sun             : false,
          link_archive    : false,
          link_new_window : false},
    targetDiv);

days = ['Su','Mo','Tu','We','Th','Fr','Sa'];

times = ['06h','09h','12h','15h','18h','21h'];

var date = [];
var day = [];
var time = [];

var current = new Date();

for (d = 0; d < fdays+2; d++) {

    for (hr = 0; hr < times.length; hr++) {
        date.push(("0" + current.getDate() + ".").slice(-3));
        day.push(days[current.getDay()]);
        time.push(times[hr]);
    }

    current.setDate(current.getDate() + 1);
}

$(document).ready(function() {
    var iid = setInterval(function(){
        if ( $("td.wgfcst-day1, td.wgfcst-day2").length ) {
            clearInterval(iid);
            $(".wgfcst td.wgfcst-day1, .wgfcst td.wgfcst-day2").each(function( index ) {

                var half = $(".wgfcst td.wgfcst-day1, .wgfcst td.wgfcst-day2").length/2;

                if (index < half) {
                    $(this).text(day[index] + '\n' + date[index]);
                } else {
                    $(this).text(time[index-half]);
                }

                $(this).removeClass();

                if ((index < half && date[index]%2==0) || (index >= half && date[index-half]%2==0)) {
                    $(this).addClass("wgfcst-day2");
                } else {
                    $(this).addClass("wgfcst-day1");
                }
            });
        }
    },100);
});

