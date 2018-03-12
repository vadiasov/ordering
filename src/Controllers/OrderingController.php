<?php

namespace Vadiasov\Ordering\Controllers;

use App\Album;
use App\Http\Controllers\Controller;
use App\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderingController extends Controller
{
    public function index($configName, $albumId)
    {
        $active = 'albums';
        $user   = Auth::user();
        $config = config($configName);
        $tracks = Track::whereAlbumId($albumId)->get()->sortBy('order');
        $album  = Album::whereId($albumId)->first();
        $url = '/ordering/' . $configName . '/' . $albumId;
        $backUrl = '\Vadiasov\TracksAdmin\Controllers\TracksController@index';
        
        return view('ordering::index', compact(
            'configName',
            'active',
            'user',
            'config',
            'tracks',
            'album',
            'url',
            'backUrl'
        ));
    }
    
    public function update(Request $request, $configName, $albumId)
    {
        // Get images id and generate ids array
        $idArray = explode(",", $_POST['ids']);
        
        $config = config($configName);
    
        foreach ($idArray as $order => $id) {
            $item = Track::whereId(intval($id))->first();
            $item->order = $order;
            $item->save();
        }
        

// Update images order
//        $db->updateOrder($idArray);
        
    }
}
