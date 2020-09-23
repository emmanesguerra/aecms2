<?php

namespace Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Core\Model\Page;
use Core\Model\DailyCounter;

class AEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($params = null)
    {   
        $dc = DailyCounter::firstOrNew(['date' => date('Y-m-d')]);
        $dc->ctr = ($dc->ctr + 1);
        $dc->save();
            
        $url = array_filter(explode('/', \Request::getPathInfo()));
        
        $page = Page::where('slug', '/'. reset($url))->first();
        
        if($page) {
            
            $data = [];
            
            $metaTitle = $page->meta_title;
            $metaDesc = $page->meta_description;
            
            foreach($page->contents as $panel) {
                if($panel->html_template) {
                    $data[$panel->pivot->tags] = $panel->html_template;
                
                    if($panel->type == 'M') {
                        $metaTitle = $panel->meta_title;
                        $metaDesc = $panel->meta_description;
                    }
                } else {
                    $module = new $panel->class_namespace;
                    $fnname = $panel->method_name;
                    $res = $module->$fnname($panel, $url);
                    $data[$panel->pivot->tags] = $res['content'];
                
                    if($panel->type == 'M') {
                        $metaTitle = $res['meta_title'];
                        $metaDesc = $res['meta_description'];
                    }
                }
            }
        
            $this->GenerateHeader($page, $metaTitle, $metaDesc);
            
            echo view('templates.' . str_replace('.blade.php', "", $page->template), $data);
        
            $this->GenerateFooter($page);
            
        } else {
            Log::info('Missing Pages/Files');
            Log::info($url);
            abort(404);
        }
    }
    
    private function GenerateHeader(Page $page, $metaTitle, $metaDesc)
    {
        echo view('layouts.header')->with(compact('page', 'metaTitle', 'metaDesc'));
    }
    
    private function GenerateFooter(Page $page)
    {        
        echo view('layouts.footer')->with(compact('page'));
    }
}
