@extends('admin.layouts.master')
@section('content')
  <div class="wrapper">
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Admin List</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Session::get('sp_admin')->name}}
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ url('dashboard/logout') }}">Logout</a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Admin List <a href="{{url('dashboard/admin/add')}}" style="float:right;font-size: 15px;font-size: 12px; color:white;" type="button" class="btn btn-md btn-primary">Add Admin</a></h4>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  @if(session()->has('message'))
                    <div class="row">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>Message:</strong>{{session()->get('message')}}
                      </div>
                    </div>
                  @endif
                  <table class="table">
                    <thead class=" text-primary">
                      <!-- <th>Admin Id</th> -->
                      <th>Name</th>
                      <th>Email</th>
                      <th class="text-right">Action</th>
                    </thead>
                    <tbody>
                    @foreach($all_admin as $admin)
                      <tr>
                        <!-- <td> {{$admin->id}}</td> -->
                        <td> {{$admin->name}}</td>
                        <td> {{$admin->email}}</td>
                        <td class="text-right">
                          <a href="{{url('/dashboard/admin/edit/'.$admin->id)}}" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-edit text-primary"></i></a>
                          <!-- <i class="fa fa-eye text-success"></i> -->
                          <a href="javascript:0;" onclick="deleteEmployer('{{ $admin->id }}')"> <i class="fa fa-trash text-danger"></i> </a>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  {{$all_admin->render()}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-warning" role="dialog" class="modal fade in" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
          <div class="modal-content bg-warning animated bounceIn">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="text-center">
                      <span class="icon icon-exclamation-triangle icon-5x"></span>
                      <h3>Are you sure?</h3>
                      <p>You will not be able to undo this action.</p>
                      <div class="m-t-lg">
                          <form method="post" action="{{ url('dashboard/admin/delete') }}">
                              <input type="hidden" name="_method" value="delete">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="admin_id" class="actionId">
                              <button class="btn btn-danger" type="submit">Continue</button>
                              <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                          </form>
                      </div>
                  </div>
              </div>
              <div class="modal-footer"></div>
          </div>
      </div>
  </div>
@endsection

@section('script')
<script>
function deleteEmployer(userId){
    $('.actionId').val(userId);
    $('#modal-warning').modal();
}
function doAction(){
    var userId = $('.actionId').val();
    if(userId != ''){
        alert('delete this '+userId);
    }
}

</script>
@endsection
