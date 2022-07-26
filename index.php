<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Benji Starter!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://bench.benji.link/assets/bulma-prefers-dark.css" />
  </head>
  <body>
  <section class="section">
    <div class="container">
        <h1 class="title">
            Birthdays
        </h1>
        <!-- make table -->
        <!-- <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody> -->
        <?php
        include 'conn.php';

        $sql = "SELECT * FROM dates";
        $result = $conn->query($sql);
        
        // print out all rows
        // if ($result->num_rows > 0) {
        //     // output data of each row
        //     while($row = $result->fetch_assoc()) {
        //         echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Date: " . $row["date"]. "<br>";
        //     }
        // } else {
        //     echo "0 results";
        // }
        


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $id = $row["id"];
                $name = $row["name"];
                $date = $row["date"];
                
                // get todays date
                $today = date("m-d");
                $date = substr($date, 5);

                
                // echo "<tr>";
                // echo "<td>" . $id . "</td>";
                // echo "<td>" . $name . "</td>";
                // echo "<td>" . $date . "</td>";
                // echo "</tr>";
                

                if ($today == $date) {
                    echo "It's " . $name . "'s Birthday today!";

                    // discord webhook
                    $data = array(
                        'username' => 'Birthday Bot',
                        'avatar_url' => 'https://i.pinimg.com/originals/5b/49/c8/5b49c86ba30c3df81751388908e09239.png',
                        'content' => '<@499865877945253888> It\'s ' . $name . ' Birthday today!'
                    );
                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/json\r\n",
                            'method'  => 'POST',
                            'content' => json_encode($data)
                        )
                    );
                    $context = stream_context_create($options);
                    $aaaaa = file_get_contents($webhook, false, $context);
                }

            }
        } else {
            echo "0 results";
        }

        ?>
<!-- 
            </tbody>
        </table> -->
        <!-- end table -->
    </div>
    </section>
    </body>
</html>
<?php
$conn->close();
?>
