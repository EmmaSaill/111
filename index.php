<?php
// Define constants.
define('ENTRY_SIZE', 8);
define('GRAPH_POINTS', 50);
define('TABLE_POINTS', 100);
define('DATASTORE_FILENAME', 'data.json');
define('DATASTORE_LIMIT', 500);
define('AUTH_KEY', 'hog-RbK-vpV-kI1');

// Function that returns all data in the JSON datastore.
function get_datastore() {
    $data = file_get_contents(DATASTORE_FILENAME);
    $data = json_decode($data);
    if ($data == null) return [];
    return $data;
}

// Function that adds a new entry to the JSON datastore and trims it to a certain number of entries.
function save_datastore($entry, $limit) {
    $data = get_datastore();
    array_push($data, array_merge([time()], $entry));
    $data = array_slice($data, -$limit);
    $data = json_encode($data);
    return file_put_contents(DATASTORE_FILENAME, $data);
}

if(isset($_GET['add']) && isset($_GET['key']) && $_GET['key'] == AUTH_KEY) {
    // We have a request for entry addition with successful authorization.
    header("Content-Type: text/plain");
    $data = explode(":", trim($_GET['add']));
    if (count($data) != ENTRY_SIZE) { die('ERROR'); }
    if (save_datastore($data, DATASTORE_LIMIT) === false) { die('ERROR'); }
    die('OK');
} else {
    // This is a viewing request or authorization failed.
    $display = array_reverse(get_datastore()); // Get all entries, newest first.
    $display_count = count($display);
    $table_count = min($display_count, TABLE_POINTS); // For the table display all entries or up to a limit, whichever is lower.
    $graph_count = min($display_count, GRAPH_POINTS); // For the graph display all entries or up to a limit, whichever is lower.
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="refresh" content="2" />
    <title>COMP101P Project</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

      <div class="starter-template">
        <h1>COMP101P Project</h1>
        
        <?php if($display_count == 0) { ?>
            <p>No data points available. Please run the software outlined in the documentation.</p>
        <?php } else { ?>
            <div id="graph"></div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Time</th>
                        <th>Temperature</th>
                        <th>Light Intensity</th>
                        <th>Acceleration (X, Y, Z)</th>
                        <th>Magnetic Field (X, Y, Z)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < $table_count; $i++) { ?>
                    <tr>
                        <th scope="row"><?php echo htmlentities($table_count - $i); ?></th>
                        <td><?php echo htmlentities(date('r', $display[$i][0])); ?></td>
                        <td><?php echo htmlentities($display[$i][1]); ?></td>
                        <td><?php echo htmlentities($display[$i][2]); ?></td>
                        <td>(<?php echo htmlentities($display[$i][3]); ?>, <?php echo htmlentities($display[$i][4]); ?>, <?php echo htmlentities($display[$i][5]); ?>)</td>
                        <td>(<?php echo htmlentities($display[$i][6]); ?>, <?php echo htmlentities($display[$i][7]); ?>, <?php echo htmlentities($display[$i][8]); ?>)</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
    
    <script type="text/javascript">
        Morris.Line({
            element: 'graph',
            data: [
                <?php for ($i = 0; $i < $graph_count; $i++) { ?>
                { y: <?php echo htmlentities($display[$i][0] * 1000); ?>, a: <?php echo htmlentities($display[$i][1]); ?>, b: <?php echo htmlentities($display[$i][2]); ?> },
                <?php } ?>
            ],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Temperature', 'Light Intensity']
        });
    </script>
  </body>
</html>