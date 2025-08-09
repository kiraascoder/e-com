@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Kelola User</h1>
                    <p class="mt-1 text-blue-100">Atur dan kelola data pengguna sistem</p>
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Action Buttons -->
        <div class="flex justify-between items-center mb-6">
            <button id="btnTambahUser"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                + Tambah User
            </button>

            <div class="flex items-center space-x-3">
                <input type="text" id="searchUser" placeholder="Cari user..."
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select id="filterRole"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Supervisor">Supervisor</option>
                    <option value="Teknisi">Teknisi</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir
                            Login</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $users = [
                            [
                                'id' => 1,
                                'nama' => 'Ahmad Wijaya',
                                'email' => 'ahmad.wijaya@admin.com',
                                'role' => 'Admin',
                                'status' => 'Aktif',
                                'last_login' => '2 jam yang lalu',
                            ],
                            [
                                'id' => 2,
                                'nama' => 'Siti Nurhaliza',
                                'email' => 'siti.nurhaliza@supervisor.com',
                                'role' => 'Supervisor',
                                'status' => 'Aktif',
                                'last_login' => '1 hari yang lalu',
                            ],
                            [
                                'id' => 3,
                                'nama' => 'Budi Santoso',
                                'email' => 'budi.santoso@teknisi.com',
                                'role' => 'Teknisi',
                                'status' => 'Tidak Aktif',
                                'last_login' => '1 minggu yang lalu',
                            ],
                            [
                                'id' => 4,
                                'nama' => 'Dewi Lestari',
                                'email' => 'dewi.lestari@teknisi.com',
                                'role' => 'Teknisi',
                                'status' => 'Aktif',
                                'last_login' => '3 jam yang lalu',
                            ],
                            [
                                'id' => 5,
                                'nama' => 'Eko Prasetyo',
                                'email' => 'eko.prasetyo@supervisor.com',
                                'role' => 'Supervisor',
                                'status' => 'Aktif',
                                'last_login' => '30 menit yang lalu',
                            ],
                        ];
                    @endphp

                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user['id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user['nama'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $roleColors = [
                                        'Admin' => 'bg-red-100 text-red-800',
                                        'Supervisor' => 'bg-blue-100 text-blue-800',
                                        'Teknisi' => 'bg-green-100 text-green-800',
                                    ];
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColors[$user['role']] }}">
                                    {{ $user['role'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user['status'] == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $user['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user['last_login'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="btnEdit text-blue-600 hover:text-blue-900" title="Edit"
                                        data-id="{{ $user['id'] }}" data-nama="{{ $user['nama'] }}"
                                        data-email="{{ $user['email'] }}" data-role="{{ $user['role'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="btnHapus text-red-600 hover:text-red-900" title="Hapus"
                                        data-id="{{ $user['id'] }}" data-nama="{{ $user['nama'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-gray-600">
                Menampilkan 1 - 5 dari 5 data
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 disabled:opacity-50"
                    disabled>
                    Previous
                </button>
                <button class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm">1</button>
                <button class="px-3 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 disabled:opacity-50"
                    disabled>
                    Next
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah User -->
    <div id="modalTambahUser" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah User Baru</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="tambahNama"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="tambahEmail"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="user@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="tambahPassword"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan password">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select id="tambahRole"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Teknisi">Teknisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalTambah"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit User -->
    <div id="modalEditUser" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Edit User</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="editNama"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="editEmail"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="user@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (kosongkan jika
                                    tidak ingin mengubah)</label>
                                <input type="password" id="editPassword"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan password baru (opsional)">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select id="editRole"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Teknisi">Teknisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalEdit"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalKonfirmasiHapus" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-sm w-full">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.732 19c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Apakah Anda yakin ingin menghapus user <strong id="namaUserHapus"></strong>?
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="btnBatalHapus"
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="button" id="btnKonfirmasiHapus"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let userIdToDelete = null;

        // Modal Tambah User
        document.getElementById('btnTambahUser').addEventListener('click', function() {
            document.getElementById('modalTambahUser').classList.remove('hidden');
        });

        document.getElementById('btnBatalTambah').addEventListener('click', function() {
            document.getElementById('modalTambahUser').classList.add('hidden');
            clearTambahForm();
        });

        // Modal Edit User
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btnEdit')) {
                const btn = e.target.closest('.btnEdit');
                const id = btn.dataset.id;
                const nama = btn.dataset.nama;
                const email = btn.dataset.email;
                const role = btn.dataset.role;

                // Populate form edit
                document.getElementById('editNama').value = nama;
                document.getElementById('editEmail').value = email;
                document.getElementById('editRole').value = role;
                document.getElementById('editPassword').value = '';

                document.getElementById('modalEditUser').classList.remove('hidden');
            }
        });

        document.getElementById('btnBatalEdit').addEventListener('click', function() {
            document.getElementById('modalEditUser').classList.add('hidden');
            clearEditForm();
        });

        // Modal Konfirmasi Hapus
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btnHapus')) {
                const btn = e.target.closest('.btnHapus');
                const id = btn.dataset.id;
                const nama = btn.dataset.nama;

                userIdToDelete = id;
                document.getElementById('namaUserHapus').textContent = nama;
                document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
            }
        });

        document.getElementById('btnBatalHapus').addEventListener('click', function() {
            document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
            userIdToDelete = null;
        });

        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (userIdToDelete) {
                // Hapus row dari tabel
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const editBtn = row.querySelector('.btnEdit');
                    if (editBtn && editBtn.dataset.id === userIdToDelete) {
                        row.remove();
                    }
                });

                // Tutup modal
                document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
                userIdToDelete = null;

                // Tampilkan notifikasi (opsional)
                alert('User berhasil dihapus!');
            }
        });

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'modalTambahUser') {
                document.getElementById('modalTambahUser').classList.add('hidden');
                clearTambahForm();
            }
            if (e.target.id === 'modalEditUser') {
                document.getElementById('modalEditUser').classList.add('hidden');
                clearEditForm();
            }
            if (e.target.id === 'modalKonfirmasiHapus') {
                document.getElementById('modalKonfirmasiHapus').classList.add('hidden');
                userIdToDelete = null;
            }
        });

        // Helper functions
        function clearTambahForm() {
            document.getElementById('tambahNama').value = '';
            document.getElementById('tambahEmail').value = '';
            document.getElementById('tambahPassword').value = '';
            document.getElementById('tambahRole').value = '';
        }

        function clearEditForm() {
            document.getElementById('editNama').value = '';
            document.getElementById('editEmail').value = '';
            document.getElementById('editPassword').value = '';
            document.getElementById('editRole').value = '';
        }

        // Search functionality (basic)
        document.getElementById('searchUser').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const nama = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (nama.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter by role
        document.getElementById('filterRole').addEventListener('change', function() {
            const selectedRole = this.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const role = row.cells[3].textContent.trim();

                if (selectedRole === '' || role === selectedRole) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endpush
