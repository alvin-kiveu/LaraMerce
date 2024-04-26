<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Roles;
use App\Http\Controllers\ProcessorController;


class AuthController extends Controller
{


    public function loginUser(Request $request)
    {
        $logindata = $request->logindata;
        $password = $request->password;
        //HASH PASSWORD
        //$password = Hash::make($password);
        //CHECK IF USER EXISTS ON DB
       //CHACK IF USER HAS LOGIN WITH EMAIL OR USERNAME
        if (filter_var($logindata, FILTER_VALIDATE_EMAIL)) {
            $user = DB::table('users')
                ->where('email', $logindata)
                ->first();
        } else {
            $user = DB::table('users')
                ->where('username', $logindata)
                ->first();
        }
        if ($user && Hash::check($password, $user->password)) {
            $useruniqueid = $user->user_id;
            $request->session()->put('user_id', $useruniqueid);
            //RECORD SYSTEM LOG
            $systermlogsrecord = new ProcessorController();
            $systermlogsrecord->system_logs($useruniqueid, 'Logged in', 'User logged in successfully');
            return redirect('/laradmin/controlpanel')->with('success', 'Login successful');
        } else {
            // User not found or incorrect password
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }



    public function logoutUser(Request $request)
    {
        //GET USER ID
        $user_id = $request->session()->get('user_id');
        //RECORD SYSTEM LOG
        $systermlogsrecord = new ProcessorController();
        $systermlogsrecord->system_logs($user_id,'Logged out', 'User logged out successfully');
        $request->session()->forget('user_id');
        return redirect('/laradmin/login')->with('success', 'Logout successful');
    }

    public function addRole(Request $request)
    {
        $rolename = strip_tags($request->rolename);
        //GET PERMISSIONS CHECKED
        $employee_management = $request->employee_management;
        $leave_management = $request->leave_management;
        $payroll_management = $request->payroll_management;
        $attendance_management = $request->attendance_management;
        $analytics_reports = $request->analytics_reports;
        $recruitment = $request->recruitment;
        $user_management = $request->user_management;
        //CREATE A JSON ARRAY OF PERMISSIONS
        $permissions = array(
            'employee_management' => $employee_management,
            'leave_management' => $leave_management,
            'payroll_management' => $payroll_management,
            'attendance_management' => $attendance_management,
            'analytics_reports' => $analytics_reports,
            'recruitment' => $recruitment,
            'user_management' => $user_management
        );
        $permissions = json_encode($permissions);
        //ADD ROLE TO DB
        $addRole = DB::table('roles')->insert([
            'name' => $rolename,
            'permissions' => $permissions
        ]);
        //RECORD SYSTEM LOG
        $systermlogsrecord = new ProcessorController();
        $user_id = $request->session()->get('user_id');
        $systermlogsrecord->system_logs($user_id,'Added role', 'Role added successfully');
        if ($addRole) {
            return redirect()->back()->with('success', 'Role added successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add role');
        }
    }

    public function showRoles()
    {
        $roles = Roles::all(); // Assuming Role is your model
        return view('auth.rolelist', compact('roles'));
    }

    public function editRole($id)
    {
        $role = Roles::find($id);
        return view('auth.editrole', compact('role'));
    }

    public function deleteRole($id)
    {
        $deleteRole = DB::table('roles')->where('id', $id)->delete();
        if ($deleteRole) {
            return redirect()->back()->with('success', 'Role deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete role');
        }
    }

    public function editUserRole(Request $request)
    {
        $id = $request->roleid;
        $rolename = strip_tags($request->rolename);
        //GET PERMISSIONS CHECKED
        $employee_management = $request->employee_management;
        $leave_management = $request->leave_management;
        $payroll_management = $request->payroll_management;
        $attendance_management = $request->attendance_management;
        $analytics_reports = $request->analytics_reports;
        $recruitment = $request->recruitment;
        $user_management = $request->user_management;
        //CREATE A JSON ARRAY OF PERMISSIONS
        $permissions = array(
            'employee_management' => $employee_management,
            'leave_management' => $leave_management,
            'payroll_management' => $payroll_management,
            'attendance_management' => $attendance_management,
            'analytics_reports' => $analytics_reports,
            'recruitment' => $recruitment,
            'user_management' => $user_management
        );
        $permissions = json_encode($permissions);
        //ADD ROLE TO DB
        $editRole = DB::table('roles')->where('ID', $id)->update([
            'name' => $rolename,
            'permissions' => $permissions
        ]);
        if ($editRole) {
            return redirect()->back()->with('success', 'Role updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update role');
        }
    }

    public function addViewUser()
    {
        $roles = Roles::all();
        return view('auth.adduser', compact('roles'));
    }

    public function showUsers()
    {
        $users = DB::table('users')->get();
        return view('auth.userlist', compact('users'));
    }

    public function editUser($id)
    {
        $user = DB::table('users')->where('ID', $id)->first();
        if (!$user) {
            abort(404);
        }
        $roles = Roles::all();
        return view('auth.edituser', compact('user', 'roles'));
    }

    public function deleteUser($id)
    {
        $deleteUser = DB::table('users')->where('ID', $id)->delete();
        if ($deleteUser) {
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }

    public function addUser(Request $request)
    {
        $email = strip_tags($request->email);
        $password = strip_tags($request->password);
        $role = strip_tags($request->role);
        //HASH PASSWORD
        $password = Hash::make($password);
        //CHECK IF USER EXISTS ON DB
        $emailCheck = DB::table('users')->where('email', $email)->first();
        if ($emailCheck) {
            return redirect()->back()->with('error', 'User already exists');
        } else {
            //ADD USER TO DB
            $addUser = DB::table('users')->insert([
                'email' => $email,
                'password' => $password,
                'role' => $role
            ]);
            if ($addUser) {
                return redirect()->back()->with('success', 'User added successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to add user');
            }
        }
    }


    public function editUserDetails(Request $request)
    {
        $id = $request->userid;
        $email = strip_tags($request->email);
        $password = strip_tags($request->password);
        $role = strip_tags($request->role);
        //CHECK IF PASSWORD HAS BEEN CHANGED
        if ($password != '') {
            //HASH PASSWORD
            $password = Hash::make($password);
            //UPDATE PASSWORD
            $password = DB::table('users')->where('ID', $id)->update([
                'password' => $password,
            ]);
        }

        //ADD USER TO DB
        $editUser = DB::table('users')->where('ID', $id)->update([
            'email' => $email,
            'role' => $role
        ]);

        if ($editUser) {
            return redirect()->back()->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update user');
        }
    }


}
