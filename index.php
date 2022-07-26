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
        <?php
        include 'conn.php';

        $sql = "SELECT * FROM dates";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $id = $row["id"];
                $name = $row["name"];
                $date = $row["date"];
                
                // get todays date
                $today = date("m-d");
                $date = substr($date, 5);
                

                if ($today == $date) {
                    echo "It's " . $name . "'s Birthday today!";

                    // discord webhook
                    $data = array(
                        'username' => 'Birthday Bot',
                        'avatar_url' => 'https://i.pinimg.com/originals/5b/49/c8/5b49c86ba30c3df81751388908e09239.png',
                        'content' => $mention . ' It\'s ' . $name . ' Birthday today!'
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
    </div>
    </section>
    </body>
</html>
<?php
$conn->close();
?>
