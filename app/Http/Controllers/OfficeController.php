<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\OfficeDivision;
use App\Models\OfficeDepart;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class OfficeController extends Controller
{

  public function index()
  {
    return view('offices.index');
  }

  public function office_data()
  {
    \DB::statement(\DB::raw('set @rownum=0'));
    $offices = Office::select([
      \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
      'id',
      'code',
      'name',
      'abbreviation',
      'date_open'
    ]);
    return Datatables::of($offices)
    ->addColumn('action', function ($office) {
      return '
              <a href="./office/detail_division/'.$office->id.'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i> Divisi</a>
              <a href="./office/edit/'.$office->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
              ';
    })
    ->editColumn('date_open', function ($office) {
                  return $office->date_open ? with(new Carbon($office->date_open))->format('d/m/Y') : '';
            })
    ->make(true);
  }

    public function create()
    {
        return view('offices.create');
    }

    public function store(Request $request)
    {
      $this->store_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $office=$request->input();
      Office::create($office);

      Session::flash('flash_message', 'Data berhasil ditambahkan!');

      return redirect('master/offices');
    }


    public function edit($id)
    {
      $office=Office::find($id);
      return view('offices.edit',compact('office'));
    }


    public function update(Request $request, $id)
    {
      $this->update_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $officeUpdate=$request->input();

      $office=Office::find($id);
      $office->update($officeUpdate);

      $imageName = $office->id . '-office.' .
      $request->file('url_photo')->getClientOriginalExtension();

       $request->file('url_photo')->move(
           base_path() . '/public/images/offices/', $imageName
       );

      Session::flash('flash_message', 'Data berhasil diupdate!');

      return redirect('master/offices');
    }


    public function destroy($id)
    {
        //
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

    private function store_validation_rules($request)
    {
      $this->validate($request, [
        'name' => 'required',
        'code' => 'required|unique:regions',
        'abbreviation' => 'required',
        'date_open' => 'required'
      ]);
    }

    private function update_validation_rules($request)
    {
      $this->validate($request, [
        'name' => 'required',
        'abbreviation' => 'required',
        'date_open' => 'required'
      ]);
    }

    public function division_data($id)
    {
      return view('offices.detail_division');
    }

    public function detail_division($id)
    {
      $office = Office::where('offices.id', '=', $id)
      ->select('offices.id','offices.name','offices.code','offices.abbreviation','offices.date_open')
      ->firstOrFail();

      $division = OfficeDivision::where('office_divisions.office_id','=', $id)
      ->select('office_divisions.id','office_divisions.name','office_divisions.code','office_divisions.abbreviation','office_divisions.date_open')
      ->get();

      $data_division = array(
        'office'  => $office,
        'division' => $division
      );

      return view('offices.detail_division',compact('data_division'));
    }

    public function get_division_data()
    {
      \DB::statement(\DB::raw('set @rownum=0'));
      $divisions = OfficeDivision::select([
        \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
        'id',
        'office_id',
        'code',
        'name',
        'abbreviation',
        'date_open'
      ]);
      return Datatables::of($divisions)
      ->addColumn('action', function ($divisi) {
        return '
                <a href="./detail_depart/'.$divisi->id.'" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i> Bagian</a>
                <a href="./edit/'.$divisi->office_id.'/'.$divisi->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy_division/' . $divisi->id . '">Delete</button>
                ';
      })
      ->editColumn('date_open', function ($divisi) {
                    return $divisi->date_open ? with(new Carbon($divisi->date_open))->format('d/m/Y') : '';
              })
      ->make(true);
    }

    public function store_division(Request $request)
    {
      $this->store_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $division=$request->input();
      $save_division = OfficeDivision::create($division);

      if ($request->file('url_photo') != "") {
        $imageName = $save_division->id . '-divisi.' .
        $request->file('url_photo')->getClientOriginalExtension();

         $request->file('url_photo')->move(
             base_path() . '/public/images/divisions/', $imageName
         );
      }
      // return Redirect::to(URL::previous() . "#kprks-table");
      Session::flash("flash_message", "Data tersimpan!");

      return redirect()->back();
    }

    public function edit_division($id, $id_divisi)
    {
      $office = Office::where('offices.id', $id)->first();
      $division = OfficeDivision::find($id_divisi);

      return view('offices.edit_division',compact('division','office'));
    }

    public function update_division(Request $request, $id)
    {
      $id_office = $request->input('office_id');

      $this->update_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $DivisionUpdate=$request->input();

      $offDivision=OfficeDivision::find($id);
      $offDivision->update($DivisionUpdate);
      if ($request->file('url_photo') != "") {

      $imageName = $offDivision->id . '-divisi.' .
      $request->file('url_photo')->getClientOriginalExtension();

       $request->file('url_photo')->move(
           base_path() . '/public/images/divisions/', $imageName
       );
     }

      Session::flash('flash_message', 'Data berhasil diupdate!');

      return redirect('master/office/detail_division/'.$id_office);
    }

    public function destroy_division($id)
    {
        $data = OfficeDivision::findOrFail($id);
        $data->delete();

        Session::flash('flash_message', 'Data berhasil dihapus');
        return redirect()->back();
    }


    public function depart_data($id)
    {
      return view('offices.detail_depart');
    }

    public function detail_depart($id)
    {
      $division = OfficeDivision::where('office_divisions.id', '=', $id)
      ->select('office_divisions.id','office_divisions.name','office_divisions.code','office_divisions.abbreviation','office_divisions.date_open')
      ->firstOrFail();

      $depart = OfficeDepart::where('office_departs.office_division_id','=', $id)
      ->select('office_departs.id','office_departs.name','office_departs.code','office_departs.abbreviation','office_departs.date_open')
      ->get();

      $data_depart = array(
        'division'  => $division,
        'depart' => $depart
      );

      return view('offices.detail_depart',compact('data_depart'));
    }

    public function get_depart_data()
    {
      \DB::statement(\DB::raw('set @rownum=0'));
      $departs = OfficeDepart::select([
        \DB::raw('@rownum  := @rownum  + 1 AS rownum'),
        'id',
        'office_division_id',
        'code',
        'name',
        'abbreviation',
        'date_open'
      ]);
      return Datatables::of($departs)
      ->addColumn('action', function ($depart) {
        return '
                <a href="./edit/'.$depart->office_division_id.'/'.$depart->id.'" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button id="btn-delete" class="btn btn-xs btn-danger" data-remote="./destroy_depart/' . $depart->id . '">Delete</button>
                ';
      })
      ->editColumn('date_open', function ($depart) {
                    return $depart->date_open ? with(new Carbon($depart->date_open))->format('d/m/Y') : '';
              })
      ->make(true);
    }

    public function store_depart(Request $request)
    {
      $this->store_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $depart=$request->input();
      $save_depart = OfficeDepart::create($depart);

      $imageName = $save_depart->id . '-bagian.' .
      $request->file('url_photo')->getClientOriginalExtension();

       $request->file('url_photo')->move(
           base_path() . '/public/images/bagian/', $imageName
       );

      // return Redirect::to(URL::previous() . "#kprks-table");
      Session::flash("flash_message", "Data tersimpan!");

      return redirect()->back();
    }

    public function edit_depart($id, $id_depart)
    {
      $division = OfficeDivision::where('office_divisions.id', $id)->first();
      $depart = OfficeDepart::find($id_depart);

      return view('offices.edit_depart',compact('depart','division'));
    }

    public function update_depart(Request $request, $id)
    {
      $id_division = $request->input('office_division_id');

      $this->update_validation_rules($request);

      $date_open = $this->saved_date_format($request->input('date_open'));
      $request->merge(array('date_open'=>$date_open));

      $DepartUpdate=$request->input();

      $offDepart=officeDepart::find($id);
      $offDepart->update($DepartUpdate);
      if ($request->file('url_photo') != "") {

      $imageName = $offDepart->id . '-bagian.' .
      $request->file('url_photo')->getClientOriginalExtension();

       $request->file('url_photo')->move(
           base_path() . '/public/images/bagian/', $imageName
       );
     }

      Session::flash('flash_message', 'Data berhasil diupdate!');

      return redirect('master/office/detail_division/detail_depart/'.$id_division);
    }

    public function destroy_depart($id)
    {
        $data = OfficeDepart::findOrFail($id);
        $data->delete();

        Session::flash('flash_message', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
