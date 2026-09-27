@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

<div class="main">
    <div class="top-card mt-4">
        <div class=" d-flex justify-content-end mb-3">
            <form action="{{route('admin.search')}}" method="get">
                <div class="d-flex justify-content-end gap-1">
                    <input type="search" name="s" class="form-control" placeholder="search.....">
                    <input type="hidden" name="source" value="user">

                    <button type="submit" class="search btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>               
            </form>
        </div>

    </div>

    <!--  Category Modal -->
    <div class="modal fade"
        id="categoryModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="categoryLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content category-modal">

                <!-- Header -->
                <div class="modal-header">
                    <div class="modal-heading">
                        <div class="modal-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <h5 class="modal-title" id="categoryLabel">
                                Add Users
                            </h5>
                            <p>Add a new User</p>
                        </div>
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">

                    <form action="" method="POST">
                        @csrf

                       

                        
                        <div class="category-input-group">
                            <label for="quizTitle">
                               Quiz Title
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>

                                <input type="text"
                                    class="category-input {{($errors->first('quiz')?'is-invalid':'')}}"
                                    name="quiz"
                                    value="{{old('quiz')}}"
                                    id="quizTitle"
                                    placeholder="e.g. Computer Fundamental"
                                    >
                            </div>
                        </div>

                        <button type="submit" class="category-submit">
                            <i class="fa-solid fa-plus"></i>
                            Add User
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <!--category list-->
    <div class="category-list">
        <div class="category-header">
            <div>
                <h4>Users</h4>
                <p>Manage App Users </p>
            </div>

            <button class="add-category"   data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus"></i>
                Add User
            </button>
        </div>

        <div class="category-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $key=>$user)
                        <tr>
                            <td>
                                <span class="serial">{{$key+1}}</span>
                            </td>

                            <td>
                                <div class="category-name">
                                    <div class="category-icon">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </div>
                                    <div>
                                        <strong>{{$user->name}}</strong>

                                        <small>User</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="quiz-count">{{$user->email}}</span>
                            </td>

                            <td>
                                <span class="quiz-count ">{{$user->role}}</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="" class="action-btn view-btn" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{route('admin.delete',['type'=>'user','id'=>$user->id]) }}" class="action-btn delete-btn" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Data Not Found!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>  
            </div>
            
        </div>
        
    </div>

      @if ($errors->has('quiz'))
        <div class="position-fixed bottom-2 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Validation Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ $errors->first('quiz') }}
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>

    @endif

    <!--Success-->
     @if (session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>
    @endif
    <!--error-->
     @if (session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('liveToast');

                if (toast) {
                    toast.remove();
                }
            }, 3000);
        </script>
    @endif

   
</div>

@endsection