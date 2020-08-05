<?php

namespace Core\Http\Controller\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Core\Http\Requests\StorePageRequest;
use Core\Model\Page;
use Core\Model\Content;
use Core\Library\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.modules.page.index');
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
            1 => ['id'],
            2 => ['title'],
            3 => ['url'],
            4 => ['description'],
            5 => ['javascripts'],
            6 => ['css'],
            7 => ['template'],
            8 => ['updated_at'],
        ];
        
        $filteredmodel = DB::table('pages')
                ->select(DB::raw("id, 
                    title, 
                    url,
                    description, 
                    javascripts, 
                    css,
                    template,
                    updated_at")
            );
        
        $modelcnt = $filteredmodel->count();
        
        $data = DataTables::DataTableFilters($filteredmodel, $request, $tablecols, $hasValue, $totalFiltered);
        
        return response(['data'=> $data,
            'draw' => $request->draw,
            'recordsTotal' => ($hasValue)? $data->count(): $modelcnt,
            'recordsFiltered' => ($hasValue)? $totalFiltered: $modelcnt], 200);
    }
    
    public function template(Request $request)
    {
        $file = Storage::disk('templates')->get($request->template);
        
        $pattern = '/\{!!(.*?)\!!}/';
        preg_match_all ($pattern, $file, $matches);
        
        $resp = collect($matches[1])->map(function($panels) {
             return [
                     'panel' => trim(str_replace('$', '', $panels)),
                     'name' => null,
                     'html_template' => null,
                     'isnew' => false,
                     'selected' => null
             ];
        });
        
        return response(['data'=> $resp], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $files = Storage::disk('templates')->allFiles();
        $scripts = Storage::disk('javascripts')->allFiles();
        $styles = Storage::disk('css')->allFiles();
        
        $contents = Content::get(['id', 'name']);
        $contents->push(['id' => 'NEW', 'name' => 'Create New'])->toArray();
        
        return view('admin.layouts.modules.page.create')->with(compact('files', 'scripts', 'styles', 'contents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        try
        {
            DB::beginTransaction();
            
            $page = Page::create($request->only('title', 'url', 'description', 'javascripts', 'css', 'template'));
            
            if($page) {
                if($request->has('contents')) {
                    foreach($request->contents as $tags => $data) {
                        if(isset($data['selected_panel'])) {
                            $contentId = $data['selected_panel'];
                        } else {
                            $content = Content::create(['name' => $data['name'], 'html_template' => $data['html_template'], 'type' => ($tags == 'Main') ? 'M': 'P']);
                            $contentId = $content->id;
                        }
                        
                        $page->contents()->attach($contentId, ['tags' => $tags]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('pages.index')->with('status-success', 'Page created successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('status-failed', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        
        $panels = $page->contents->map(function ($panel) {
            return [
                     'panel' => $panel->pivot->tags,
                     'name' => $panel->id,
                     'html_template' => $panel->html_template,
                     'isnew' => false,
                     'selected' => $panel->id
             ];
        });
        
        $files = Storage::disk('templates')->allFiles();
        $scripts = Storage::disk('javascripts')->allFiles();
        $styles = Storage::disk('css')->allFiles();
        
        $contents = Content::get(['id', 'name']);
        $contents->push(['id' => 'NEW', 'name' => 'Create New'])->toArray();
        
        return view('admin.layouts.modules.page.edit')->with(compact('page', 'files', 'scripts', 'styles', 'contents', 'panels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            DB::beginTransaction();
            
            $page = Page::find($id);
            $page->update($request->only('title', 'description', 'javascripts', 'css', 'template'));
            
            if($page) {
                if($request->has('contents')) {
                    $page->contents()->detach();
                    foreach($request->contents as $tags => $data) {
                        if(isset($data['selected_panel'])) {
                            $contentId = $data['selected_panel'];
                        } else {
                            $content = Content::create(['name' => $data['name'], 'html_template' => $data['html_template'], 'type' => ($tags == 'Main') ? 'M': 'P']);
                            $contentId = $content->id;
                        }
                        
                        $page->contents()->attach($contentId, ['tags' => $tags]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('pages.index')->with('status-success', 'Page updated successfully');
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('status-failed', $ex->getMessage());
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
        try
        {
            Page::find($id)->delete();
            return redirect()->route('pages.index')
                            ->with('status-success','Page deleted successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('status-failed', $ex->getMessage());
        }
    }
}
