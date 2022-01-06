<?php
namespace App\Http\Utility;

use App\Models\Notifications;
use App\Models\Orders;
use App\Models\TriniteqOrders;
use App\Notifications\DeviceIdsFCM;
use App\Notifications\TopicFCM;
use App\Models\User;
use Image;

trait UtilityFunction
{
    
    /**
     * For deleting images from directory
     *
     * @param String $image image name
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function deleteImage($image, $imagePath, $resizeArr)
    {
        \Storage::delete($imagePath . '/' . $image);
        foreach ($resizeArr as $imagePrefix => $sizes) {
            \Storage::delete($imagePath . '/' . $imagePrefix . '-' . $image);
        }
    }

    /**
     * For deleting video from directory
     *
     * @param String $video video name
     * @param String $videoPath video path
     */
    public function deleteVideo($video, $videoPath)
    {
        $videoImage = $this->getVideoImage($video);
        \Storage::delete($videoPath . '/' . $video);
        \Storage::delete($videoPath . '/' . $videoImage);
    }

    /**
     * For resizing images
     *
     * @param String $image image object
     * @param String $imageName image name
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function ImageResize($image, $imageName, $resizeArr, $imagePath)
    {

        foreach ($resizeArr as $imagePrefix => $sizes) {

            $resizeImgName = $imagePrefix . '-' . $imageName;

            $img = "";
            $img = Image::make($image);
            //$img->encode('png', 100)->trim($img->pickColor(10, 10, 'hex'));
            //$img->trim('transparent', array('top', 'bottom'));
            $img->resize($sizes[0], $sizes[1], function ($constraint) {
                $constraint->aspectRatio();
            });
            
            $img->stream();
            \Storage::put($imagePath . '/' . $resizeImgName, $img);

        }

    }

    /**
     * For uploading images
     *
     * @param String $image image object
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function uploadImage($image, $imagePath, $resizeArr)
    {
        $image_new = time() . rand() . '.' . $image->getClientOriginalExtension();
        $path = \Storage::putFileAs(
            $imagePath, $image, $image_new
        );

        /*
        call image resize function
         */
        if($image->getClientOriginalExtension() != 'pdf')
        $this->ImageResize($image, $image_new, $resizeArr, $imagePath);

        return $image_new;
    }

    /**
     * For uploading images from link
     *
     * @param String $image image object
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function uploadImageFromURL($image, $imagePath, $resizeArr)
    {
        $image_new = time() . rand() . '.'. pathinfo($image, PATHINFO_EXTENSION);
        $img = Image::make($image);
            
        $img->stream();
        \Storage::put($imagePath . '/' . $image_new, $img);

        $this->ImageResize($image, $image_new, $resizeArr, $imagePath);

        return $image_new;
    }

    /**
     * For uploading docs
     *
     * @param String $image image object
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function uploadDocs($image, $imagePath)
    {
        $image_new = time() . rand() . '.' . $image->getClientOriginalExtension();
        $path = \Storage::putFileAs(
            $imagePath, $image, $image_new
        );

        return $image_new;
    }

    /**
     * For uploading images with fix name
     *
     * @param String $image image object
     * @param String $imagePath image path
     * @param Array resizeArr image sizes
     */
    public function uploadImageWithSameName($image, $imagePath, $resizeArr)
    {

        $image_new = 'instagram.png';
        $path = \Storage::putFileAs(
            $imagePath, $image, $image_new
        );

        /*
        call image resize function
         */
        $this->ImageResize($image, $image_new, $resizeArr, $imagePath);

        return $image_new;
    }

    /**
     * For uploading videos
     *
     * @param String $video video object
     * @param String $videoPath video path
     */
    public function uploadVideo($video, $videoPath)
    {

        $video_new = "";
        if ($video) {
            $timeString = time();
            $video_new = $timeString . '.' . $video->getClientOriginalExtension();
            $path = \Storage::putFileAs($videoPath, $video, $video_new);

            $media = \FFMpeg::open($path);

            $media->getFrameFromSeconds(2)
                ->export()
                ->toDisk('local')
                ->save($videoPath . '/img-' . $timeString . '.png');

        }
        return $video_new;
    }

    /**
     * For getting video duration
     *
     * @param String $vedioPath full path of video
     */
    public function getVideoDuration($videoPath)
    {

        $media = \FFMpeg::open($videoPath);
        $duration = gmdate("H:i:s", $media->getDurationInSeconds());

        return $duration;
    }

    /**
     * For getting video thumbnail name
     *
     * @param String $video video name object
     */
    public function getVideoImage($video)
    {
        if ($video != "") {
            $videoNameArr = explode('.', $video);
            return 'img-' . $videoNameArr[0] . '.png';
        }
    }

}
