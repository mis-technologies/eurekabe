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

    // ─── Unified raw-file methods (disk-aware) ────────────────────────────────

    /**
     * Upload a raw file (PDF, TXT, etc.) to whichever disk is configured via
     * MATERIAL_DISK in .env (default: 'cloudinary').
     * Callers should use this instead of calling cloudinaryUploadRaw() directly.
     */
    public static function uploadRawFile($file, $entity, $identifier = null, string $folder = 'materials'): FileEntity
    {
        $disk = config('cloudinary.material_disk', 'cloudinary');

        return $disk === 'cloudinary'
            ? self::cloudinaryUploadRaw($file, $entity, $identifier, $folder)
            : self::localUploadRaw($file, $entity, $disk, $identifier, $folder);
    }

    /**
     * Store a raw file on a local Laravel filesystem disk and create a File record.
     * Used when MATERIAL_DISK is set to 'public', 's3', etc.
     */
    public static function localUploadRaw($file, $entity, string $disk, $identifier = null, string $folder = 'materials'): FileEntity
    {
        $entityClass = get_class($entity);
        $current     = Carbon::now()->format('YmdHs');
        $ext         = $file->getClientOriginalExtension();
        $slug        = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $fileName    = strtoupper("{$slug}-{$current}.{$ext}");
        $path        = Storage::disk($disk)->putFileAs($folder, $file, $fileName);

        $user = Auth::user();

        return FileEntity::create([
            'user_id'    => $user->id,
            'disk'       => $disk,
            'entity'     => $entityClass,
            'entity_id'  => $entity->id,
            'filename'   => $fileName,
            'identifier' => $identifier,
            'path'       => $path,
            'extension'  => $file->guessClientExtension() ?? $ext,
            'mime'       => $file->getClientMimeType(),
            'size'       => $file->getSize(),
        ]);
    }

    /**
     * Delete a single raw-file record from whatever disk it lives on.
     * Handles both Cloudinary and local Storage disks.
     */
    public static function deleteRawFile(FileEntity $file): void
    {
        try {
            if ($file->disk === 'cloudinary') {
                Configuration::instance([
                    'cloud' => [
                        'cloud_name' => config('cloudinary.cloud_name'),
                        'api_key'    => config('cloudinary.api_key'),
                        'api_secret' => config('cloudinary.api_secret'),
                    ],
                    'url' => ['secure' => true],
                ]);
                (new AdminApi())->deleteAssets([$file->filename]);
            } else {
                Storage::disk($file->disk)->delete($file->path);
            }
        } catch (\Throwable) {
            // Best-effort — always delete the DB record
        }

        $file->delete();
    }

    /**
     * Upload a raw file (PDF, TXT, etc.) to Cloudinary.
     * Same as cloudinaryUpload() but uses resource_type='raw' for non-image files.
     */
    public static function cloudinaryUploadRaw($file, $entity = null, $identifier = null, string $folder = 'uploads')
    {
        try {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => config('cloudinary.cloud_name'),
                    'api_key'    => config('cloudinary.api_key'),
                    'api_secret' => config('cloudinary.api_secret'),
                ],
                'url' => ['secure' => true],
            ]);

            $uploadResult = (new UploadApi())->upload($file->getRealPath(), [
                'folder'        => $folder,
                'resource_type' => 'raw',
                'overwrite'     => false,
            ]);

            $user  = Auth::user();
            $media = FileEntity::create([
                'user_id'    => $user->id,
                'disk'       => 'cloudinary',
                'entity'     => get_class($entity),
                'entity_id'  => $entity->id,
                'filename'   => $uploadResult['public_id'],
                'identifier' => $identifier,
                'path'       => $uploadResult['secure_url'],
                'extension'  => $file->guessClientExtension() ?? $file->getClientOriginalExtension(),
                'mime'       => $file->getClientMimeType(),
                'size'       => $file->getSize(),
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
