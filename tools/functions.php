<?php 
    // Encode array
    function encode_array($array){
        return urlencode (serialize($array));
    }
    // Decode array
    function decode_array($encoded_array){
        return unserialize(urldecode($encoded_array));
    }
?>