<?php

namespace Modules\File\Facades;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\File\Models\File as FileEntity;

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

            // $path = Storage::disk($storageDisk)->putFileAs($dir, $file, $fileName );

             // Define the directory path
            $path = 'uploads/' . $dir;
            $destinationPath = public_path($path);

            // Move the file to the public/uploads directory
            $file->move($destinationPath, $fileName);

            $user = Auth::user();
            $media= FileEntity::create([
                'user_id' => $user->id,
                'disk' =>  $storageDisk,
                'entity' => $entityClass,
                'entity_id' => $entity->id,
                'filename' => $fileName,
                'identifier' => $identifier,
                'path' => $destinationPath,
                'extension' => $file->guessClientExtension() ?? '',
                'mime' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);

            return $media;

        } catch (\Exception $e) {
            dd($e);
        }
    }

    // public static function defaultUpload($file, $entity = null, $disk = null, $dir = null, $identifier = null)
    // {
    //     try {
    //         $storageDisk = $disk ?? config('filesystems.default');
    //         $entityClass = get_class($entity);
    //         $current = Carbon::now()->format('YmdHs');
    //         $fileExtension = $file->getClientOriginalExtension();

    //         // unique filename with timestamp
    //         $nnn = str_replace($fileExtension, '-' . $current . '.' . $fileExtension, Str::slug($file->getClientOriginalName()));
    //         $fileName = strtoupper($nnn);

    //         // Define the directory path
    //         $dir = 'uploads/' . $dir;
    //         $destinationPath = public_path($dir);

    //         // Ensure the directory exists
    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0777, true);
    //         }

    //         // Move the file to the public/uploads directory
    //         $file->move($destinationPath, $fileName);

    //         // dd($dir, $fileName);

    //         $user = Auth::user();
    //         $media = FileEntity::create([
    //             'user_id' => $user->id,
    //             'disk' => 'public',
    //             'entity' => $entityClass,
    //             'entity_id' => $entity->id,
    //             'filename' => $fileName,
    //             'identifier' => $identifier,
    //             'path' => $dir . '/' . $fileName,
    //             'extension' => $file->guessClientExtension() ?? '',
    //             'mime' => $file->getClientMimeType(),
    //             'size' => filesize($destinationPath . '/' . $fileName),
    //         ]);

    //         return $media;
    //     } catch (\Exception $e) {
    //         throw $e; // Rethrow the exception
    //     }
    // }

    // public static function deleteFile($files, $disk=null) {
    public static function deleteFile($files, $disk = null)
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

    // public static function deleteFile($files, $disk=null) {
    //     try {
    //         $storageDisk = $disk ?? config('filesystems.default');
    //         if( $files instanceof Collection ){
    //             foreach ($files as $file ) {
    //                 Storage::disk($storageDisk)->delete($file->path);
    //                 $file->delete();
    //             }
    //         }else{
    //             Storage::disk($storageDisk)->delete($files->path);
    //             $files->delete();
    //         }

    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
}
