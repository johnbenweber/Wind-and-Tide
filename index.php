<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Auckland Wind and Tides</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="http://widget.windguru.cz/js/wg_widget.php" type="text/javascript"></script>
    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="windguruWidget.js" type="text/javascript"></script>
</head>

<body>

    <div id="windsurfGraphs">
        <div class="label">Wind measurements hotlinked from <a href="http://www.windsurf.co.nz" target="_blank">windsurf.co.nz</a></div>
        <div class="container">
            <div class="label">Shoal Bay</div>
            <image src="http://windsurf.co.nz/chart/line_shoalbay.asp" />
        </div>
        <div class="container">
            <div class="label">Takapuna</div>
            <image src="http://windsurf.co.nz/chart/line_takapuna.asp" />
        </div>
        <div class="container">
            <div class="label">Mairangi</div>
            <image src="http://windsurf.co.nz/chart/line_mairangi.asp" />
        </div>
        <div class="container">
            <div class="label">Pt. Chev</div>
            <image src="http://windsurf.co.nz/chart/line_ptchev.asp" />
        </div>
        <div class="container">
            <div class="label">Orewa</div>
            <image src="http://windsurf.co.nz/chart/line_orewa.asp" />
        </div>
    </div>

    <div id="windForecast">
        <div class="label">Wind forecast from <a href="http://www.windguru.cz" target="_blank">windguru.cz</a></div>
        <div id="forecastWidget"></div>
    </div>

    <div id="tideForecast">
        <div class="label">Tide forecast from <a href="http://www.linz.govt.nz" target="_blank">linz.govt.nz</a></div>
        <?php
            class MyDB extends SQLite3
            {
              function __construct()
              {
                 $this->open('tides.db');
              }
            }

            try {
               $db = new MyDB();
               if(!$db){
                  echo $db->lastErrorMsg();
               } else {
                  echo "Opened database successfully\n";
               }
            } catch(Exception $e) {
                echo "Tide forecast unavailable.";
                echo $e;
            }
        ?>
    </div>

</body>

</html> 
