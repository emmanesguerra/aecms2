<?php

namespace Core\Http\Controller\UploadedFiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Core\Library\FileManager;

class FileController extends Controller
{
    const ICON_IMG_WIDTH = 100;
    const MEDIUM_IMG_WIDTH = 300;
    const LARGE_IMG__WIDTH = 600;
    
    function __construct()
    {
         $this->middleware('permission:files-list|files-create', ['only' => ['index','store']]);
         $this->middleware('permission:files-create', ['only' => ['create','store']]);
    }
    
    public function index()
    {
        return view('admin.layouts.modules.files.index');
    }
    
    public function create()
    {
        return view('admin.layouts.modules.files.create');
    }
    
    public function store(Request $request)
    {
        try
        {
            $attachments = $request->file('attachments');
            $disk = 'adminuploads';
            foreach($attachments as $file){
                $newname = time() . '_' . strtolower($file->getClientOriginalName());
                Storage::disk($disk)->put($newname, file_get_contents($file));
                
                if((extension_loaded('imagick')) && (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif']))) {
                    
                    FileManager::ResizeAndSave($file, self::ICON_IMG_WIDTH, $newname, $disk, 'icon/');
                    
                    FileManager::ResizeAndSave($file, self::MEDIUM_IMG_WIDTH, $newname, $disk, 'medium/');
                    
                    FileManager::ResizeAndSave($file, self::LARGE_IMG__WIDTH, $newname, $disk, 'large/');
                }
            }

            return response(['success'=> true], 200);
        } catch (\Exception $ex) {
            return response(["success"=> false, "error" => $ex->getMessage(), "errorcode" => 400], 200);
        }
    }
}
