<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\Item;
use App\User;
use App\Models\AssetCategory;
use App\Models\AssetType;

use Yajra\Datatables\Datatables;

use Carbon\Carbon;

class ReportController extends Controller
{
  public function index()
  {
    $user_office_regional = User::lists('name', 'id');
    $asset_category = AssetType::lists('name', 'id');

    return view('reports.index',compact(['user_office_regional','asset_category']));
  }

  public function daily()
  {
    return view('reports.daily');
  }

  public function process_item(Request $request)
  {
    $date_start = $this->saved_date_format($request->input('date_start'));
    $date_end = $this->saved_date_format($request->input('date_end'));
    $user_id = $request->input('user_id');

    $user_name = User::find($user_id)->name;

    $data = $this->get_data_report($date_start,$date_end,$user_id);
    $date_start = $request->input('date_start');
    $date_end = $request->input('date_end');

    $view =  \View::make('reports.print_sallary_report', compact('data','date_start','date_end','user_name'))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
  }

  public function get_data_report($date_start,$date_end,$user_id)
  {
    $results = Transaction::whereBetween('date_order', [$date_start, $date_end])
    ->join('transaction_users','transaction_users.transaction_id','=','transactions.id')
    ->join('packages','transaction_users.package_id','=','packages.id')
    ->join('status','transactions.status_id','=','status.id')
    ->join('users','transaction_users.user_id','=','users.id')
    ->select('transactions.invoice_number','status.name as status_trans','transactions.date_order',
             'transaction_users.qty','transaction_users.end_date','transaction_users.status',
             'packages.name as package_name','packages.price_opr','packages.unit','users.name as user_name')
    ->whereBetween('transaction_users.end_date', [$date_start, $date_end])
    ->where('transaction_users.status','=','Selesai')
    ->where('transaction_users.user_id','=',$user_id)
    ->get();

    return $results;
  }

  public function process_daily(Request $request)
  {
    $date_start = $this->saved_date_format($request->input('date_start'));
    $date_end = $this->saved_date_format($request->input('date_end'));

    $data = $this->get_data_report_daily($date_start,$date_end);
    // dd($data);
    // die();
    $date_start = $request->input('date_start');
    $date_end = $request->input('date_end');

    $view =  \View::make('reports.print_daily_recap', compact('data','date_start','date_end'))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
  }

  public function get_data_report_daily($date_start,$date_end)
  {

    $results = PaymentHistory::whereBetween('payment_histories.created_at', [$date_start, $date_end])
    ->join('transactions','payment_histories.transaction_id','=','transactions.id')
    ->join('customers','transactions.customer_id','=','customers.id')
    ->join('status','transactions.status_id','=','status.id')
    ->select('payment_histories.amount as amount_payment','payment_histories.description as desc_payment','payment_histories.created_at as created_at_payment', 'transactions.invoice_number','transactions.date_checkout','transactions.discount','status.name as status_trans','transactions.date_order',
             'customers.name as customer_name','customers.address as customer_address')
    // ->groupBy('transactions.invoice_number')
    ->get();

    return $results;
  }

  private function saved_date_format($date)
  {
    $date_split = explode('/',$date);
    $year = $date_split[2];
    $month = $date_split[1];
    $day = $date_split[0];

    $format = $year.'-'.$month.'-'.$day;

    return $format;
  }



}
