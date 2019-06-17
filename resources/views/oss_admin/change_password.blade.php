@include('partials.header')

@if (session('status'))
    <div class="alert alert-success text-center" id="password_change">
        {{ session('status') }}
    </div>
@endif

<form action="change_password" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="row_id" value="{{$users_data[0]->row_id}}">
        
    <div class="form-group">
        <label for="user_id">User ID</label>
        <input type="text" name="user_id" value="{{$users_data[0]->user_id}}" class="form-control" readonly>    
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="******" class="form-control" >    
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="******" class="form-control" >    
    </div>

    <div class="form-group">
        <input type="submit" value="Submit" onclick="return validate();" class="btn btn-success">   
    </div>

</form>

<script type="text/javascript">

    function validate()
    {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        if(password === confirm_password)
        {
            return true;
        }
        else{
            alert("Password didn't match");
            return false;
        }
    }

    // Hide success message after 5 seconds
    setTimeout(function(){
        $('#password_change').fadeOut('slow')
    },1000);
</script>