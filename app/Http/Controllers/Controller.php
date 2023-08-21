<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $personal = 'uploads/inspector/personal';
    protected $national_id = 'uploads/inspector/national_id';
    protected $passport = 'uploads/inspector/passport';
    protected $certificate = 'uploads/inspector/certificate';
    protected $certificate_good_conduct = 'uploads/inspector/certificate_good_conduct';

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadImage($image, $filePath)
    {
        $imageName =  $image->hashName();
        $path = $image->move(public_path($filePath), $imageName);
        return $imageName;
    }

    public function updateImage($oldImage, $newImage = null, $filePath)
    {
        if ($oldImage) {
            unlink($filePath . '/' . $oldImage);
        }

        if ($newImage != null) {
            return $this->uploadImage($newImage, $filePath);
        }
    }
}
