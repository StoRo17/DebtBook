<?php

namespace App\Services;

use Illuminate\Http\Request;

class AvatarHandler
{
    private $storagePath = '/storage';

    private $avatarsPath = '/avatars';

    private $defaultFileName = 'no_image.jpg';

    public function handleUploadedImage(Request $request, $userId, $imageName = 'avatar')
    {
        if ($request->hasFile($imageName)) {
            $avatar = $request->file($imageName);
            $fileName = $this->getFileName($userId, $avatar->getClientOriginalExtension());

            $avatar->storeAs($this->avatarsPath, $fileName, 'public');

            return $this->pathToImage($fileName);
        }

        return $this->defaultPath();
    }

    private function getFileName($id, $extension)
    {
        return "{$id}_avatar.{$extension}";
    }

    private function fullPath()
    {
        return "{$this->storagePath}{$this->avatarsPath}";
    }

    private function pathToImage($fileName)
    {
        return "{$this->fullPath()}/{$fileName}";
    }

    private function defaultPath()
    {
        return "{$this->fullPath()}/{$this->defaultFileName}";
    }
}