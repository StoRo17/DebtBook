<?php

namespace App\Services;

use Illuminate\Http\Request;

class AvatarHandler
{
    /**
     * Path to storage folder.
     *
     * @var string
     */
    private $storagePath = '/storage';

    /**
     * Path to avatars folder.
     *
     * @var string
     */
    private $avatarsPath = '/avatars';

    /**
     * Default image name.
     *
     * @var string
     */
    private $defaultImageName = 'no_image.jpg';

    /**
     * Save uploaded image in storage/app/public/avatars directory and return
     * path to that image or path to default avatar image.
     *
     * @param Request $request
     * @param string $userId
     * @param string $imageName
     * @return string
     */
    public function handleUploadedImage(Request $request, $userId, $imageName = 'avatar')
    {
        if ($request->hasFile($imageName)) {
            $avatar = $request->file($imageName);
            $fileName = $this->getImageName($userId, $avatar->getClientOriginalExtension());

            $avatar->storeAs($this->avatarsPath, $fileName, 'public');

            return $this->pathToImage($fileName);
        }

        return $this->defaultPath();
    }

    /**
     * Return image name.
     *
     * @param string $id
     * @param string $extension
     * @return string
     */
    private function getImageName($id, $extension)
    {
        return "{$id}_avatar.{$extension}";
    }

    /**
     * Return full path to avatar directory.
     *
     * @return string
     */
    private function fullPath()
    {
        return "{$this->storagePath}{$this->avatarsPath}";
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function pathToImage($fileName)
    {
        return "{$this->fullPath()}/{$fileName}";
    }

    /**
     * @return string
     */
    private function defaultPath()
    {
        return "{$this->fullPath()}/{$this->defaultImageName}";
    }
}