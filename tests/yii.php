<?php

if (!empty($argv[1]) && !empty($argv[2])) {
    file_put_contents($argv[1], $argv[2]);
}
