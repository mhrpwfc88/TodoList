<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="icon" type="image/x-icon" href="logo.PNG">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Mh_ProCode</div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center mb-4">List Target</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session('berhasil'))
                            <div class="alert alert-success">
                                {{ session('berhasil') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- 02. Form input data -->
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" value="{{ old('task') }}">
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    value="{{ request('search') }}" placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>
                        <ul class="list-group mb-4" id="todo-list">

                            @foreach ($data as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        @if ($item->is_done == '0')
                                            {{ $item->task }}
                                        @else
                                            <del>{{ $item->task }}</del>
                                        @endif
                                    </span>
                                    <input type="text" class="form-control edit-input" style="display: none;"
                                        value="{{ $item->task }}">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete', ['id' => $item->id]) }}" method="POST"
                                            onsubmit="return confirm('yakin Hapus Data?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn">delete</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}"
                                            aria-expanded="false">Edit</button>
                                    </div>
                                </li>

                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="task"
                                                    value="{{ $item->task }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label>
                                                    <input type="radio" value="1" name="is_done"
                                                        {{ $item->is_done == '1' ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done"
                                                        {{ $item->is_done == '0' ? 'checked' : '' }}> Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        {{ $data->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

</html>
