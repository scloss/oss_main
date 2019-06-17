<!-- app/views/nerds/index.blade.php -->



@include('partials.header')

<div class="container box" style="width: 1300px;">
        {{-- <h3 align="center">Live search in laravel using AJAX</h3><br /> --}}
        <div class="panel panel-default">
         <div class="panel-heading text-center">All user</div>
         <div class="panel-body">
          <div class="form-group">
           <input type="text" name="search" id="search" class="form-control" placeholder="Search employee" />
          </div>
          <div class="table-responsive">
           <h3 class="text-center">Total User : <span id="total_records"></span></h3>
           <table class="table table-striped table-bordered">
            <thead>
             <tr>
              <th>User ID</th>
              <th>User name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Designation</th>
              <th>Department</th>
              <th>Status</th>
              <th>Actions</th>

             </tr>
            </thead>
            <tbody>
     
            </tbody>
           </table>
          </div>
        </div>    
    </div>
</div>

</div>


</body>
</html>

<script>
    $(document).ready(function(){
    
     fetch_customer_data();
    
     function fetch_customer_data(query = '')
     {
      $.ajax({
       url:"{{ route('live_search.action') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data)
       {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
       }
      })
     }
    
     $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      fetch_customer_data(query);
     });
    });
</script>
