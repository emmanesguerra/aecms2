<?php

namespace Core\Http\Controller\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Core\Http\Requests\StoreMenuRequest;
use Core\Model\Menu;
use Core\Library\HierarchicalDB;
use Core\Library\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.layouts.modules.menu.index');
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
            1 => ['title']
        ];
        
        $filteredmodel = DB::table('menus')
                ->select(DB::raw("title, 
                    parent_id")
            );
        
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
        try
        {
            $parent = Menu::find($request->parentId);
            
            $hierarchyLib = new HierarchicalDB('menus');
            
            if($parent) {
                $hierarchyLib->updateLftPlus($parent->rgt);
                $hierarchyLib->updateRgtPlus($parent->rgt);
                $left = $parent->rgt;
                $lvl = $parent->lvl + 1;
            } else {
                $left = $hierarchyLib->getLastRgt() + 1;
                $lvl = 1;
            }
            $right = $left + 1;
            $title = ($request->has('pageId')) ? Page::find($request->pageId)->title: $request->nTitle;
            
            Menu::create([
                'title' => $title,
                'parent_id' => $request->parentId,
                'page_id' => ($request->has('pageId')) ? $request->pageId: null,
                'lft' => $left,
                'rgt' => $right,
                'lvl' => $lvl
            ]);
            
            return response(['response'=> 'Menu created'], 200);
            
        } catch (\Exception $ex) {
            return response(['response'=> $ex->getMessage()], 400);
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
