<!-- app/views/oss_admin/user_register.blade.php -->

@include('partials.header')

{{-- @if (session('status_success'))
    <div class="alert alert-success text-center" id="login_status">
        {{ session('status_success') }}
    </div>
@endif

@if (session('status_failed'))
    <div class="alert alert-danger text-center" id="login_status">
        {{ session('status_failed') }}
    </div>
@endif --}}


{{-- Info from Login Plugin table --}}
<div class="table-responsive">
    <h3 class="text-center">Login plugin</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <td>USER ID</td>
                <td>USER NAME</td>
                <td>EMAIL</td>
                <td>DEPT</td>
                <td>STATUS</td>
            </thead>
            <tbody>
                @if(count($login_plugin_data)>0)
                    <td>{{$login_plugin_data[0]->user_id}}</td>
                    <td>{{$login_plugin_data[0]->user_name}}</td>
                    <td>{{$login_plugin_data[0]->email}}</td>
                    <td>{{$login_plugin_data[0]->dept}}</td>
                    <td>{{$login_plugin_data[0]->account_status}}</td>
                @else
                @endif
            </tbody>
        </table>
</div>

<br/>

{{-- Info from 50 HR Tool table --}}
<div class="table-responsive">
    <h3 class="text-center">50 HR Tool</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <td>Name</td>
                <td>Designation</td>
                <td>Department</td>
                <td>Email</td>
                <td>Status</td>
            </thead>
            <tbody>
                @if(count($hr_50__data)>0)
                    <td>{{$hr_50__data[0]->name}}</td>
                    <td>{{$hr_50__data[0]->designation}}</td>
                    <td>{{$hr_50__data[0]->department}}</td>
                    <td>{{$hr_50__data[0]->email}}</td>
                    <td>{{$hr_50__data[0]->status}}</td>
                @else
                @endif
            </tbody>
        </table>
</div>
<br/>

{{-- Info from Phoenix Access table --}}
<div class="table-responsive">
    <h3 class="text-center">Phoenix Access Table</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <td>User ID</td>
                <td>Dept ID</td>
                <td>Type</td>
                <td>Page Access</td>
                <td>Created AT</td>
            </thead>
            <tbody>
                @if(count($phoenix_access_data)>0)
                    <td>{{$phoenix_access_data[0]->user_id}}</td>
                    <td>{{$phoenix_access_data[0]->dept_id}}</td>
                    <td>{{$phoenix_access_data[0]->type}}</td>
                    <td>{{$phoenix_access_data[0]->page_access}}</td>
                    <td>{{$phoenix_access_data[0]->created_at}}</td>
                @else
                @endif
            </tbody>
        </table>
</div>

<form action="process_email_body_generator" method="POST">
    {{ csrf_field() }}

    <p class="text-center" style=" font-size:25px;">Email Body Generator Form</p>

    <div class="form-group">
        <label for="user_id" >User ID</label>
        <input type="text" class="form-control" name="user_id" value="{{$user_id}}" readonly>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="{{$email}}" readonly>
    </div>
        
    <div class="form-group">
        <label for="radius_juniper_user_id">Radius Juniper User ID</label>
        <input type="text" name="radius_juniper_user_id" placeholder="radius juniper user id" class="form-control">    
    </div>

    <div class="form-group">
        <label for="radius_juniper_password">Radius Juniper Password</label>
        <input type="text" name="radius_juniper_user_password" placeholder="******" class="form-control">    
    </div>

    <div class="form-group">
        <label for="radius_huawei_user_id">Radius Huawei User ID</label>
        <input type="text" name="radius_huawei_user_id" placeholder="radius huawei user id" class="form-control">    
    </div>

    <div class="form-group">
        <label for="radius_huawei_password">Radius Huawei Password</label>
        <input type="text" name="radius_huawei_user_password" placeholder="******" class="form-control">    
    </div>

    <div class="form-group">
        <input type="submit" value="Submit" onclick="return validate();" class="btn btn-success">   
    </div>

</form>



{{-- <script type="text/javascript">
    // Hide success message after 5 seconds
    setTimeout(function(){
        $('#login_status').fadeOut('slow')
    },4000);
</script> --}}