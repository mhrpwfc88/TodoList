<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mh_ProCode</title>
    <link rel="icon" type="image/x-icon" href="logo.PNG">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-light">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10" src="logo.PNG" alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="#"
                                    class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                                    aria-current="page">NataDev.</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Mh_ProCode</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">


                <div class="container mx-auto sm:px-4 mt-4">
                    <h1 class="text-center font-bold text-3xl text-bold mb-4">List Target</h1>
                    <div class="flex flex-wrap  justify-center">
                        <div class="grid-cols-8 ">
                            <div
                                class="relative  flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-3">
                                <div class="flex-auto p-6">
                                    @if (session('berhasil'))
                                        <div
                                            class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800">
                                            {{ session('berhasil') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div
                                            class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800">
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
                                        <div class="relative flex items-stretch w-full mb-3">
                                            <input type="text"
                                                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                                name="task" id="todo-input" placeholder="Tambah task baru"
                                                value="{{ old('task') }}">
                                            <button
                                                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600"
                                                type="submit">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div
                                class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                                <div class="flex-auto p-6">
                               
                                    <form id="todo-form" action="{{ route('todo') }}" method="get">
                                        <div class="relative flex items-stretch w-full mb-3">
                                            <input type="text"
                                                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                                name="search" value="{{ request('search') }}"
                                                placeholder="masukkan kata kunci">
                                            <button
                                                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-600 text-white hover:bg-gray-700"
                                                type="submit">
                                                Cari
                                            </button>
                                        </div>
                                    </form>
                                    <ul class="flex flex-col border rounded border-gray-300  mb-4" id="todo-list">

                                        @foreach ($data as $item)
                                            <li
                                                class="relative  py-3 px-6 max-w-50 border border-r-0 border-l-0 border-gray-300 no-underline flex justify-between items-center">
                                                <span class="task-text">
                                                    @if ($item->is_done == '0')
                                                        {{ $item->task }}
                                                    @else
                                                        <del>{{ $item->task }}</del>
                                                    @endif
                                                </span>
                                                <input type="text"
                                                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded edit-input"
                                                    style="display: none;" value="{{ $item->task }}">
                                                <div class="relative inline-flex align-middle">
                                                    <form action="{{ route('todo.delete', ['id' => $item->id]) }}"
                                                        method="POST" onsubmit="return confirm('yakin Hapus Data?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-red-600 text-white hover:bg-red-700 py-1 px-2 leading-tight text-xs  delete-btn">delete</button>
                                                    </form>
                                                    <button
                                                        class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded no-underline bg-blue-600 text-white hover:bg-blue-700 py-1 px-2 leading-tight text-xs edit-btn"
                                                        onclick="toggleEditForm({{ $loop->index }})">Edit</button>
                                                </div>
                                            </li>

                                            <li class="relative py-3 px-6 -mb-px border border-gray-300 hidden"
                                                id="collapse-{{ $loop->index }}">
                                                <form action="{{ route('todo.update', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div>
                                                        <div class="relative flex items-stretch w-full mb-3">
                                                            <input type="text"
                                                                class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                                                                name="task" value="{{ $item->task }}">
                                                            <button
                                                                class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-blue-600 border-blue-600 hover:text-white bg-white hover:bg-blue-600"
                                                                type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                    <div class="flex">
                                                        <div class="radio px-2">
                                                            <label>
                                                                <input type="radio" value="1" name="is_done"
                                                                    {{ $item->is_done == '1' ? 'checked' : '' }}>
                                                                Selesai
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


            </div>
        </main>
    </div>



    <script>
        function toggleEditForm(index) {
            const element = document.getElementById('collapse-' + index);
            element.classList.toggle('hidden');
        }
    </script>
</body>

</html>
