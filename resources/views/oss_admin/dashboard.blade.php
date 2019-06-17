@include("partials.header")

{{-- Login plugin DB --}}
<a class="btn btn-success dashboard_item" href="{{URL::to('view_all')}}"><p class="dashboard_item_text"">Login Plugin DB</p></a>

{{-- Register new user --}}

<a class="btn btn-warning dashboard_item" href="{{URL::to('user_register')}}"><p class="dashboard_item_text"">Register New User</p></a>