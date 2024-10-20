<?php

namespace Modules\File\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\File\Facades\FileFacade;




class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()

    {
        return response()->json([
            'status' => 'success',
            'message' => 'File retrieved successfully',
            'data' => account()->user->media
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $media = [];
        if( request()->files->count() ){
            $files = request()->files;
            foreach ($files as $key => $value) {
                FileFacade::deleteFile( account()->media()->where('identifier', $key)->get() ); //delete previous
                $media = FileFacade::defaultUpload($value, account(), identifier: $key);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded successfully',
            'data' => $media
        ]);

    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        account()->media()->findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'File deleted successfully',
        ], 204);
        
    }
}
