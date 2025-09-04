<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>To-Do List - Tambah Tugas</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/tasks.js'])
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-slate-950 shadow-sm border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('tasks.index') }}" 
                           class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-slate-200 bg-white hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50 h-9 px-4 py-2">
                            <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 19-7-7 7-7"/>
                                <path d="M19 12H5"/>
                            </svg>
                            Kembali
                        </a>
                        <h1 class="text-xl font-semibold text-slate-900 dark:text-slate-50">Tambah Tugas Baru</h1>
                    </div>
                    <div class="flex items-center space-x-4">
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
        <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-800 dark:border-red-800 dark:bg-red-950 dark:text-red-200">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" y1="9" x2="9" y2="15"/>
                            <line x1="9" y1="9" x2="15" y2="15"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium mb-2">Terdapat kesalahan pada form:</h3>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Card -->
            <div class="rounded-lg border border-slate-200 bg-white text-slate-950 shadow-sm dark:border-slate-800 dark:bg-slate-950 dark:text-slate-50">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="rounded-full bg-slate-100 dark:bg-slate-800 p-3 mr-4">
                            <svg class="h-6 w-6 text-slate-600 dark:text-slate-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2h-4"/>
                                <rect width="6" height="10" x="9" y="1" rx="2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold">Buat Tugas Baru</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Isi form di bawah untuk menambahkan tugas baru</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('tasks.store') }}" id="task-form" class="space-y-6">
                        @csrf
                        
                        <!-- Judul Tugas -->
                        <div class="space-y-2">
                            <label for="title" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Judul Tugas <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                                <input
                                    id="title"
                                    name="title"
                                    type="text"
                                    placeholder="Masukkan judul tugas"
                                    value="{{ old('title') }}"
                                    class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300 @error('title') border-red-500 focus-visible:ring-red-500 @enderror"
                                    required
                                    maxlength="255"
                                />
                            </div>
                            @error('title')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2">
                            <label for="description" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Deskripsi
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14,2 14,8 20,8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10,9 9,9 8,9"/>
                                </svg>
                                <textarea
                                    id="description"
                                    name="description"
                                    rows="4"
                                    placeholder="Masukkan deskripsi tugas (opsional)"
                                    class="flex min-h-[80px] w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 text-sm ring-offset-white placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300 @error('description') border-red-500 focus-visible:ring-red-500 @enderror"
                                >{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Status
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9,11 12,14 22,4"/>
                                    <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9c1.34 0 2.6.29 3.74.82"/>
                                </svg>
                                <select name="status" id="status" 
                                        class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 @error('status') border-red-500 focus-visible:ring-red-500 @enderror">
                                    <option value="">Pilih Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('status')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Batas Waktu -->
                        <div class="space-y-2">
                            <label for="due_date" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                Batas Waktu
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-3 h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                <input
                                    id="due_date"
                                    name="due_date"
                                    type="date"
                                    value="{{ old('due_date') }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="flex h-10 w-full rounded-md border border-slate-200 bg-white px-3 py-2 pl-10 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-slate-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-800 dark:bg-slate-950 dark:ring-offset-slate-950 dark:placeholder:text-slate-400 dark:focus-visible:ring-slate-300 @error('due_date') border-red-500 focus-visible:ring-red-500 @enderror"
                                />
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                Pilih tanggal batas waktu penyelesaian tugas (opsional)
                            </p>
                            @error('due_date')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-800">
                            <div class="text-sm text-slate-500 dark:text-slate-400">
                                <span class="text-red-500">*</span> Wajib diisi
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('tasks.index') }}" 
                                   class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 border border-slate-200 bg-white hover:bg-slate-100 hover:text-slate-900 dark:border-slate-800 dark:bg-slate-950 dark:hover:bg-slate-800 dark:hover:text-slate-50 h-10 px-6 py-2">
                                    Batal
                                </a>
                                <button type="submit" 
                                        id="submit-button"
                                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-slate-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 dark:ring-offset-slate-950 dark:focus-visible:ring-slate-300 bg-slate-900 text-slate-50 hover:bg-slate-900/90 dark:bg-slate-50 dark:text-slate-900 dark:hover:bg-slate-50/90 h-10 px-6 py-2">
                                    <!-- Default Text -->
                                    <span id="default-text" class="flex items-center">
                                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"/>
                                            <path d="M12 5v14"/>
                                        </svg>
                                        Simpan Tugas
                                    </span>
                                    <!-- Loading Text -->
                                    <div id="loading-text" class="flex items-center space-x-2" style="display: none;">
                                        <div class="animate-spin h-4 w-4 border-2 border-current border-t-transparent rounded-full"></div>
                                        <span>Menyimpan...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="mt-6 rounded-lg border border-slate-200 bg-slate-50 text-slate-950 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:text-slate-50">
                <div class="p-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4"/>
                            <path d="M12 8h.01"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-slate-900 dark:text-slate-50 mb-1">Tips Pengisian Form</h3>
                            <ul class="text-sm text-slate-600 dark:text-slate-300 space-y-1">
                                <li>• <strong>Judul Tugas</strong>: Buat judul yang singkat dan jelas</li>
                                <li>• <strong>Deskripsi</strong>: Tambahkan detail tugas untuk memudahkan pengerjaan</li>
                                <li>• <strong>Status</strong>: Pilih status awal tugas (umumnya "To-Do" untuk tugas baru)</li>
                                <li>• <strong>Batas Waktu</strong>: Tentukan deadline untuk meningkatkan produktivitas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Form submission handling
        document.getElementById('task-form').addEventListener('submit', function() {
            const submitButton = document.getElementById('submit-button');
            const defaultText = document.getElementById('default-text');
            const loadingText = document.getElementById('loading-text');
            
            submitButton.disabled = true;
            defaultText.style.display = 'none';
            loadingText.style.display = 'flex';
        });

        // Character counter for title
        const titleInput = document.getElementById('title');
        if (titleInput) {
            titleInput.addEventListener('input', function() {
                const current = this.value.length;
                const max = this.maxLength;
                
                // You could add a character counter here if needed
                console.log(`Title: ${current}/${max} characters`);
            });
        }

        // Set default status to "To-Do" if none selected
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            if (statusSelect && !statusSelect.value) {
                statusSelect.value = 'To-Do';
            }
        });
    </script>
</body>
</html>
