<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Exports\UserExport;
use App\Imports\userImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     //     public function datatable()
     */


    public function index(Request $request)
    {
        // return $dataTable->render('admin.userstable');

            if ($request->ajax()) {
                $data = User::with(['roles'])->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($data) {

                           return '<a id="view" data-id="'.$data->id.'" class="edit btn btn-info btn-sm">View</a>

                           <button type="button" class="btn btn-primary btn-sm" id="getEditProductData"data-toggle="modal" data-target="#EditProductModal" data-id="'.$data->id.'">Edit</button>';
                        })
                        ->addColumn('role', function($data){
                            return $data->roles[0]['name'];

                        })
                        ->rawColumns(['action','role'])

                        ->make(true);
            }


            return view('admin.users');
    }


    /**
     *
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
    public function store(Request $request)
    {
        $data = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>$request->input('password')
        ]);

        $data->attachRole(Role::where('name','employee')->first());

        return (['msg' => 'success']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);

        return view('admin.show')
        ->with('User',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);

        $html = '<div class="form-group">
                    <label for="Name">Name:</label>
                    <input type="text" class="form-control" name="name" id="editName" value="'.$data->name.'">
                </div>
                <div class="form-group">
                    <label for="Name">Display Name:</label>
                    <input type="email" class="form-control" name="email" id="editDisplayName" value="'.$data->email.'">
                </div>';

        return response()->json(['html'=>$html]);
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

        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->update();
        return response()->json(['success'=>'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        $data->delete();
        return redirect()->route('admin.index');
    }


    public function importForm(){
        return view('admin.import-form');
    }
    public function import(Request $request)
    {
        Excel::import(new userImport,$request->file);
        return "Record has been added successfully!";
    }

    public function exportIntoExcel()
    {
        return Excel::download(new UserExport,'userlist.xslx');
    }

    public function exportIntoCSV()
    {
        return Excel::download(new UserExport, 'userlist.csv');
    }
}

