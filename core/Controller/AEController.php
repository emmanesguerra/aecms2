<?php

namespace Core\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Core\Model\Page;

class AEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($params = null)
    {
        $url = '/' . $params;
        
        $page = Page::where('url', $url)->first();
        
        if($page) {
            
            $data = array(
                'css' => $page->css,
                'js' => $page->javascripts
            );
            
            foreach($page->panels as $panel) {
                if($panel->html_template) {
                    $data[$panel->pivot->tags] = $panel->html_template;
                } else {
                    $module = new $panel->module_name;
                    $fnname = $panel->fn_name;
                    $data[$panel->pivot->tags] = $module->$fnname();
                }
            }
            
            return view('templates.' . str_replace('.blade.php', "", $page->template), $data);
        } else {
            echo 'not found';
        }
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
