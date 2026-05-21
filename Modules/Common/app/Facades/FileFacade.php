<?php

namespace Modules\Common\Facades;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Common\Models\File as FileEntity;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Admin\AdminApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class FileFacade
{

    public static function defaultUpload($file, $entity = null, $disk=null, $dir=null, $identifier= null ) {
        try {
            $storageDisk = $disk ?? config('filesystems.default');
            $entityClass = get_class($entity);
        	$current = Carbon::now()->format('YmdHs');
	        $fileExtension = $file->getClientOriginalExtension();

	        // unique filename with timestamp
	        $nnn =str_replace( $fileExtension, '-'.$current . '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
	        $fileName = strtoupper($nnn);

            $dir = 'uploads' . $dir;
	        $path = Storage::disk($storageDisk)->putFileAs($dir, $file, $fileName );
            $user = Auth::user();
	        $media= FileEntity::create([
	            'user_id' => $user->id,
	            'disk' =>  $storageDisk,
	            'entity' => $entityClass,
	            'entity_id' => $entity->id,
	            'filename' => $fileName,
	            'identifier' => $identifier,
	            'path' => $path,
	            'extension' => $file->guessClientExtension() ?? '',
	            'mime' => $file->getClientMimeType(),
	            'size' => $file->getSize(),
	        ]);
	        
	        return $media;
        	
        } catch (Exception $e) {
        	
        }
    }

    public static function deleteFile($files, $disk=null) {
        try {
            $storageDisk = $disk ?? config('filesystems.default');
            if( $files instanceof Collection ){
                foreach ($files as $file ) {
                    Storage::disk($storageDisk)->delete($file->path);
                    $file->delete();
                }
            }else{
                Storage::disk($storageDisk)->delete($files->path);
                $files->delete();
            }

        } catch (Exception $e) {
            throw $e;
        }
    }



    public static function publicFileUpload($file, $entity = null, $disk = null, $dir = null, $identifier = null)
    {
        try {
            $storageDisk = $disk ?? config('filesystems.default');
            $entityClass = get_class($entity);
            $current = Carbon::now()->format('YmdHs');
            $fileExtension = $file->getClientOriginalExtension();

            // unique filename with timestamp
            $nnn = str_replace($fileExtension, '-' . $current . '.' . $fileExtension, Str::slug($file->getClientOriginalName()));
            $fileName = strtoupper($nnn);

            // Define the directory path
            $dir = 'uploads/' . $dir;
            $destinationPath = public_path($dir);

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Move the file to the public/uploads directory
            $file->move($destinationPath, $fileName);

            // dd($dir, $fileName);

            $user = Auth::user();
            $media = FileEntity::create([
                'user_id' => $user->id,
                'disk' => 'cloudinary',
                'entity' => $entityClass,
                'entity_id' => $entity->id,
                'filename' => $fileName,
                'identifier' => $identifier,
                'path' => $dir . '/' . $fileName,
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => filesize($destinationPath . '/' . $fileName),
            ]);

            return $media;
        } catch (\Exception $e) {
            throw $e; // Rethrow the exception
        }
    }

    // public static function deleteFile($files, $disk=null) {
    public static function publicFileDelete($files, $disk = null)
    {
        try {
            $storageDisk = $disk ?? config('filesystems.default');

            if ($files instanceof Collection) {
                foreach ($files as $file) {
                    if ($file->disk === 'public') {
                        // Delete file from public directory
                        $filePath = public_path($file->path);
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    } else {
                        // Delete file from storage disk
                        Storage::disk($storageDisk)->delete($file->path);
                    }
                    $file->delete();
                }
            } else {
                if ($files->disk === 'public') {
                    // Delete file from public directory
                    $filePath = public_path($files->path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                } else {
                    // Delete file from storage disk
                    Storage::disk($storageDisk)->delete($files->path);
                }
                $files->delete();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    public static function cloudinaryUpload($file, $entity = null, $identifier = null)
    {
        try {
            // Configure Cloudinary
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key' => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => [
                    'secure' => true
                ]
            ]);

            // Upload the file to Cloudinary
            $uploadResult = (new UploadApi())->upload($file->getRealPath(), [
                'folder' => 'uploads',
                'public_id' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'overwrite' => true,
                'resource_type' => 'image'
            ]);

            // $uploadResult = Cloudinary::uploadApi()->upload($file->getRealPath());

            $user = Auth::user();
            $media = FileEntity::create([
                'user_id' => $user->id,
                'disk' => 'cloudinary',
                'entity' => get_class($entity),
                'entity_id' => $entity->id,
                'filename' => $uploadResult['public_id'],
                'identifier' => $identifier,
                'path' => $uploadResult['secure_url'],
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);

            return $media;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function cloudinaryDelete($files)
    {
        try {
            // Configure Cloudinary
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key' => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => [
                    'secure' => true
                ]
            ]);

            foreach ($files as $file ) {
                $publicId = $file->filename;
                $adminApi = new AdminApi();
                $adminApi->deleteAssets([$publicId]);
                $file->delete();
            }


        } catch (Exception $e) {
            throw $e;
        }
    }

}
