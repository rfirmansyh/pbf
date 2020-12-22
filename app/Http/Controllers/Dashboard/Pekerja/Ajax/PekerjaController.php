<?php

namespace App\Http\Controllers\Dashboard\Pekerja\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class PekerjaController extends Controller
{

    public function getKebutuhanTypeById($id) {
        $kebutuhanType = \App\KebutuhanType::find($id);
        return api_response(1, 'KebutuhanType By Id Success', $kebutuhanType);
    }
}
