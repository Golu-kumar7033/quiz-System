@extends('components.layout.admin')
@section('content')

 <div class="card">

            <div class="card-header">

                <h3>User Activity Logs
                    <i class="fa-solid fa-signal"></i>
                </h3>
                <span class="text-info">
                    <i class="fa-solid fa-chart-line"></i>:
                    {{$activities->count()}}
                </span>

            </div>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr class="fs-2">
                            <th>User</th>
                            <th>Role</th>
                            <th>Activity</th>
                            <th>Date and Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $log)
                        <tr>
                            <td>{{$log->user->name}}</td>
                            <td>
                                <span class=" {{$log->user->role=='user'? 'quiz-count' :'admin'}}">{{$log->user->role}}</span>
                            </td>
                            <td>{{$log->activity_type}}</td>
                            <td>
                                <span>
                                    {{ $log->created_at->format('d M Y, h:i A') }}
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{route('admin.delete',['type'=>'log','id'=>$log->id]) }}" class="action-btn delete-btn" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="4">No Data</td>
                        @endforelse
                    </tbody>

                </table>

            </div>

        </div>


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

@endsection

