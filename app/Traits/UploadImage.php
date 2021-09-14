<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

trait UploadImage
{

    /**
     * Parse response format
     *
     * @param  array $data
     * @param  string $statusCode
     * @return JsonResponse
     */
    public function uploadImage($image)
    {
        if ($image != null) {
            $fileExtension = $image->getClientOriginalExtension();
            $fileName = md5(time()) . rand(0,100000) . '.' . $fileExtension;
            $uploadPath = public_path('/img'); // Thư mục upload

            // Bắt đầu chuyển file vào thư mục
            $image->move($uploadPath, $fileName);
            return '/img/' . $fileName;
        }
        return null;
    }
}
