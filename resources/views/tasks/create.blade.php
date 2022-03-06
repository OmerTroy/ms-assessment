<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Tasks') }}
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
                <form method="post" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" class="form-control" name="title" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" class="form-control" name="description" rows="3"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="deadline">Deadline:</label>
                        <input type="datetime-local" id="deadline" class="form-control" name="deadline" />
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" class="form-control" name="type">
                            <option value="localized">Restricted to Country</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                    
                    <div class="float-right">
                        <a href="/dashboard" class="btn btn-success">Go Back</a>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    

</x-app-layout>