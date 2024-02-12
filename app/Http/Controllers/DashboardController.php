<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class DashboardController extends Controller
{
    //dashboard
    public function dashboard()
{
    // Get user information
    $userInfo = DB::table('users')->where('id', session('loggedInUser'))->first();

    // Get total counts
    $totalUsers = User::count();
    $totalEmployees = Employee::count();

    // Get all employees
    $employees = Employee::all();

    // Pass data to the view
    $data = [
        'userInfo' => $userInfo,
        'totalUsers' => $totalUsers,
        'totalEmployees' => $totalEmployees,
        'employees' => $employees,
    ];

    return view('frontend.dashboard', $data);
}

    //profile
    public function profile()
    {
        $data = ['userInfo' => DB::table('users')->where('id', session('loggedInUser'))->first() ];
        return view('frontend.profile', $data);
    }

    //table
    public function table()
    {
        $data = ['userInfo' => DB::table('users')->where('id', session('loggedInUser'))->first()];
        $employees = Employee::all();
        return view('frontend.table', compact('employees'));
        
    }


    //chart
    public function chart()
    {
        // Fetch data for the chart
        $data = Employee::select('department', 'position', DB::raw('COUNT(*) as count'))
            ->groupBy('department', 'position')
            ->get();
    
        return view('frontend.chart', compact('data'));
    }
    
    


    //add employee
    public function add()
    {
        return view('frontend.add');
    }

 
    //save employee details
    public function saveEmployee(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'position' => 'required|max:50',
            'department' => 'required|max:50',
            'salary' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'messages' => $validator->errors()->first(),
            ]);
        } else {
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->position = $request->input('position');
            $employee->department = $request->input('department');
            $employee->salary = $request->input('salary');
            $employee->save();

            return response()->json([
                'status' => '200',
                'messages' => 'new employee added successful',
            ]);
        }
    }

//update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'position' => 'required|max:50',
            'department' => 'required|max:50',
            'salary' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'messages' => $validator->errors()->first(),
            ]);
        } else {
            $employee = Employee::findOrFail($id);

            $employee->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'position' => $request->input('position'),
                'department' => $request->input('department'),
                'salary' => $request->input('salary'),

            ]);

            return response()->json([
                'status' => '200',
                'messages' => 'update successful',

            ]);

        }
    }

//delete
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('table')->with('success', 'employee deleted successfully!');
    }


    //edit
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('frontend.edit', compact('employee'));
    }

    //update employee
    public function updateEmployee(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'position' => 'required|max:50',
            'department' => 'required|max:50',
            'salary' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '404',
                'messages' => $validator->errors()->first(),
            ]);
        } else {
            $employee = Employee::findOrFail($id);

            $employee->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'position' => $request->input('position'),
                'department' => $request->input('department'),
                'salary' => $request->input('salary'),
            ]);

            return response()->json([
                'status' => '200',
                'messages' => 'Update successful',
            ]);
        }
    }


    //show
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('frontend.show', compact('employee'));
    }
  


}

