<!-- app/views/oss_admin/test_login.blade.php -->

@include('partials.header')

@if (session('status_success'))
    <div class="alert alert-success text-center" id="login_status">
        {{ session('status_success') }}
    </div>
@endif

@if (session('status_failed'))
    <div class="alert alert-danger text-center" id="login_status">
        {{ session('status_failed') }}
    </div>
@endif

<form action="process_test_login" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="text" name="user_id"  class="form-control" placeholder="user id(ex: faisal.aziz)">    
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="*******" class="form-control">    
    </div>

    <div class="form-group">
        <input type="submit" value="Submit" class="btn btn-success">   
    </div>
    
</form>

<script type="text/javascript">
    // Hide success message after 5 seconds
    setTimeout(function(){
        $('#login_status').fadeOut('slow')
    },4000);
</script>