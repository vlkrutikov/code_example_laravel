<?php

namespace App\Components\Media;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\PathGenerator\PathGenerator as PathGeneratorContract;

/**
 * Class PathGenerator
 *
 * @package App\Component\Media
 */
class PathGenerator implements PathGeneratorContract
{
    public function getPath(Media $media): string
    {
        $classDirectory = strtolower(class_basename($media->model_type));
        $collection = $media->collection_name ?: 'media';
        $id = $media->id;

        $idDir0 = (int)($id / 1000000);
        $idDir1 = (int)($id / 1000) % 1000;
        $idDir2 = (int)$id % 1000;

        return implode('/', [
            $classDirectory,
            $collection,
            $idDir0,
            $idDir1,
            $idDir2,
            $id,
            '', // seems like path must end with '/', so don't erase this one
        ]);
    }

    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media);
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Models\Media $media
     *
     * @return string
     * @throws \Exception
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media);
    }
}
