<?php
$zip = new ZipArchive();
$zip_status = $zip->open('output.zip');

if ($zip_status === true)
{
    if ($zip->setPassword('*innoWearTex18#'))
    {
        if (!$zip->extractTo(__DIR__))
            echo "Extraction failed (wrong password?)";
    }

    $zip->close();
    echo 'ok';
}
else
{
    die("Failed opening archive: ". @$zip->getStatusString() . " (code: ". $zip_status .")");
}