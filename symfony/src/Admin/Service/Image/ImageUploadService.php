<?php

namespace App\Admin\Service\Image;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageUploadService
{
    private string $targetDirectory;

    public function __construct(ParameterBagInterface $bag, readonly private SluggerInterface $slugger)
    {
        /** @var string $dir */
        $dir = $bag->get('projectDir');
        $this->targetDirectory = $dir.'/public/images/upload/';
    }

    public function upload(UploadedFile $file): string
    {
        /** @var string $originalFilename */
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        /** @var string $safeFilename */
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->targetDirectory, $fileName);
        } catch (FileException $e) {
            dd($e);
        }

        return "/images/upload/$fileName";
    }
}
