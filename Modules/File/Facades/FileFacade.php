<?php

namespace Modules\File\Facades;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Modules\File\Entities\File as FileEntity;
use Illuminate\Support\Collection;




class FileFacade
{
    
    public static function defaultUpload($file, $entity = null, $disk=null, $dir=null, $identifier= null ) {
        try {

            $storageDisk = $disk ?? config('filesystems.default');
            $entityClass = get_class($entity);
        	$current = Carbon::now()->format('YmdHs');
	        $fileExtension = $file->getClientOriginalExtension();

	        // regular filename
	        // $nnn =str_replace( $fileExtension,  '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
	        // $fileName = strtoupper($nnn);

	        // unique filename with timestamp
	        $nnn =str_replace( $fileExtension, '-'.$current . '.' .$fileExtension,  Str::slug($file->getClientOriginalName()) );
	        $fileName = strtoupper($nnn);

	        // $path = Storage::putFileAs('resource', $file, $fileName ); //specify sub dir
	        $path = Storage::disk($storageDisk)->putFileAs($dir, $file, $fileName );
	         
	        $media= FileEntity::create([
	            'user_id' => auth()->id(),
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
        	
        } catch (\Exception $e) {
        	
        }
    }


    public static function deleteFile($media, $disk=null) {
        try {

            
            $storageDisk = $disk ?? config('filesystems.default');
            if( $media instanceof Collection ){
                foreach ($media as $med ) {
                    Storage::disk($storageDisk)->delete($med->path);
                    $med->delete();
                }
            }else{
                Storage::disk($storageDisk)->delete($media->path);
                $media->delete();
            }
           
        } catch (Exception $e) {
        	
        }
    }
}
