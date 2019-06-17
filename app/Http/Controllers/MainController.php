<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
session_start();

class MainController extends Controller
{
    //
    public function view_all()
    {
        if ($this->auth_check()) {
            $dal_controller = new DALController();
            $users_data = $dal_controller->get_all_users();
            return view('oss_admin.index', compact('users_data'));
            //return "success";
        } else {
            return redirect('error_page');
        }
    }

    public function edit_view(Request $request)
    {
        if ($this->auth_check()) {
            $user_id = $request->user_id;
            $dal_controller = new DALController();
            $users_data = $dal_controller->get_user_info($user_id);
            return view('oss_admin.edit', compact('users_data'));
        } else {
            return redirect('error_page');
        }
    }

    public function edit_post(Request $request)
    {
        $dal_controller = new DALController();
        $dal_controller->update_user($request);

        return redirect("edit_view?user_id=$request->row_id")->with('status','User data updated!'); //show the updated user 
    }

    public function login()
    {
        return view('oss_admin.login');
    }

    public function process_login(Request $request)
    {
        $user_name = $request->user_name;
        $password = $request->password;

        if ($user_name === "admin" && $password === "Scl_@dm1n_0ss") {
            $_SESSION["admin_app_user"] = "auth_success";
            return redirect("dashboard");
        } else {
            $_SESSION["admin_app_user"] = "auth_failed";
            return redirect("/")->with('status','Login Failed!');
        }

        //dd($user_name);
    }

