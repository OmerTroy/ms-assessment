<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Tasks') }}
        </h2>

    </x-slot>

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <div class="card uper">

            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <form method="post" action="{{ route('tasks.update', $task->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ $task->title }}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" class="form-control" name="description" rows="3"> {{ $task->description }} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" id="deadline" class="form-control" name="deadline" value="{{ $task->deadline }}"/>
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" class="form-control" name="type">
                            <option value="localized" @if ($task->type == 'localized') selected="selected" @endif>Restricted to Country</option>
                            <option value="public" @if ($task->type == 'public') selected="selected" @endif>Public</option>
                        </select>
                    </div>
                    
                    <div class="float-right">
                        <a href="/dashboard" class="btn btn-success">Go Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    

</x-app-layout>