<?php

require 'Classes/Headers.php';
require 'vendor/autoload.php';


use Classes\sync_youtube_channel;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addAllContent = new sync_youtube_channel;
    $addAllContent->addAllContent();
}

?>