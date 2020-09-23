<?php

namespace Core\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Core\Model\Content;
use Core\Library\DataTables;
use Core\Library\FileManager;
use Core\Http\Requests\UpdateContentRequest;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:contents-list|contents-edit', ['only' => ['index','store']]);
         $this->middleware('permission:contents-edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.modules.content.index');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sub()
    {
        return view('admin.layouts.modules.content.sub');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $tablecols = [
            0 => ['id'],
            1 => ['name'],
            3 => ['updated_at'],
        ];
        
        $filteredmodel = Content::with('pages')->select(['id', 'name', 'updated_at'])->where(['class_namespace' => null, 'method_name' => null]);
        
        if($request->main == 'true') {
            $filteredmodel->where('type', 'M');
        } else {
            $filteredmodel->where('type', 'P');
        }
        
        $modelcnt = $filteredmodel->count();
        
        $data = DataTables::DataTableFilters($filteredmodel, $request, $tablecols, $hasValue, $totalFiltered);
        
        return response(['data'=> $data,
            'draw' => $request->draw,
            'recordsTotal' => ($hasValue)? $data->count(): $modelcnt,
            'recordsFiltered' => ($hasValue)? $totalFiltered: $modelcnt], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::find($id);
        
        $page = $content->pages->first();
        
        return redirect($page->url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disk = 'adminuploads';
        $allFiles = Storage::disk($disk)->files();
        $images = FileManager::getImageRelativePath($allFiles, $disk);
        
        $content = Content::find($id);
        $page = $content->pages->first();
        if($page) {
            $styles = FileManager::getCSSRelativePath($page->css);
        } else {
            $styles = [];
        }
        
        
        return view('admin.layouts.modules.content.edit')->with(compact('content', 'styles', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->all();

            $content = Content::find($id);
            $content->update($input);
            
            $redirect = ($content->type == 'M') ? 'admin.contents.index': 'admin.contents.sub';

            DB::commit();
            return redirect()->route($redirect)
                            ->with('status-success','Content updated successfully');
            
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()
                    ->with('status-failed', $ex->getMessage())
                    ->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
