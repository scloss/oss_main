<!-- app/views/nerds/edit.blade.php -->

@include('partials.header')

<h1>You are editing: {{ $users_data[0]->user_name }}</h1>

@if (session('status'))
    <div class="alert alert-success text-center" id="edit_user_info">
        {{ session('status') }}
    </div>
@endif

<form action="edit_post" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="row_id" value="{{$users_data[0]->row_id}}">
        
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="text" name="user_id" value="{{$users_data[0]->user_id}}" class="form-control" readonly>    
        </div>

        <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" name="user_name" value="{{$users_data[0]->user_name}}" class="form-control">    
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" value="{{$users_data[0]->email}}" class="form-control">    
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" value="{{$users_data[0]->phone}}" class="form-control">    
        </div>

        
        <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" name="designation" value="{{$users_data[0]->designation}}" class="form-control">    
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" name="dept" value="{{$users_data[0]->dept}}" class="form-control">    
        </div>

        <div class="form-group">
            <label for="permitted_tool_id">Permitted Tool ID</label>
            <input type="text" name="permitted_tool_id" value="{{$users_data[0]->permitted_tool_id}}" class="form-control">    
        </div>
        
        <div class="form-group">
            <label for="account_status">Account Status</label>
            {{-- <input type="text" name="account_status" value="{{$users_data[0]->account_status}}" class="form-control">    --}}
            <select name="account_status" id="" class="form-control">
                <option value="active">Active</option>
                <option value="blocked">Blocked</option>
            </select> 
        </div>


        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success">   
        </div>

</form>



</div>

<script type="text/javascript">
    //Hide success message after 5 seconds
    setTimeout(function(){
        $('#edit_user_info').fadeOut('slow')
    },1000);
</script>

</body>
</html>