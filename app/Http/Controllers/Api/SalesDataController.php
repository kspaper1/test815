<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalesResource;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesDataController extends Controller
{
    public function all(Request $request) {
        $temp = \Cache::get('sales');

        $builder = Sale::query()->orderBy('date', 'ASC');

        if($search = $request->input('search', '')) {
            $like = '%'.$search.'%';

            $builder->whereHas('customer', function($query) use ($like) {
                $query->where('full_name', 'like', $like);
            });
        }

        if($emp = $request->input('employee_id')) {
            $builder->where('employee_id', $emp);
        }

        if($startDate = $request->input('startDate')) {
            $from = date('Y-m-d H:i:s', strtotime($startDate));
            $builder->where('date', '>=', $from);
        }

        if($endDate = $request->input('endDate')) {
            $to = date('Y-m-d H:i:s', strtotime($endDate));
            $builder->where('date','<=',$to);
        }

        if(is_array($temp) && count($temp) > 0 )
        {
            $sales = $temp;
        }

        $sales = $builder->get();

        \Cache::forget('sales');

        return SalesResource::collection($sales);
    }

    public function employees() {
        $employees = Employee::all();

        return response()->json($employees);
    }
}
