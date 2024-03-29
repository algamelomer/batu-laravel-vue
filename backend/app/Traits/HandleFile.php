<?php

namespace App\Traits;

trait HandleFile
{
    /*
    |--------------------------------------------------------------------------
    | Domain Name
    |--------------------------------------------------------------------------
    */

    private $DomainName = 'http://127.0.0.1:8000';

    /*
    |--------------------------------------------------------------------------
    | Upload Files Function
    |--------------------------------------------------------------------------
    */
    public function UploadFiles($file, $name = null, $fileType)
    {
        $folder = '';
        $disk = '';

        switch ($fileType) {
            case 'image':
                $folder = 'images';
                $disk = 'image';
                break;
            case 'video':
                $folder = 'videos';
                $disk = 'video';
                break;
            default:
                $folder = 'files';
                $disk = 'file';
        }

        return $this->uploadFile($file, $name, $folder, $disk);
    }

    /*
    |--------------------------------------------------------------------------
    | Upload File Function
    |--------------------------------------------------------------------------
    */
    private function uploadFile($uploadedFile, $name, $folder, $disk)
    {
        $fileName = $name ?? pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $uploadedFile->getClientOriginalExtension();
        $fileFullName = $fileName . '.' . $extension;
        $domain = $this->DomainName;
        $path = $uploadedFile->storeAs('assets/' . $folder, $fileFullName, $disk);
        $fullPath = $domain . '/' . $path;
        return $fullPath;
    }
}
