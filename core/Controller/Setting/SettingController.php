<?php

namespace Core\Controller\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Library\Modules\SystemConfigLibrary;
use Core\Library\DropdownOptions;
use Core\Validations\StoreSettingsRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        
        $data['timezones'] = DropdownOptions::timezones();
        $data['model'] = [
            'developer' => SystemConfigLibrary::retrieve('developer'),
            'domain_name' => SystemConfigLibrary::retrieve('domain_name'),
            'meta_description' => SystemConfigLibrary::retrieve('meta_description'),
            'meta_keywords' => SystemConfigLibrary::retrieve('meta_keywords'),
            'tags' => SystemConfigLibrary::retrieve('meta_keywords'),
            'meta_title' => SystemConfigLibrary::retrieve('meta_title'),
            'owner' => SystemConfigLibrary::retrieve('owner'),
            'timezone' => SystemConfigLibrary::retrieve('timezone'),
            'website_name' => SystemConfigLibrary::retrieve('website_name'),
            'email_recipients' => SystemConfigLibrary::retrieve('email_recipients'),
            'email_cc' => SystemConfigLibrary::retrieve('email_cc'),
            'email_bcc' => SystemConfigLibrary::retrieve('email_bcc'),
        ];
        
        return view('admin.layouts.modules.setting.form')->with(compact('data'));
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
    public function store(StoreSettingsRequest $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                SystemConfigLibrary::save($key, $value);
            }

            return response(['message' => 'System settings have been configured'], 201);
        } catch (Exception $ex) {
            return response(['message' => $ex->message], 400);
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
