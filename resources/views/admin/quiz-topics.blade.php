@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')

<div class="main">
   <!-- <div class="top-card mt-4">
        <div class=" d-flex justify-content-end mb-3">
            <form action="{{route('admin.search')}}" method="get">
                <div class="d-flex justify-content-end gap-1">
                    <input type="hidden" name="source" value="topic">

                    <input type="search" name="s" class="form-control" placeholder="search topic..">
                    <button type="submit" class="search btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>               
            </form>
        </div>

    </div>-->

    <!--  Topic Modal -->
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
                                Create  Topic Quiz
                            </h5>
                            <p>Add a new Topic quiz </p>
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

                    <form action="{{route('admin.create-topic')}}" method="POST">
                        @csrf

                        <div class="category-input-group">
                            <label for="Quizcategory">
                                Select Quiz Topic 
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>
                                <select class="mb-3 quiz-select" name="quiz" id="Quizcategory" >
                                   <option value="{{$quiz->id}}">{{$quiz->title}}</option>

                                </select>
                            </div>
                        </div>

                        
                        <div class="category-input-group">
                            <label for="quizTitle">
                               Quiz Title
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>

                                <input type="text"
                                    class="category-input {{($errors->first('topic')?'is-invalid':'')}}"
                                    name="topic"
                                    value="{{old('topic')}}"
                                    id="TopicTitle"
                                    placeholder="e.g. Computer Hardware"
                                    >
                            </div>
                        </div>

                        <button type="submit" class="category-submit">
                            <i class="fa-solid fa-plus"></i>
                            Add Topic
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
                <h4> Quiz Topic </h4>
                <p>Manage your Topic categories</p>
            </div>

            <button class="add-category"   data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus"></i>
                Add Topic
            </button>
        </div>

        <div class="category-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Topic</th>
                            <th>No. of Questions</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($topic as $key=>$t)
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
                                        <strong>{{$t->Topic}}</strong>

                                        <small>Quiz Topic</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="quiz-count">0 Topics</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="{{route('admin.question-bank',['type'=>$t->slug])}}" class="action-btn view-btn" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{route('admin.delete',['type'=>'topic','id'=>$t->id]) }}" class="action-btn delete-btn" title="Delete">
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
    
      @if ($errors->has('topic'))
        <div class="position-fixed top-1 end-0 p-3" style="z-index: 9999">
            <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Validation Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <div class="toast-body">
                    {{ $errors->first('topic') }}
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