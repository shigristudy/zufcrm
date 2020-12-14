<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use Image;

class ImageOptimizer{
	
	/**
	 * Add a new image to S3 Bucket
	 * @param  $image, $path, $square, $height, $width
	 * @return string
	 */
	public function upload_image($image, $path, $square = false, $height = '75', $width = '75'){

		// $filename = time() . '.' . $image->getClientOriginalName();

		$image = $this->resize_image($image, $square, $height, $width);

		$path = $path;

		Storage::disk('local')->put($path, $image);

		return Storage::disk('local')->url($path);
	}

	/**
	 * Resize Image
	 * @param  $image, $height, $width
	 * @return string
	 */
	public function resize_image($image, $square, $height, $width, $quality = '75'){
		
		$extension = 'jpg';
		
		$image = Image::make($image)->orientate();
		$image->resize($width, null, function ($constraint) {
			$constraint->aspectRatio();
		});
		
		return $image->encode();
	}


	public function uploadBase64Image($base64_image,$path,$height = '75', $width = '75',$aspect_ratio = false){
		$image_name = $path;
		if( $aspect_ratio ){
			$image = $this->createImageFromBase64KeepAcpectRatio($base64_image,$width);
		}else{
			$image = $this->createImageFromBase64($base64_image,$height,$width);
		}

		$path = $image_name;
		
		Storage::disk('public_f')->put($path, $image);
		$url = Storage::disk('public_f')->url($path);
		return $url;
	}


	public function createImageFromBase64($base64_image,$height,$width){
		$image = Image::make( $base64_image );
		$image->resize($width, $height);
		return $image->encode();
	}


	public function createImageFromBase64KeepAcpectRatio($base64_image,$width){
		$image = Image::make( $base64_image );
		$image->resize($width, null, function ($constraint) {
			$constraint->aspectRatio();
		});
		return $image->encode();
	}

}