    public function auth_check()
    {
        if(isset($_SESSION["admin_app_user"])){
            if ($_SESSION["admin_app_user"] == "auth_success") {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
        
    }

    public function error_page()
    {
        return view('oss_admin.error_page');
    }
    public function logout()
    {
        //$_SESSION = array();
        //session_destroy();
        $_SESSION["admin_app_user"] = "auth_failed";
        return redirect('/');
    }


    public function action(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $dal_controller = new DALController();
                $data = $dal_controller->search_result($query);
                    
            } else {
                //$data = $this->view_all();
                $data = \DB::table('login_table')
                        ->orderBy('row_id', 'desc')
                        ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= 
                            '<tr>
                            <td>' . $row->user_id . '</td>
                            <td>' . $row->user_name . '</td>
                            <td>' . $row->email . '</td>
                            <td>' . $row->phone . '</td>
                            <td>' . $row->designation . '</td>
                            <td>' . $row->dept . '</td>
                            <td>' . $row->account_status. '</td>
                            <td> 
                                <a class="btn btn-small btn-warning" style="margin-bottom:5px;width:140px;" href="edit_view?user_id='.$row->row_id.'">Edit this User</a> 
                                <a class="btn btn-small btn-info" style="width:140px;" href="change_password_view?user_id='.$row->row_id.'">Change password</a>
                            </td>
                            </tr>';
                }
            } else {
                $output = '
       <tr>
        <td align="center" colspan="10">No User Found!!</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
    public function change_password_view(Request $request)
    {
        if ($this->auth_check()) {
            $user_id = $request->user_id;
            $dal_controller = new DALController();
            $users_data = $dal_controller->get_user_info($user_id);
            return view('oss_admin.change_password', compact('users_data'));
        } else {
            return redirect('error_page');
        }
    }

    public function change_password(Request $request)
    {
        $dal_controller = new DALController();
        $dal_controller->process_change_password($request);
        //return $password_hash;

        return redirect("change_password_view?user_id=$request->row_id")->with('status','Password updated!');
    }


    public function test_login()
    {
        if($this->auth_check())
        {
            return view('oss_admin.test_login');
        }
        else{
            return redirect('error_page');
        }
        
    }

    public function process_test_login(Request $request)
    {
        
        $password = $request->password;
        //dd($password);

        $dal_controller = new DALController();
        $hashed_password_from_DB = $dal_controller->get_hashed_password($request);

        if(password_verify($password, $hashed_password_from_DB))
        {
            return redirect('test_login')->with('status_success','Password Matched!');
        }
        else{
            return redirect('test_login')->with('status_failed','Password did not Match!');
        }

        //dd($hashed_password_from_DB);
    }

    public function dashboard()
    {
        if($this->auth_check())
        {
            return view('oss_admin.dashboard');
        }
        else{
            return redirect('error_page');
        }
    }

    public function user_register()
    {
        return view('oss_admin.user_register');
    }
    public function process_register_user(Request $request)
    {
        $user_id = $request->user_id;
        $user_type = $request->user_type;

        

        
        if($user_type == "scl_user"){
            $email = trim($user_id," ")."@summitcommunications.net";
            $user_id = trim($user_id," ");
            ///////////////////////////////// Check if hr included him/her in HR DB ///////////////////////////////
            $hr_35_query = "SELECT * FROM hr_tool_db.employee_table where email ='$email'";
            $hr_35_lists = \DB::connection('hr35')->select(\DB::raw($hr_35_query));

            if(count($hr_35_lists)> 0){
                //////////////// Employee added by HR /////////////////////////////
                    ////////////// Execute Script /////////////////////
                    $result = file_get_contents("http://172.16.136.35/mom/public/upgradedb");

                    $login_plugin_query = "SELECT * FROM login_plugin_db.`login_table` WHERE user_id = '$user_id'  ";
                    $login_plugin_data = \DB::select(\DB::raw($login_plugin_query));;

                    $hr_50_query = "SELECT * FROM hr_tool_db.employee_table WHERE email = '$email'";
                    $hr_50__data = \DB::connection('hr50')->select(\DB::raw($hr_50_query));

                    $phoenix_access_query = "SELECT * FROM phoenix_tt_db.access_table WHERE user_id = '$user_id'";
                    $phoenix_access_data = \DB::connection('phoenix50')->select(\DB::raw($phoenix_access_query));
                    return view('oss_admin.user_details',compact('login_plugin_data','hr_50__data','phoenix_access_data','user_id','email'));
            }
            else{
                //////////////// Employee not added by HR /////////////////////////////
                return "Employee not found in HRDashboard";
            }


            //return $hr_35_lists;

        }else if($user_type == "ezone_user"){
            $email = trim($user_id," ")."@summitcommunications.net";
            $user_id = trim($user_id," ");
            ///////////////////////////////// Check if hr included him/her in HR DB ///////////////////////////////
            $hr_ezone_query = "SELECT * FROM hr_tool_ezone.employee_table where email ='$email'";
            $hr_ezone_lists = \DB::connection('hr35')->select(\DB::raw($hr_ezone_query));

            if(count($hr_ezone_lists)> 0){
                //////////////// Employee added by HR /////////////////////////////
                        ////////////// Execute Script /////////////////////
                        $result = file_get_contents("http://172.16.136.35/mom/public/upgradedbezone");

                        $login_plugin_query = "SELECT * FROM login_plugin_db.`login_table` WHERE user_id = '$user_id'  ";
                        $login_plugin_data = \DB::select(\DB::raw($login_plugin_query));;

                        $hr_50_query = "SELECT * FROM hr_tool_db.employee_table WHERE email = '$email'";
                        $hr_50__data = \DB::connection('hr50')->select(\DB::raw($hr_50_query));

                        $phoenix_access_query = "SELECT * FROM phoenix_tt_db.access_table WHERE user_id = '$user_id'";
                        $phoenix_access_data = \DB::connection('phoenix50')->select(\DB::raw($phoenix_access_query));
                        return view('oss_admin.user_details',compact('login_plugin_data','hr_50__data','phoenix_access_data','user_id','email'));
            }
            else{
                //////////////// Employee not added by HR /////////////////////////////
                return "Employee not found in HRDashboard Ezone";
            }

            //return $hr_ezone_lists;

        }else{

        }

        echo $user_id."    ".$user_type;

        return "";
    }

    public function process_email_body_generator(Request $request)
    {
        //dd($request);
        $user_id = $request->user_id;
        $email = $request->email;
        //var_dump(($request->radius_juniper_user_id)==NULL);
        //dd($request->radius_juniper_user_id);


        $radius_juniper_user_id = $request->radius_juniper_user_id;
        $radius_juniper_password = $request->radius_juniper_user_password;
        $radius_huawei_user_id = $request->radius_huawei_user_id;
        $radius_huawei_password = $request->radius_huawei_user_password;

        if($radius_huawei_user_id!="" || $radius_juniper_user_id!="")
        {
            $show_radius_label = true;
        }
        else{
            $show_radius_label = false;
        }

        $email_body = "
        Dear Concern,
        <br/><br/>
        Your credentials for dashboard";
        if($show_radius_label)
        {
            $email_body.=", Radius ";
        }
        $email_body.= "is given below. You can access all our inhouse develop tools(Phoenix/Looking glass....etc) with this credential. Please reset your password first by logging into (172.16.136.35). 
        <br/><br/>
        <b>Dashboard Credential:</b> 
        <br/>
        <b>User ID:</b> $user_id 
        <br/>
        <b>Password:</b> scl123 
        <br/></br>";

        if($show_radius_label)
        {
            $email_body.=" <b>Radius(Juniper):</b> 
            <br/>
            <b>User ID: </b> $radius_juniper_user_id
            <br/>
            <b>Password: </b> $radius_juniper_password
            <br/></br>
            <b>Radius(Huawei):</b>
            <br/>
            <b>User ID: </b> $radius_huawei_user_id
            <br/>
            <b>Password: </b>$radius_huawei_password
            ";
        }
        //return $email_body;
        //var_dump(compact('email_body'));
        return $email_body;
        //return view('oss_admin.email_body_view',compact('email_body'));
        //return $email_body;
        //dd($email_body);
    }

}
