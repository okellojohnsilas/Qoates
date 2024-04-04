<?php

    include "app_config.php";
    // ZenQuotes.io PHP Local .txt Cache Example
    // Use this snippet to store a batch of quotes on your local server
    // Code will auto update cache based on your input time
    // Path to store your cache text file
    $filePath = "quotes.txt";
    // ZenQuotes API URL
    $url = "https://zenquotes.io/api/quotes";
    // Cache update time in seconds
    $expireTime = (60 * 60 * 48); // Update every 48 hours
    $isStale = true;
    // Check whether data needs to be updated
    if( (filemtime($filePath) + $expireTime) < time() ){$isStale = true;}
    if($isStale === true)
    {
        // Get API Response
        $json = file_get_contents($url);
        // Verify cache file exists
        $cacheFile = fopen($filePath, "w");
        // Write the new data to file and close
        if($cacheFile && $json)
        {
            fwrite($cacheFile, $json);
            fclose($cacheFile);
        }
    }
    // Decode and assign the quotes to an array
    $jsonArr = json_decode(file_get_contents($filePath),true);
    // Shuffle to get a random value at 0
    shuffle($jsonArr);
    // // array_slice($jsonArr, 2); 
    // // Grab Individual Entry and Data
    // echo $jsonArr[0]['q']."<br>";
    // echo $jsonArr[0]['a']."<br>";
    // echo $jsonArr[0]['h']."<br>";
    // Output Full Array
    // print_r($jsonArr);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print $app_name; ?></title>
    <!-- Fonf awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css"
        href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" />
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><?php print $app_name; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="#">ABOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <table id="quote-table" class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Author</th>
                    <th scope="col">Quote</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jsonArr as $quotation) { 
                    $counter++; ?>
                <tr>
                    <td><?php print $counter; ?></td>
                    <td><?php print $quotation['a']; ?></td>
                    <td><?php print $quotation['q']; ?></td>
                    <td><a class="btn btn-primary btn-sm btn-block" href="quote?q=<?php print encode_array(array($quotation['a'],$quotation['q'])); ?>" target="_blank"><i
                                class="fas fa-up-right-from-square"></i></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <footer class="navbar fixed-bottom bg-dark">
        <div class="container py-3">
            <p class="text-white text-center">
                Free to use and created by <a class="fw-bold text-decoration-none text-danger" href="https://okellojohnsilas.com/"
                    target="_blank">OKELLO JOHN SILAS <i class="fas fa-square-up-right"></i></a></p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $('#quote-table').DataTable();
    // new DataTable('#quote-table');
    </script>
</body>

</html>