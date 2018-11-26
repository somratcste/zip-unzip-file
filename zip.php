<?php

$zip = new ZipArchive;
$res = $zip->open('test.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    $zip->addFromString('test.txt', 'file content goes here');
    $zip->setEncryptionName('test.txt', ZipArchive::EM_AES_256, '123456');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}