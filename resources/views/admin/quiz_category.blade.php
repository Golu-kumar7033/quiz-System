@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

<div class="main">
    <div class="top-card mt-4">
        <div class=" d-flex justify-content-end mb-3">
            <form action="">
                <div class="d-flex justify-content-end gap-1">
                    <input type="search" class="form-control" placeholder="search quiz Category..">
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
                            <i class="fa-solid fa-folder-plus"></i>
                        </div>

                        <div>
                            <h5 class="modal-title" id="categoryLabel">
                                Create Quiz Category
                            </h5>
                            <p>Add a new category to your quiz</p>
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

                    <form action="{{route('admin.create-category')}}" method="POST">
                        @csrf

                        <div class="category-input-group">
                            <label for="categoryTitle">
                                Category Title
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>

                                <input type="text"
                                    class="category-input {{($errors->first('category')?'is-invalid':'')}}"
                                    name="category"
                                    value="{{old('category')}}"
                                    id="categoryTitle"
                                    placeholder="e.g. Computer Science"
                                    >
                            </div>
                        </div>

                        <button type="submit" class="category-submit">
                            <i class="fa-solid fa-plus"></i>
                            Add Category
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
                <h4>Quiz Categories</h4>
                <p>Manage your quiz categories</p>
            </div>

            <button class="add-category"   data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus"></i>
                Add Category
            </button>
        </div>

        <div class="category-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>No. of Quizzes</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $key=>$category)
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
                                        <strong>{{$category->Title}}</strong>

                                        <small>Quiz Category</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="quiz-count">0 Quizzes</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="{{route('admin.category-quiz',['type'=>$category->slug])}}" class="action-btn view-btn" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{route('admin.delete',['type'=>'category','id'=>$category->id]) }}" class="action-btn delete-btn" title="Delete">
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
        <div class="d-flex justify-content-center mt-4">
            {{$data->links()}}
        </div>
    </div>

    <!--erorr massage-->
    @if ($errors->has('category'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Validation Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ $errors->first('category') }}
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