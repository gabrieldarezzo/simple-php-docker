<?php

namespace App\Dto;

use App\Services\ImageManipulatorService;

class Pokemon
{
    public function __construct(
        string $id,
        string $name,
        string $photo
    ) {
        $this->id = $id;
        $this->name = $this->setName($name);
        $this->photo = $photo;
    }


    /**
     * @param string $name
     * @return string
     */
    public function setName(string $name): string
    {
        return $this->name = ucfirst($name);
    }

    /**
     * @return string
     */
    public function getUnique()
    {
        return uniqid();
    }

    /**
     * @return string
     */
    public function getPhotoBase64(): string
    {
        $imageManipulatorService = new ImageManipulatorService();
        return $imageManipulatorService->createBase64FromUrl($this->photo);
    }
}
