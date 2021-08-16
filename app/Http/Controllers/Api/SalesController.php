<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request) {
        $builder = Sale::query()->where('date', '>=', Carbon::now()->subMonths(15)->toDateTimeString());

        if($startDate = $request->input('startDate')) {
            $from = date('Y-m-d H:i:s', strtotime($startDate));
            $builder->where('date', '>=', $from);
        }

        if($endDate = $request->input('endDate')) {
            $to = date('Y-m-d H:i:s', strtotime($endDate));
            $builder->where('date','<=',$to);
        }

        $sales = $builder->groupBy('date')->select('date', DB::raw('count(*) as total'))->get();

        return response()->json($sales);
    }
}
