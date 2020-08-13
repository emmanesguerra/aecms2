<?php

namespace Core\Model;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MenuSetting extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $primaryKey = 'menu_id';
    public $incrementing = false;
    
    protected $fillable = [
        'menu_id', 'main_ul_class', 'main_li_class', 'main_anch_class', 'suc_strt_div', 'suc_end_div', 'suc_strt_list', 'suc_end_list', 'suc_anch_class'
    ];
    
    protected $auditExclude = [
        'created_by'
    ];
}
