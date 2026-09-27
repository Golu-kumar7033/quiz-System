@extends('components.layout.admin')
@section('title','Welcome In Quizer')
@section('content')


<div class="main">
    <!--<div class="top-card mt-4">
        <div class=" d-flex justify-content-end mb-3">
            <form action="" method="get">
                <div class="d-flex justify-content-end gap-1">
                    <input type="hidden" name="source" value="question">

                    <input type="search" name="s" class="form-control" placeholder="search quiz Category..">
                    <button type="submit" class="search btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>               
            </form>
        </div>

    </div>
-->

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
                                Create Quiz Questions
                            </h5>
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

                    <form action="{{route('admin.create-question')}}" method="POST">
                        @csrf

                       <div class="row">
                            <div class="col-lg-6">
                                <div class="category-input-group">
                                    <label for="Quiz">Category Quiz</label>

                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-tag"></i>

                                        <select class="mb-3 quiz-select" name="quiz" id="Quiz">
                                            <option value="" disabled selected hidden>Select Quiz</option>

                                            @foreach($categories as $quiz)
                                                <option value="{{ $quiz->id }}">
                                                    {{ $quiz->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="category-input-group">
                                    <label for="topic">Quiz Topic</label>

                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-tag"></i>

                                        <select class="mb-3 quiz-select" name="topic" id="topic">
                                            <option value="" disabled selected hidden>Select Topic</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--sript for quiz wise topic-->
                        <script>
                            const quizTopics = @json(
                                $categories->mapWithKeys(function ($quiz) {
                                    return [
                                        $quiz->id => $quiz->topics->map(function ($topic) {
                                            return [
                                                'id' => $topic->id,
                                                'name' => $topic->Topic
                                            ];
                                        })->values()
                                    ];
                                })
                            );

                            document.getElementById('Quiz').addEventListener('change', function () {
                                const quizId = this.value;
                                const topicSelect = document.getElementById('topic');

                                // Clear existing topics
                                topicSelect.innerHTML = '<option value="">Select Topic</option>';

                                if (!quizId || !quizTopics[quizId]) {
                                    return;
                                }

                                quizTopics[quizId].forEach(function (topic) {
                                    const option = document.createElement('option');

                                    option.value = topic.id;
                                    option.textContent = topic.name;

                                    topicSelect.appendChild(option);
                                });
                            });
                        </script>



                       
                        
                        <!--question type-->
                             
                            <div class="category-input-group">
                            <label for="question">
                               Question
                            </label>

                            <div class="input-wrapper">
                                <i class="fa-solid fa-tag"></i>
                                <textarea name="question" class="textarea  {{($errors->first('question')?'is-invalid':'')}}" value="{{old('question')}}" id="question" rows="3" placeholder="e.g. what is computer "></textarea>

                            </div>
                        </div>

                        <div class="category-input-group">
                                <label for="type">
                                     Question Type
                                </label>

                                <div class="input-wrapper">
                                    <i class="fa-solid fa-tag"></i>
                                    <select class="mb-3 quiz-select" name="qtype" id="qtype" >
                                        <option value="" disabled selected hidden>Select Type</option>
                                        <option value="mcq">MCQ</option>
                                        <option value="tf">TRUE/FALSE</option>
                                        <option value="fill">Fill In The Blanks</option>
                                    </select>
                                </div>
                            </div>
                            <div  id="mcq" style="display:none;">
                                <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="option-group">
                                        <label for="option1" class="option-label">
                                            Option A
                                        </label>

                                        <div class="input-wrapper">
                                            <div class="option-input">
                                                <input 
                                                    type="radio" 
                                                    class="form-check-input" 
                                                    name="is_correct" 
                                                    value="A"
                                                    id="option1"
                                                >

                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="option_a" 
                                                    placeholder="Enter Option A"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="option-group">
                                        <label for="option2" class="option-label">
                                            Option B
                                        </label>

                                        <div class="input-wrapper">
                                            <div class="option-input">
                                                <input 
                                                    type="radio" 
                                                    class="form-check-input" 
                                                    name="is_correct" 
                                                    value="B"
                                                    id="option2"
                                                >

                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="option_b" 
                                                    placeholder="Enter Option B"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="option-group">
                                        <label for="option3" class="option-label">
                                            Option C
                                        </label>

                                        <div class="input-wrapper">
                                            <div class="option-input">
                                                <input 
                                                    type="radio" 
                                                    class="form-check-input" 
                                                    name="is_correct" 
                                                    value="C"
                                                    id="option3"
                                                >

                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="option_c" 
                                                    placeholder="Enter Option C"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="option-group">
                                        <label for="option4" class="option-label">
                                            Option D
                                        </label>

                                        <div class="input-wrapper">
                                            <div class="option-input">
                                                <input 
                                                    type="radio" 
                                                    class="form-check-input" 
                                                    name="is_correct" 
                                                    value="D"
                                                    id="option4"
                                                >

                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    name="option_d" 
                                                    placeholder="Enter Option D"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                          
                            <div class=""id="tf" style="display:none;">
                                <div class="row " >
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="option-group">
                                            <label for="option1" class="option-label">
                                                Option A
                                            </label>

                                            <div class="input-wrapper">
                                                <div class="option-input">
                                                    <input 
                                                        type="radio" 
                                                        class="form-check-input" 
                                                        name="is_correct" 
                                                        value="true"
                                                        id="option1"
                                                    >

                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="option_A"
                                                        value="True" 
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="option-group">
                                            <label for="option2" class="option-label">
                                                Option B
                                            </label>

                                            <div class="input-wrapper">
                                                <div class="option-input">
                                                    <input 
                                                        type="radio" 
                                                        class="form-check-input" 
                                                        name="is_correct" 
                                                        value="flase"
                                                        id="option2"
                                                    >

                                                    <input 
                                                        type="text" 
                                                        class="form-control" 
                                                        name="option_B" 
                                                        value="False"
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                
                                </div>
                            </div>
                          

                            <div class="" id="fill" style="display:none">
                                <h6>current not Ableble</h6>
                            </div>


                           <div class="row" id="whyId" style="display:non">
                             <div class="category-input-group">
                                <label for="whyIs">
                                Why Is Correct
                                </label>

                                <div class="input-wrapper">
                                    <i class="fa-solid fa-tag"></i>

                                    <input type="text"
                                        class="category-input"
                                        name="whyis"
                                        id="whyIs"
                                        >
                            </div>
                           </div>
                        </div>

                        <button type="submit" class="category-submit">
                            <i class="fa-solid fa-plus"></i>
                            Add Question
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
                <h4>Quiz Questions</h4>
                <p>Manage your quiz Questions</p>
            </div>

            <button class="add-category"   data-bs-toggle="modal" data-bs-target="#categoryModal">
                <i class="fa-solid fa-plus"></i>
                Add Question
            </button>
        </div>
        <div class="category-card">
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Question</th>
                            <th>Question Type</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($question as $key=>$qes)
                        <tr>
                            <td>
                                <span class="serial">{{$key+1}}</span>
                            </td>

                            <td >
                                <div class="category-name">
                                    <div class="category-icon">
                                        <i class="fa-solid fa-q"></i>
                                    </div>
                                    <div>
                                        <strong>{{$qes->question}}</strong>

                                        <small>question </small>
                                    </div>
                                </div>
                            </td>

                            
                            <td>
                                <span>{{$qes->question_type}}</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="javascript:void(0);" class="action-btn view-btn"
                                        data-id="{{ $qes->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#questionModal"
                                        title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    <a href="{{route('admin.delete',['type'=>'question','id'=>$qes->id]) }}" class="action-btn delete-btn" title="Delete">
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
    </div>

        
    </div>
 <!--erorr massage-->
  

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
            }, 1000);
        </script>
    @endif

