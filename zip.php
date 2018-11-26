<?php

//$zip = new ZipArchive;
//$res = $zip->open('test.zip', ZipArchive::CREATE);
//if ($res === TRUE) {
//    $zip->addFromString('test.txt', 'file content goes here');
//    $zip->setEncryptionName('test.txt', ZipArchive::EM_AES_256, '123456');
//    $zip->close();
//    echo 'ok';
//} else {
//    echo 'failed';
//}

// another way by using different file
$zip = new ZipArchive();

$zipFile = __DIR__ . '/output.zip';
if (file_exists($zipFile)) {
    unlink($zipFile);
}

$zipStatus = $zip->open($zipFile, ZipArchive::CREATE);
if ($zipStatus !== true) {
    throw new RuntimeException(sprintf('Failed to create zip archive. (Status code: %s)', $zipStatus));
}

$password = '*innoWearTex18#';
if (!$zip->setPassword($password)) {
    throw new RuntimeException('Set password failed');
}

// compress file
$fileName = __DIR__ . '/2018-11-19 17_49_42-gyroscope.txt';
$baseName = basename($fileName);
if (!$zip->addFile($fileName, $baseName)) {
    throw new RuntimeException(sprintf('Add file failed: %s', $fileName));
}

// encrypt the file with AES-256
if (!$zip->setEncryptionName($baseName, ZipArchive::EM_AES_256)) {
    throw new RuntimeException(sprintf('Set encryption failed: %s', $baseName));
}

$zip->close();
