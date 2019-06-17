<!-- app/views/oss_admin/login.blade.php -->

@include('partials.header')

@if (session('status'))
    <div class="alert alert-info text-center" id="test_login_status">
        {{ session('status') }}
    </div>
@endif

<form action="process_login" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" name="user_name"  class="form-control" placeholder="your name">    
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="*******" class="form-control">    
    </div>

    <div class="form-group">
        <input type="submit" value="Login" class="btn btn-success">   
    </div>
    
</form>

<script type="text/javascript">
    // Hide success message after 5 seconds
    setTimeout(function(){
        $('#test_login_status').fadeOut('slow')
    },4000);
</script>