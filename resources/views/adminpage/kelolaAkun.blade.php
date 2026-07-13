@extends('adminpage.dashboard_layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                <div class="card mb-4">


                    <div class="card-body px-0 pt-0 pb-2">

                        <div class="row" style="margin:20px">
                            <div class="col">
                                <div class="ms-md-auto pe-md-3 d-flex align-items-right">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" style="width: 200px;"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fa fa-plus "></i>
                                        Tambah Akun</button>
                                </div>
                            </div>

                            <div class="col col-lg-2">
                                <form class="input-group" action="/kelolaAkun" method="get">
                                    @csrf
                                    <span class="input-group-text text-body search" style="z-index:0"><i
                                            class="fas fa-search" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="Type here..." name="search_me">
                                    <input type="submit" hidden />
                                </form>
                            </div>
                        </div>



                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Administrator</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="createAccount" action="/createAccountAdmin" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    name="name" placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Username</label>
                                                <input type="text" class="form-control" id="username"
                                                    name="username" placeholder="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Email address</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" placeholder="name@example.com" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Password" required>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn bg-gradient-primary" onclick="$('#createAccount').submit()">Tambah Akun</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Update -->
                        <div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Akun</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateAccount" action="/updateAccountAdmin" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" class="form-control" id="id" name="id">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Name</label>
                                                <input type="text" class="form-control" id="name_register"
                                                    name="name_register" placeholder="Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Username</label>
                                                <input type="text" class="form-control" id="username_register"
                                                    name="username_register" placeholder="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Email address</label>
                                                <input type="email" class="form-control" id="email_register"
                                                    name="email_register" placeholder="name@example.com" required>
                                            </div>
                                            <input type="hidden" class="form-control" id="role_register"
                                                name="role_register">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Password</label>
                                                <input type="password" class="form-control" id="password_register"
                                                    name="password_register"
                                                    placeholder="Left it blank if you won't change your password">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn bg-gradient-primary"
                                            onclick="$('#updateAccount').submit()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Username</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Role</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ URL::asset('storage/image/userimg/168723.png') }}"
                                                            class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $item->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $item->username }} </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm  {{ $item->role_id == 1 ? 'bg-gradient-success' : 'bg-gradient-warning' }}"> {{ $item->role_id == 1 ? 'Admin' : 'User' }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($item->created_at)) }}</span>
                                            </td>
                                            <form action="/delete_account" method="POST" id="delete_it">
                                                @csrf
                                                <input type="hidden" name="id_data" id="id_data" value="{{$item->id}}">
                                            </form>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-warning"
                                                    onclick="get_data({{ $item->id }})"
                                                    {{ $item->role_id != 1 ? 'enabled' : '' }}><i
                                                        class="fa-solid fa-file-pen"> </i> Update Akun</button>
                                                <button type="button" class="btn btn-danger"
                                                    {{ $item->role_id != 1 ? 'enabled' : '' }}
                                                    onclick="delete_account({{$item->id}})"><i
                                                        class="fa-solid fa-ban"></i> Delete Akun</button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example" style="margin-top: 20px">
                            <ul class="pagination justify-content-end">
                                <form action="/kelolaAkun" method="get" id="findpage">
                                @csrf
                                <input type="hidden" name="page" id="page">
                                </form>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:{{$pagin." ".$page_now}};" onclick="pagination({{ ($page_now == null ? 1 : $page_now) <= 1 ? $page_now : $page_now - 1 }})"> < </a>
                                </li>
                                @for ($i = 1; $i <= $pagin; $i++)
                                <li class="page-item"><a class="page-link {{$i == ($page_now == null ? 1 : $page_now) ? "active" : ""}}" href="javascript:;" onclick="pagination({{$i}})">{{$i}}</a></li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="javascript:{{$pagin." ".$page_now}};" onclick="pagination({{$pagin == $page_now ? $page_now : ($page_now == null ? $page_now+2 :  $page_now+1)}})"> > </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var id_data;
        function pagination(params) {
            $('#page').val(params);
            $('#findpage').submit();
        }
        $.ajaxSetup({
            headers: {
                'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function get_data(id) {
            id_data = id;
            $('#exampleModal_update').modal('show');
            $.ajax({
                type: 'GET',
                url: "/getData_auth/" + id,
                success: function(data) {

                    if ($.isEmptyObject(data.error)) {
                        $('#id').val(id_data);
                        $('#username_register').val(data.data.username);
                        $('#password_register').val('');
                        $('#email_register').val(data.data.email);
                        $('#name_register').val(data.data.name);
                        $('#role_register').val(data.data.role_id);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        }

        function delete_account(id) {
            $('#id_data').val(id);
            $('#delete_it').submit();
        }

    </script>
@endsection
