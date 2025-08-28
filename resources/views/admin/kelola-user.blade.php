@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @if (session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif
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
                    <option value="admin">Admin</option>
                    <option value="ketua_bidang">Ketua Bidang</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="warga">Warga</option>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $role = $user->role ?? 'User';
                                    $roleColors = [
                                        'Admin' => 'bg-red-100 text-red-800',
                                        'Supervisor' => 'bg-blue-100 text-blue-800',
                                        'Teknisi' => 'bg-green-100 text-green-800',
                                    ];
                                    $roleClass = $roleColors[$role] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleClass }}">
                                    {{ $role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.users.detail', $user->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Detail">
                                        <!-- ikon detail -->
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <button class="btnHapus text-red-600 hover:text-red-900" title="Hapus"
                                        data-id="{{ $user->id }}" data-nama="{{ $user->name }}">
                                        <!-- ikon hapus -->
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    <!-- Modal Form Tambah User -->
    <div id="modalTambahUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Animated Backdrop -->
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0,0,0,0.1);"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah User Baru</h3>
                        <button id="btnCloseModalTambah" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <input type="hidden" name="form_type" value="user_create">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-300 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-300 @enderror"
                                    placeholder="user@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-300 @enderror"
                                    placeholder="Minimal 6 karakter">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-300 @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Ketua Bidang" {{ old('role') == 'Ketua Bidang' ? 'selected' : '' }}>
                                        Ketua
                                        Bidang</option>
                                    <option value="Pegawai" {{ old('role') == 'Pegawai' ? 'selected' : '' }}>Pegawai
                                    </option>
                                    <option value="Warga" {{ old('role') == 'Warga' ? 'selected' : '' }}>Warga</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalTambah"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit User -->
    <!-- Modal Form Edit User -->
    <div id="modalEditUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Animated Backdrop -->
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0,0,0,0.1);"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
                        <button id="btnCloseModalEdit" class="text-gray-400 hover:text-gray-600 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="formEditUser" method="POST" action="#">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="form_type" value="user_edit">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" id="editNama"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-300 @enderror"
                                    placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="editEmail"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-300 @enderror"
                                    placeholder="user@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru
                                    (opsional)</label>
                                <input type="password" name="password" id="editPassword"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-300 @enderror"
                                    placeholder="Kosongkan jika tidak diubah">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" id="editRole"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-300 @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Ketua Bidang">Ketua Bidang</option>
                                    <option value="Pegawai">Pegawai</option>
                                    <option value="Warga">Warga</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" id="btnBatalEdit"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Konfirmasi Hapus -->
    <!-- Modal Konfirmasi Hapus -->
    <div id="modalKonfirmasiHapus" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 backdrop-blur-sm transition-opacity duration-300 opacity-0"
            style="background-color: rgba(0,0,0,0.1);"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div
                class="modal-content bg-white rounded-xl shadow-2xl max-w-sm w-full transform scale-95 transition-all duration-300 opacity-0">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
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
                    <form id="formHapusUser" method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end space-x-3">
                            <button type="button" id="btnBatalHapus"
                                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Anim helpers
            function showModal(id) {
                const m = document.getElementById(id);
                const b = m.querySelector('.modal-backdrop');
                const c = m.querySelector('.modal-content');
                m.classList.remove('hidden');
                m.offsetHeight;
                b.classList.remove('opacity-0');
                b.classList.add('opacity-100');
                c.classList.remove('opacity-0', 'scale-95');
                c.classList.add('opacity-100', 'scale-100');
            }

            function hideModal(id) {
                const m = document.getElementById(id);
                const b = m.querySelector('.modal-backdrop');
                const c = m.querySelector('.modal-content');
                b.classList.remove('opacity-100');
                b.classList.add('opacity-0');
                c.classList.remove('opacity-100', 'scale-100');
                c.classList.add('opacity-0', 'scale-95');
                setTimeout(() => m.classList.add('hidden'), 300);
            }

            // Tambah
            document.getElementById('btnTambahUser')?.addEventListener('click', () => showModal('modalTambahUser'));
            document.getElementById('btnCloseModalTambah')?.addEventListener('click', () => hideModal(
                'modalTambahUser'));
            document.getElementById('btnBatalTambah')?.addEventListener('click', () => hideModal(
                'modalTambahUser'));

            document.getElementById('btnCloseModalEdit')?.addEventListener('click', () => hideModal(
                'modalEditUser'));
            document.getElementById('btnBatalEdit')?.addEventListener('click', () => hideModal('modalEditUser'));

            // Hapus: buka + set action + tampil nama
            let userIdToDelete = null;
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.btnHapus');
                if (!btn) return;
                userIdToDelete = btn.dataset.id;
                document.getElementById('namaUserHapus').textContent = btn.dataset.nama || '';
                const formHapus = document.getElementById('formHapusUser');
                formHapus.action = "{{ route('admin.users.destroy', '__ID__') }}".replace('__ID__',
                    userIdToDelete);
                showModal('modalKonfirmasiHapus');
            });
            document.getElementById('btnBatalHapus')?.addEventListener('click', () => hideModal(
                'modalKonfirmasiHapus'));

            // Backdrop click
            document.addEventListener('click', function(e) {
                if (!e.target.classList.contains('modal-backdrop')) return;
                if (e.target.closest('#modalTambahUser')) hideModal('modalTambahUser');
                if (e.target.closest('#modalEditUser')) hideModal('modalEditUser');
                if (e.target.closest('#modalKonfirmasiHapus')) hideModal('modalKonfirmasiHapus');
            });

            // ESC
            document.addEventListener('keydown', function(e) {
                if (e.key !== 'Escape') return;
                ['modalTambahUser', 'modalEditUser', 'modalKonfirmasiHapus'].forEach(hideModal);
            });

            // Auto-open modal saat validasi gagal
            @if ($errors->any() && old('_token'))
                @if (old('form_type') === 'user_create')
                    showModal('modalTambahUser');
                @elseif (old('form_type') === 'user_edit')
                    showModal('modalEditUser');
                @endif
            @endif

            // (opsional) Search + Filter milikmu tetap bisa dipakai
        });
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
