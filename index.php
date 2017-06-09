<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auckland Wind and Tides</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="http://widget.windguru.cz/js/wg_widget.php" type="text/javascript"></script>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/windguruWidget.js" type="text/javascript"></script>
</head>

<body>

    <h4>Measured Wind<br/>
    <a href="http://www.windsurf.co.nz" target="_blank">windsurf.co.nz</a></h4>
    <div id="windsurfGraphs" class="section">
        <div class="containerRow">
            <div class="container">
                <p>Shoal Bay</p>
                <image src="http://windsurf.co.nz/chart/line_shoalbay.asp" />
            </div>
            <div class="container">
                <p>Takapuna</p>
                <image src="http://windsurf.co.nz/chart/line_takapuna.asp" />
            </div>
            <div class="container">
                <p>Mairangi</p>
                <image src="http://windsurf.co.nz/chart/line_mairangi.asp" />
            </div>
            <div class="container">
                <p>Pt. Chev</p>
                <image src="http://windsurf.co.nz/chart/line_ptchev.asp" />
            </div>
            <div class="container">
                <p>Orewa</p>
                <image src="http://windsurf.co.nz/chart/line_orewa.asp" />
            </div>
        </div>
    </div>

    <h4>Measured Tide<br/>
    <a href="http://www.ioc-sealevelmonitoring.org/station.php?code=auct" target="_blank">ioc-sealevelmonitoring.org</a></h4>
    <div id="tideGraph" class="section">
        <image src="http://ioc-sealevelmonitoring.org/station.php?taboption=plot&code=auct&period=0.5" style="border:thin solid black;padding:1px;"/>
    </div>

    <h4>Forecast Wind<br/>
    <a href="http://www.windguru.cz" target="_blank">windguru.cz</a></h4>
    <div id="windForecast" class="section">
        <div id="forecastWidget"></div>
    </div>

    <h4>Forecast Tide<br/>
    <a href="http://www.linz.govt.nz" target="_blank">linz.govt.nz</a></h4>
    <div id="tideForecast" class="section">

    <?php
        function colClass($elapsed) {
            if($elapsed % 2 == 0) {
                $class = 'even';
            } else {
                $class = 'odd';
            }

            return $class;
        } 

        try {
            date_default_timezone_set('Pacific/Auckland');

            $nowDate = new DateTime('now');

            $jan1st = new DateTime('2016-12-31');  

            $start = $nowDate->diff($jan1st);
            $endDate = $nowDate->add(new DateInterval('P5D'));
            $end = $endDate->diff($jan1st);

            $db = new PDO('sqlite:db/tides.sqlite3');
            $db->setAttribute(PDO::ATTR_ERRMODE, 
                              PDO::ERRMODE_EXCEPTION);

            if($db){

                $sth = $db->prepare('SELECT * FROM auckland WHERE elapsed>=? AND elapsed<=? ORDER BY id');
                $sth->execute(array($start->days,$end->days));
                $result = $sth->fetchAll();

                echo '<div class="tableDiv"><table>';
                echo '<tr>';
                echo '<td style="background-color:#eaeaea;"></td>';

                foreach($result as $row) {
                    $class = colClass($row['elapsed']);
                    $day = date('D',strtotime($row['year'].'-'.$row['month'].'-'.$row['day']));
                    
                    echo '<td class="'.$class.'">'.substr($day,0,2).'<br/>'.substr('0'.$row['day'],-2).'.</td>';
                }

                echo '</tr><tr>';
                echo '<td style="background-color:#eaeaea;">Time</td>';

                foreach($result as $row) {
                    $class = colClass($row['elapsed']);
                    echo '<td class="'.$class.'">'.$row['time'].'</td>';
                }

                echo '</tr><tr>';
                echo '<td style="background-color:#eaeaea;">Height</td>';

                foreach($result as $row) {
                    $class = colClass($row['elapsed']);
                    $blue = round(255*$row['height']/4.0);
                    echo '<td style="background-color:rgba('.(0).','.(0).','.$blue.', 0.5);">'.$row['height'].'</td>';
                }

                echo '</tr>';
                echo '</table></div>';
            } else {
                throw new Exception('Error: Unable to open database.');
            }
        } catch(Exception $e) {
            echo '<h5>Tide forecast unavailable.</h5>';
            echo '<p class="text-danger">'.$e->getMessage().'</p>';
        }
    ?>
    </div>

</body>

</html> 
