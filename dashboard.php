<?php
    include_once('database.php');
     if (isset($_GET["readingsCount"])){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    }
    // default readings count set to 20
    else {
      $readings_count = 20;
    }

    $last_reading = getLastReadings();
    $last_reading_SpO2 = isset($last_reading["value1"]) ? $last_reading["value1"] : '';
    $last_reading_BPM = isset($last_reading["value2"]) ? $last_reading["value2"] : '';
    $last_reading_temperature = isset($last_reading["value3"]) ? $last_reading["value3"] : '';
    $last_reading_ECG = isset($last_reading["value4"]) ? $last_reading["value4"] : '';
    $last_reading_time = isset($last_reading["reading_time"]) ? $last_reading["reading_time"] : '';
    
    $min_SpO2 = minReading($readings_count, 'value1');
    $max_SpO2 = maxReading($readings_count, 'value1');
    $avg_SpO2 = avgReading($readings_count, 'value1');

    $min_BPM = minReading($readings_count, 'value2');
    $max_BPM = maxReading($readings_count, 'value2');
    $avg_BPM = avgReading($readings_count, 'value2');
    
    $min_temp = minReading($readings_count, 'value3');
    $max_temp = maxReading($readings_count, 'value3');
    $avg_temp = avgReading($readings_count, 'value3');
    
    $min_ECG = minReading($readings_count, 'value4');
    $max_ECG = maxReading($readings_count, 'value4');
    $avg_ECG = avgReading($readings_count, 'value4');
    
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard ICU Monitoring</title>
  <link rel="stylesheet" href="css/style_chart.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header class="header">
    <a href="halaman_awal.php" class="logo"> <i class="fas fa-heartbeat"></i> <strong>Rumah Sakit </strong>Advent </a>
    <nav class="navbar">
        <a href="halaman_awal.php">Home</a>
        <a href="dataPasien.html" >Data Pasien</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="main">
    <div class="cards">
        <div class="card">
            <div class="card-content">
                <div class="card-name">Bpk. Agus</div>
            </div>
        </div> 
    </div>
    <div class="kotak">
        <div class="data-kotak">
            <div class="isi-kotak">
                <div class="kartu-nama"> Suhu Tubuh : <?php echo $last_reading_temperature; ?></div>
            </div>
        </div>
        <div class="data-kotak">
            <div class="isi-kotak">
                <div class="kartu-nama"> BPM : <?php echo $last_reading_BPM; ?></div>
            </div>
        </div>
        <div class="data-kotak">
            <div class="isi-kotak">
                <div class="kartu-nama"> Saturasi Oksigen : <?php echo $last_reading_SpO2; ?></div>
            </div>
        </div>
    </div>

        <div class="charts">
            <div class="chart">
                <h2>Saturation</h2>
                <canvas id="demo"</canvas>
           </div>
        </div>
        
        <?php
        echo   '<h2> View Latest ' . $readings_count . ' Readings</h2>
                <table cellspacing="5" cellpadding="5" id="tableReadings">
                    <tr>
                        <th>Location</th>
                        <th>SpO2</th>
                        <th>BPM</th>
                        <th>Temperature</th>
                        <th>Timestamp</th>
                    </tr>';
    
        $result = getAllReadings($readings_count);
            if ($result) {
            while ($row = $result->fetch_assoc()) {
                $row_location = $row["location"];
                $row_value1 = $row["value1"];
                $row_value2 = $row["value2"];
                $row_value3 = $row["value3"];
                $row_reading_time = $row["reading_time"];
                // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
                //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
                // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
                //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 7 hours"));
    
                echo '<tr>
                        <td>' . $row_location . '</td>
                        <td>' . $row_value1 . '</td>
                        <td>' . $row_value2 . '</td>
                        <td>' . $row_value3 . '</td>
                        <td>' . $row_reading_time . '</td>
                      </tr>';
            }
            echo '</table>';
            $result->free();
        }
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/chart.js"></script>

</body>
</html>