</div>


<!--===========================================================================================================-->

<!--question details model-->

 <div class="modal fade"
        id="questionModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="categoryLabel"
        aria-hidden="true">

        <div class="modal-dialog  modal-lg modal-dialog-centered">

            <div class="modal-content category-modal">

                <!-- Header -->
                <div class="modal-header">
                    <div class="modal-heading">
                        <div class="modal-icon">
                          <i class="fa-solid fa-q"></i>
                        </div>

                        <div>
                            <h5 class="modal-title" id="categoryLabel">
                                Quiz Question 
                            </h5>
                            <p>Manage  quiz question and Option</p>
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

                    <div id="questionLoader" class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2 mb-0">Loading...</p>
                    </div>

                    <div class="d-flex justify-content-between ">
                        <div id="questionDetails" style="display:none;">

                            <div class="mb-3">
                                <label class="fw-bold">Question</label>

                                <div class="question-box" id="viewQuestion"></div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Question Type</label>
                                <div>
                                    <span class="badge bg-primary" id="viewQuestionType"></span>
                                </div>
                            </div>

                            <div>
                                <label class="fw-bold mb-2">Options</label>
                                <div class="row" id="viewOptions">
                                    <!--option data -->

                                </div>

                            </div>

                        </div>

                        <div class="Editicon"> 
                            <h5 class="Editbtn"  data-bs-toggle="modal"
                                data-bs-target="#questionModalEdit"
                                title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </h5>
                        </div>
                    
                    </div>
                </div>


            </div>
        </div>
    </div>

