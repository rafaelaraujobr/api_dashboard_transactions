<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

// use function PHPSTORM_META\type;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');
        $region = $request->query('region');
        $payment_method = $request->query('paymentMethod');
        $payment_status = $request->query('paymentStatus');
        $device = $request->query('device');
        $gender = $request->query('gender');
        $perPage = $request->query('perPage') ?? 10;;
        $to = $request->query('to');
        $from = $request->query('from');


        $query = Transaction::query();
        if ($to && $from) $query->whereBetween('created_at', [$from, $to]);
        if ($search) $query->where('client', 'like', '%' . $search . '%');
        if ($region) $query->where('region', $region);
        if ($payment_method) $query->where('payment_method', $payment_method);
        if ($payment_status) $query->where('payment_status', $payment_status);
        if ($device)  $query->where('device', $device);
        if ($gender)  $query->where('gender', $gender);
        $query->orderBy('created_at', 'asc');
        $data = $query->paginate($perPage);
        return TransactionResource::collection($data);
    }


    public function widgets($type, Request $request)
    {
        try {
            $validator = Validator::make(['type' => $type], [
                'type' => 'required|in:transactions,geolocation,region,min_max,revenue,quantity,device,payment_method,payment_status,gender',
            ]);
            if ($validator->fails()) throw new \Exception("Type not found", 1);

            $query = Transaction::query();

            $to = $request->query('to');
            $from = $request->query('from');
            if ($to && $from) $query->whereBetween('created_at', [$from, $to]);

            switch ($type) {
                case 'min_max':
                    $data = new stdClass();
                    $data->max = $query->max('value');
                    $data->min =  $query->min('value');
                    return $data;
                    break;
                case 'revenue':
                    return $query->where('payment_status', 'paid')->sum('value');
                    break;
                case 'quantity':
                    return $query->sum('quantity');
                    break;
                case 'transactions':
                    return $query->count();
                    break;
                case 'geolocation':
                    return $query->select('client', 'lat', 'long',)->get();
                    break;
                case 'region':
                    return $query->select('region', DB::raw('count(*) as total'))
                        ->groupBy('region')
                        ->pluck('total', 'region')->toArray();
                    break;
                case 'gender':
                    return $query->select('gender', DB::raw('count(*) as total'))
                        ->groupBy('gender')
                        ->pluck('total', 'gender')->toArray();
                    break;
                case 'device':
                    return $query->select('device', DB::raw('count(*) as total'))
                        ->groupBy('device')
                        ->pluck('total', 'device');
                    break;
                case 'payment_method':
                    return $query->select('payment_method', DB::raw('count(*) as total'))
                        ->groupBy('payment_method')
                        ->pluck('total', 'payment_method');
                    break;
                case 'payment_status':
                    return Transaction::select('payment_status', DB::raw('count(*) as total'))
                        ->groupBy('payment_status')
                        ->pluck('total', 'payment_status');
                    break;
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 404);
        }
    }


    public function show(string $id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            return $transaction;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }
    }


    // public function typeWidgets($type)
    // {
    //     // dd($type);
    //     $data = new stdClass();
    //     if ($type == 'all') {
    //         $data->count = Transaction::count();
    //         $data->total = Transaction::sum('value');
    //         $data->qtd = Transaction::sum('quantity');
    //         $data->max = Transaction::max('value');
    //         $data->min = Transaction::min('value');
    //         $data->transaction = Transaction::select('value', 'quantity')->get();
    //     } else {
    //         $data = Transaction::select($type, DB::raw('count(*) as total'))
    //             ->groupBy($type)
    //             ->pluck('total', $type);
    //     }

    //     return $data;
    // }
}
