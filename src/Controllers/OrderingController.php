<?php

namespace Vadiasov\Ordering\Controllers;

use App\Album;
use App\Http\Controllers\Controller;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderingController extends Controller
{
    public function index($configName, $parentId, $parentId2 = null)
    {
        $active  = 'albums';
        $user    = Auth::user();
        $config  = config($configName);
        $rows    = DB::table($config['db_table'])
            ->where($config['parent_foreign_column'], $parentId)
            ->where($config['parent_foreign_column_2'], $parentId2)
            ->orderBy('order', 'asc')
            ->get();
        $parent  = DB::table($config['parent_db_table'])
            ->where('id', $parentId)
            ->first();
        $url     = '/ordering/' . $configName . '/' . $parentId;
        $backUrl = $config['backUrl'];
        
        return view('ordering::index', compact(
            'configName',
            'active',
            'user',
            'config',
            'rows',
            'parent',
            'url',
            'backUrl'
        ));
    }
    
    public function index2($configName, $parentId, $parentId2)
    {
        $active  = 'albums';
        $user    = Auth::user();
        $config  = config($configName);
        $rows    = DB::table($config['db_table'])
            ->where($config['parent_foreign_column'], $parentId2)
            ->orderBy('order', 'asc')
            ->get();
        $parent  = DB::table($config['parent_db_table'])
            ->where('id', $parentId2)
            ->first();
        $url     = '/ordering/' . $configName . '/' . $parentId;
        $backUrl = $config['backUrl'];
        
        return view('ordering::index2', compact(
            'configName',
            'active',
            'user',
            'config',
            'rows',
            'parent',
            'url',
            'backUrl',
            'parentId2'
        ));
    }
    
    public function update(Request $request, $configName, $albumId)
    {
        // Get rows id and generate ids array
        $idArray = explode(",", $_POST['ids']);
        
        $config = config($configName);
        
        foreach ($idArray as $order => $id) {
            DB::table($config['db_table'])
                ->where('id', intval($id))
                ->update([$config['order'] => $order]);
        }
    }
}