<!---===================================================--->
<!--question edit model-->

    <div class="modal fade"
        id="questionModalEdit"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="categoryLabel"
        aria-hidden="true">

        <div class="modal-dialog  modal-lg modal-dialog-centered">

            <div class="modal-content category-modal">

                <!-- Header -->
                <div class="modal-header">
                    <div class="modal-heading">
                        <div class="modal-icon">
                            <i class="fa-solid fa-q"></i>
                        </div>

                        <div>
                            <h5 class="modal-title" id="categoryLabel">
                                Quiz Question 
                            </h5>
                            <p>Manage  quiz question and Option</p>
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

                    <div id="questionLoader1" class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2 mb-0">Loading...</p>
                    </div>

                    <div id="questionEdit" style="display:none;">

                        <form action="{{route('admin.edit-question')}} " method="post">
                            @csrf

                        <div class="mb-3">

                            <div class="option-group">
                                <label for="option1" class="option-label">
                                    Question
                                </label>

                                <div class="input-wrapper">
                                    <div class="option-input">
                                        <input 
                                            type="hidden" 
                                            name="question_id" 
                                            id="editQuestionId"
                                        >
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            name="question"
                                            id="editQuestion"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Question Type</label>
                            <div>
                                <span class="badge bg-primary" id="editQuestionType"></span>
                                <input 
                                            type="hidden" 
                                            class="form-control" 
                                            name="question_type"
                                            id="type"
                                        >
                                
                            </div>
                        </div>

                        <div>
                            <label class="fw-bold mb-2">Options</label>
                            <div class="row" id="editOptions">
                                <!--option data -->

                            </div>

                        </div>
                        <div class=" w-100">
                            <button type="submit" class="btn btn-primary  p-2 ">Submit</button>
                        </div>
                        </form>
                    </div>

                       
                    </div>
                </div>


            </div>
        </div>
    </div>






<!--=====================================================================================-->
<!-- Question detals vc -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).on('click', '.view-btn', function () {

    let questionId = $(this).attr('data-id');

    $('#questionLoader').show();
    $('#questionLoader1').show();

    $('#questionDetails').hide();
    $('#questionEdit').hide();

    $('#viewQuestion').html('');
    $('#viewQuestionType').text('');
    $('#viewOptions').html('');

    $('#editQuestion').val('');
    $('#editQuestionType').text('');
    $('#editOptions').html('');

    $.ajax({
        url: "{{ route('admin.question') }}",
        type: "GET",
        data: {
            id: questionId
        },

        success: function (response) {

            $('#questionLoader').hide();
            $('#questionLoader1').hide();

            $('#questionDetails').show();
            $('#questionEdit').show();

            // View question
            $('#viewQuestion').html(response.question);
            $('#viewQuestionType').text(response.question_type);
            $('#type').val(response.question_type);


            // Edit question
            $('#editQuestion').val(response.question);
            let id = $('#editQuestionId').val(response.question_id);
            $('#editQuestionType').text(response.question_type);

            let optionsHtml = '';
            let editOptionsHtml = '';

            if (response.options && response.options.length > 0) {

                $.each(response.options, function (index, option) {

                    let letter = String.fromCharCode(65 + index);

                    let correctClass = option.is_correct == 1
                        ? 'correctClass'
                        : '';

                    let correctBadge = option.is_correct == 1
                        ? '<span class="badge bg-success ms-2">Correct Answer</span>'
                        : '';

                    // View options
                    optionsHtml += `
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="option-item ${correctClass}">
                                <span class="option-number">
                                    ${letter}
                                </span>

                                <b>.</b>

                                <span class="option-text">
                                    ${option.option}
                                </span>

                                ${correctBadge}
                            </div>
                        </div>
                    `;

                    // Edit options
                    editOptionsHtml += `
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="option-group">

                                <label
                                    for="option_${letter}"
                                    class="option-label"
                                >
                                    Option ${letter}
                                </label>

                                <div class="input-wrapper">
                                    <div class="option-input">

                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            name="is_correct"
                                            value="${option.option}"
                                            id="option_${letter}"
                                            ${option.is_correct == 1 ? 'checked' : ''}
                                        >

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="option_${letter}"
                                            value="${option.option}"
                                        >

                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
                });

            } else {

                optionsHtml = `
                    <div class="text-center text-danger">
                        <h6>No options found.</h6>
                    </div>
                `;

                editOptionsHtml = `
                    <div class="text-center text-danger">
                        <h6>No options found.</h6>
                    </div>
                `;
            }

            // Set generated HTML
            $('#viewOptions').html(optionsHtml);
            $('#editOptions').html(editOptionsHtml);
        },

        error: function () {

            $('#questionLoader').hide();
            $('#questionLoader1').hide();

            $('#questionDetails').html(`
                <div class="text-center text-danger">
                    <h6>Unable to load question details.</h6>
                </div>
            `).show();

            $('#questionEdit').hide();
        }
    });

});
</script>






@endsection
