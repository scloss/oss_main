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

<form action="process_register_user" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="text" name="user_id"  class="form-control" placeholder="your user_id" required>    
    </div>

    <div class="form-group">
        <label for="user_id">User Type</label>
        <select name="user_type" id="" class="form-control" required>
            <option value="">User Type</option>
            <option value="scl_user">SCL User</option>
            <option value="ezone_user">Ezone User</option>
        </select>
    </div>
    
    <div class="form-group">
        <input type="submit" value="Submit" class="btn btn-success">   
    </div>
    
</form>

{{-- <script type="text/javascript">
    // Hide success message after 5 seconds
    setTimeout(function(){
        $('#login_status').fadeOut('slow')
    },4000);
</script> --}}