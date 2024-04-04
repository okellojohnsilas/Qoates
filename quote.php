<?php 
    include "app_config.php";
    $selected_quote = decode_array($_GET['q']); 
    print_r($selected_quote);
    // Unsplash
    $accessKey = 'KBa98MhFMACqTx-NMUqj2zZ8zHHzO6TVzrkRc4BM7Cs';
    $url = 'https://api.unsplash.com/photos/random?client_id=' . $accessKey;

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['urls']['regular'])) {
        $imageUrl = $data['urls']['regular'];
        echo '<img src="' . $imageUrl . '" alt="Random Unsplash Image">';
    } else {
        echo 'Error fetching image.';
}
?>