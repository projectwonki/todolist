<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>To-Do List - Daftar Tugas</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/tasks.js'])
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-slate-950 shadow-sm border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold text-slate-900 dark:text-slate-50">Daftar Tugas</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('tasks.create') }}" 
                           class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 bg-slate-900 text-slate-50 hover:bg-slate-900/90 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/90 h-9 px-4 py-2">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                            Tambah Tugas
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-slate-200 bg-white hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50 h-9 px-4 py-2">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Filters and Sort -->
            <div class="mb-6">
                <div class="rounded-lg border border-slate-200 bg-white text-slate-950 shadow-sm dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold mb-4">Filter & Urutkan</h2>
                        <form method="GET" action="{{ route('tasks.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Status Filter -->
                            <div class="space-y-2">
                                <label for="status" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    Filter berdasarkan Status
                                </label>
                                <select name="status" id="status" 
                                        class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300">
                                    <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort by Due Date -->
                            <div class="space-y-2">
                                <label for="order_by" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    Urutkan berdasarkan
                                </label>
                                <select name="order_by" id="order_by" 
                                        class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300">
                                    <option value="created_at" {{ request('order_by') == 'created_at' || !request('order_by') ? 'selected' : '' }}>Tanggal Dibuat</option>
                                    <option value="due_date" {{ request('order_by') == 'due_date' ? 'selected' : '' }}>Batas Waktu</option>
                                    <option value="title" {{ request('order_by') == 'title' ? 'selected' : '' }}>Judul Tugas</option>
                                </select>
                            </div>

                            <!-- Sort Direction -->
                            <div class="space-y-2">
                                <label for="order_direction" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    Urutan
                                </label>
                                <select name="order_direction" id="order_direction" 
                                        class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300">
                                    <option value="asc" {{ request('order_direction') == 'asc' || !request('order_direction') ? 'selected' : '' }}>Naik (A-Z, Terlama)</option>
                                    <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>Turun (Z-A, Terbaru)</option>
                                </select>
                            </div>

                            <!-- Filter Button -->
                            <div class="md:col-span-3 flex space-x-2">
                                <button type="submit" 
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 bg-slate-900 text-slate-50 hover:bg-slate-900/90 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/90 h-9 px-4 py-2">
                                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M7 12h10"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('tasks.index') }}" 
                                   class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-slate-200 bg-white hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50 h-9 px-4 py-2">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800 dark:border-green-800 dark:bg-green-950 dark:text-green-200">
                    <div class="flex items-center">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Tasks Table -->
            <div class="rounded-lg border border-slate-200 bg-white text-slate-950 shadow-sm dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50">
                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-4">
                        Daftar Tugas 
                        <span class="text-sm font-normal text-slate-500 dark:text-slate-400">
                            ({{ $tasks->count() }} tugas)
                        </span>
                    </h2>
                    
                    @if($tasks->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-slate-200 dark:border-slate-800">
                                        <th class="text-left py-3 px-4 font-medium text-slate-600 dark:text-slate-300">Judul Tugas</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-600 dark:text-slate-300">Deskripsi</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-600 dark:text-slate-300">Status</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-600 dark:text-slate-300">Batas Waktu</th>
                                        <th class="text-left py-3 px-4 font-medium text-slate-600 dark:text-slate-300">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                        <tr class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-slate-900 dark:text-slate-50">{{ $task->title }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-slate-600 dark:text-slate-300 max-w-xs truncate">
                                                    {{ $task->description ?: '-' }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                @php
                                                    $statusColors = [
                                                        'To-Do' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-950 dark:text-yellow-200',
                                                        'In Progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-200',
                                                        'Done' => 'bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-200'
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $task->status ?: '-' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4">
                                                @if($task->due_date)
                                                    @php
                                                        $dueDate = \Carbon\Carbon::parse($task->due_date);
                                                        $now = \Carbon\Carbon::now();
                                                        $isOverdue = $dueDate->isPast() && $task->status !== 'Done';
                                                        $isDueSoon = $dueDate->diffInDays($now) <= 3 && $dueDate->isFuture();
                                                    @endphp
                                                    <div class="text-sm">
                                                        <div class="{{ $isOverdue ? 'text-red-600 dark:text-red-400 font-medium' : ($isDueSoon ? 'text-orange-600 dark:text-orange-400 font-medium' : 'text-slate-600 dark:text-slate-300') }}">
                                                            {{ $dueDate->format('d M Y') }}
                                                        </div>
                                                        <div class="text-xs text-slate-500 dark:text-slate-400">
                                                            {{ $dueDate->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-slate-400 dark:text-slate-500">-</span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('tasks.edit', $task->id) }}" 
                                                       class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-slate-200 bg-white hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50 h-8 w-8">
                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                        </svg>
                                                    </a>
                                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-red-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 dark:border-red-800 dark:bg-slate-950 dark:text-red-400 dark:hover:bg-red-950 dark:hover:text-red-300 h-8 w-8">
                                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M3 6h18"/>
                                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                                <path d="M8 6V4c0-1 1-2 2-2h4c0-1 1-2 2-2v2"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-slate-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2h-4"/>
                                <rect width="6" height="10" x="9" y="1" rx="2"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-slate-50">Tidak ada tugas</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Mulai dengan membuat tugas pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('tasks.create') }}" 
                                   class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 bg-slate-900 text-slate-50 hover:bg-slate-900/90 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/90 h-9 px-4 py-2">
                                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"/>
                                        <path d="M12 5v14"/>
                                    </svg>
                                    Tambah Tugas
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
