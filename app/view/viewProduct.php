<?php
include "../../app/http/helper/base64.php";

$encodedId = $_GET['id'] ?? null; // Use null coalescing operator to check if 'id' is set

if ($encodedId) {
    // Decode the Base64-encoded ID
    $decodedId = Base64IdHelper::decode_id($encodedId);

    if ($decodedId !== null) {
        echo "Decoded ID: " . $decodedId;
    } else {
        echo "Invalid encoded ID.";
    }
} else {
    echo "No ID provided in the URL.";
}
?>
