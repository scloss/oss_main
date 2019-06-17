<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DALController extends Controller
{
    //////// Get all users //////////
    public function get_all_users()
    {
        //example of using direct query(not eloquent)
        $query = 'SELECT * FROM login_plugin_db.login_table order by row_id DESC';
        $data = \DB::select(\DB::raw($query));

        $data = \DB::table('login_table');//example of using eloquent

        if(count($data) > 0)
        {
            return $data;
        }
        else{
            return NULL;
        }
    }

    /////// Get User info //////////
    public function get_user_info($id)
    {
        $query = 'SELECT * FROM login_plugin_db.login_table WHERE row_id='.$id;
        $data = \DB::select(\DB::raw($query));
        if(count($data)>0)
        {
            return $data;
        }
        else{
            return NULL;
        }
    }

    /////// Update user /////////
    public function update_user($user)
    {
        $row_id = $user->row_id;
        $user_name = $user->user_name;
        $email = $user ->email;
        $phone = $user->phone;
        $designation = $user->designation;
        $department = $user->dept;
        $permitted_tool_id = $user->permitted_tool_id;
        $account_status = $user->account_status;


        $query = "UPDATE  login_plugin_db.login_table SET user_name='$user_name', email='$email',
        phone='$phone', designation='$designation', dept='$department', permitted_tool_id='$permitted_tool_id',
        account_status='$account_status'  WHERE row_id=$row_id";
        //dd($query);
        $data = \DB::update(\DB::raw($query));

        return $data;
    }

    //////// Fetch user on search //////////
    public function search_result($query)
    {
        $data = \DB::table('login_table')
        ->where('user_id', 'like', '%' . $query . '%')
        ->orWhere('user_name', 'like', '%' . $query . '%')
        ->orWhere('email', 'like', '%' . $query . '%')
        ->orWhere('designation', 'like', '%' . $query . '%')
        ->orWhere('dept', 'like', '%' . $query . '%')
        ->orWhere('account_status', 'like', '%' . $query . '%')
        ->orderBy('row_id', 'desc')
        ->get();

        return $data;
    }

    ////// Change user password //////
    public function process_change_password($user)
    {
        $password = $user->password;
        $password_hash =  password_hash($password, PASSWORD_DEFAULT);
        $row_id = $user->row_id;
        $query = "UPDATE  login_plugin_db.login_table SET user_password='$password_hash' WHERE row_id=$row_id";
        //dd($query);
        \DB::update(\DB::raw($query));
    }

    ////// Test password /////////
    public function get_hashed_password($test_login_info)
    {
        $user_id = $test_login_info->user_id;
        //dd($user_id);
        //$password = $test_login_info->password;

        $query = 'SELECT * FROM login_plugin_db.login_table WHERE user_id = ' . "'$user_id'";
        $data = \DB::select(\DB::raw($query));

        //dd($data[0]->user_password);

        $hashed_password_from_DB = $data[0]->user_password;

        if(count($data)>0)
        {
            return $hashed_password_from_DB;
        }
        else{
            return NULL;
        }
    }
}
