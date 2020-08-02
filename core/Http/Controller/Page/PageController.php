<?php

namespace Core\Http\Controller\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Core\Http\Requests\StorePageRequest;
use Core\Model\Page;

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
        
        return view('admin.layouts.modules.page.create')->with(compact('files', 'scripts', 'styles'));
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
            $data = [
                'title' => ''
            ];
            
            return redirect()->route('pages.index')->with('status-success', 'Page created successfully');
        } catch (\Exception $ex) {
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
        //
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
        //
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
