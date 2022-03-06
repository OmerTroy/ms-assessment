<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
        @endif

        <div class="row">
            <div class="col-md-8">
                <p class="lead">Welcome to your Dashboard. You can view and add your tasks from here. </p>
            </div>
            <div class="col-md-4">
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <a data-toggle="modal" data-target="#tasksModal" class="btn btn-primary text-white btn-sm mx-1">View Tasks</a>
                    <a href="tasks/create" class="btn btn-success text-white btn-sm mx-1">Add One</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="tasksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 1200px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tasks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">



                        @forelse($tasks as $task)
                        <div class="card card-block p-2 m-1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3>ID: {{$task->id}}, Title: {{$task->title}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="float-right">
                                            <p>Added at: {{$task->created_at}}</p>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 offset-8">
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                            <a href="{{ route('tasks.edit', $task->id)}}" class="btn btn-warning text-white btn-sm mx-1">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger text-white btn-sm mx-1" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        @empty
                        <p class="lead text-center">No Tasks Found</p>
                        @endforelse


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

</x-app-layout>