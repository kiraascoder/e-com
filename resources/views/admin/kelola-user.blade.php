@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
    <!-- Header -->
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

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Actions -->
        <div class="flex justify-between items-center mb-6">
            <button id="btnTambahUser"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                + Tambah User
            </button>

            <div class="flex items-center gap-3">
                <input type="text" id="searchUser" placeholder="Cari user..."
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select id="filterRole"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="ketua_bidang">Ketua Bidang</option>
                    <option value="pegawai">Pegawai</option>
                    <option value="kepala_dinas">Kepala Dinas</option>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        @php
                            $role = $user->role ?? 'kepala_dinas';
                            $roleLabels = [
                                'admin' => 'Admin',
                                'ketua_bidang' => 'Ketua Bidang',
                                'pegawai' => 'Pegawai',
                                'kepala_dinas' => 'Kepala Dinas',
                            ];
                            $roleColors = [
                                'admin' => 'bg-red-100 text-red-800',
                                'ketua_bidang' => 'bg-indigo-100 text-indigo-800',
                                'pegawai' => 'bg-green-100 text-green-800',
                                'kepala_dinas' => 'bg-gray-100 text-green-800',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50" data-role="{{ $role }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColors[$role] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $roleLabels[$role] ?? $role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.users.detail', $user->id) }}"
                                       class="text-blue-600 hover:text-blue-900" title="Detail" aria-label="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                        </a>
                                    <!-- Hapus -->
                                    <button type="button"
                                        class="btnHapus text-red-600 hover:text-red-900"
                                        title="Hapus" aria-label="Hapus"
                                        data-id="{{ $user->id }}"
                                        data-nama="{{ $user->name }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-gray-600">
                @if ($users->total())
                    Menampilkan {{ $users->firstItem() }} – {{ $users->lastItem() }} dari {{ $users->total() }} data
                @else
                    Menampilkan 0 data
                @endif
            </div>
            <div>
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambahUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 bg-black/20 opacity-0 transition-opacity duration-300"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah User Baru</h3>
                        <button type="button" class="btnCloseModal text-gray-400 hover:text-gray-600" data-target="modalTambahUser" aria-label="Tutup">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <input type="hidden" name="form_type" value="user_create">

                    <div class="space-y-4">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-300 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIP --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" name="nip" value="{{ old('nip') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nip') border-red-300 @enderror"
                                placeholder="Masukkan NIP">
                            @error('nip') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-300 @enderror"
                                placeholder="user@example.com">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" name="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-300 @enderror"
                                placeholder="Minimal 6 karakter">
                            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select name="role" id="roleSelect"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-300 @enderror">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="ketua_bidang" {{ old('role') === 'ketua_bidang' ? 'selected' : '' }}>Ketua Bidang</option>
                                <option value="pegawai" {{ old('role') === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                <option value="kepala_dinas" {{ old('role') === 'kepala_dinas' ? 'selected' : '' }}>Kepala Dinas</option>
                            </select>
                            @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Bidang (muncul jika role pegawai/ketua_bidang) --}}
                        <div id="formBidangCreate" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bidang</label>
                            <select name="bidang_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bidang_id') border-red-300 @enderror">
                                <option value="">Pilih Bidang</option>
                                @foreach ($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}" {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                        {{ $bidang->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bidang_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" name="alamat" value="{{ old('alamat') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-300 @enderror"
                                placeholder="Alamat tempat tinggal">
                            @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- No Telepon --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_telepon') border-red-300 @enderror"
                                placeholder="08xxxxxxxxxx">
                            @error('no_telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_kelamin') border-red-300 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ old('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_lahir') border-red-300 @enderror">
                            @error('tanggal_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button"
                            class="btnCloseModal px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition"
                            data-target="modalTambahUser">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition transform hover:scale-105">
                            Simpan
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEditUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 bg-black/20 opacity-0 transition-opacity duration-300"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="modal-content bg-white rounded-xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Edit User</h3>
                        <button type="button" class="btnCloseModal text-gray-400 hover:text-gray-600" data-target="modalEditUser" aria-label="Tutup">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
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
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="editEmail"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-300 @enderror"
                                       placeholder="user@example.com">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru (opsional)</label>
                                <input type="password" name="password" id="editPassword"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-300 @enderror"
                                       placeholder="Kosongkan jika tidak diubah">
                                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" id="editRole"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-300 @enderror">
                                    <option value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="ketua_bidang">Ketua Bidang</option>
                                    <option value="pegawai">Pegawai</option>
                                    <option value="kepala_dinas">Kepala Dinas</option>
                                </select>
                                @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div id="formBidangEdit" class="hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bidang</label>
                                <select name="bidang_id" id="editBidang"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bidang_id') border-red-300 @enderror">
                                    <option value="">Pilih Bidang</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                                    @endforeach
                                </select>
                                @error('bidang_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" class="btnCloseModal px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition" data-target="modalEditUser">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition transform hover:scale-105">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="modalKonfirmasiHapus" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="modal-backdrop fixed inset-0 bg-black/20 opacity-0 transition-opacity duration-300"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="modal-content bg-white rounded-xl shadow-2xl max-w-sm w-full transform scale-95 opacity-0 transition-all duration-300">
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
                            Apakah Anda yakin ingin menghapus user <strong id="namaUserHapus"></strong>? Tindakan ini tidak dapat dibatalkan.
                        </p>
                    </div>
                    <form id="formHapusUser" method="POST" action="#">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end gap-3">
                            <button type="button" class="btnCloseModal px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition" data-target="modalKonfirmasiHapus">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== Helpers modal animasi =====
    function showModal(id) {
        const m = document.getElementById(id);
        if (!m) return;
        const b = m.querySelector('.modal-backdrop');
        const c = m.querySelector('.modal-content');
        m.classList.remove('hidden');
        // force reflow
        void m.offsetWidth;
        b.classList.remove('opacity-0'); b.classList.add('opacity-100');
        c.classList.remove('opacity-0', 'scale-95'); c.classList.add('opacity-100', 'scale-100');
    }
    function hideModal(id) {
        const m = document.getElementById(id);
        if (!m) return;
        const b = m.querySelector('.modal-backdrop');
        const c = m.querySelector('.modal-content');
        b.classList.remove('opacity-100'); b.classList.add('opacity-0');
        c.classList.remove('opacity-100', 'scale-100'); c.classList.add('opacity-0', 'scale-95');
        setTimeout(() => m.classList.add('hidden'), 200);
    }
    function toggleBidang(selectEl, targetId) {
        const v = (selectEl?.value || '').toLowerCase();
        const wrap = document.getElementById(targetId);
        if (!wrap) return;
        const needBidang = ['pegawai', 'ketua_bidang'];
        if (needBidang.includes(v)) {
            wrap.classList.remove('hidden');
        } else {
            wrap.classList.add('hidden');
            const sel = wrap.querySelector('select[name="bidang_id"]');
            if (sel) sel.value = '';
        }
    }

    // ====== OPEN/CLOSE buttons ======
    document.getElementById('btnTambahUser')?.addEventListener('click', () => showModal('modalTambahUser'));
    document.querySelectorAll('.btnCloseModal').forEach(btn => {
        btn.addEventListener('click', () => hideModal(btn.dataset.target));
    });

    // backdrop click
    document.addEventListener('click', function(e){
        if (e.target.classList.contains('modal-backdrop')) {
            const wrapper = e.target.parentElement?.parentElement || e.target.parentElement;
            const modal = e.target.closest('.fixed.inset-0.z-50');
            if (modal?.id) hideModal(modal.id);
        }
    });

    // ESC
    document.addEventListener('keydown', function(e){
        if (e.key !== 'Escape') return;
        ['modalTambahUser','modalEditUser','modalKonfirmasiHapus'].forEach(hideModal);
    });

    // ====== Tambah: toggle bidang (initial + change) ======
    const roleCreate = document.querySelector('#modalTambahUser select[name="role"]');
    if (roleCreate) {
        toggleBidang(roleCreate, 'formBidangCreate');
        roleCreate.addEventListener('change', function(){ toggleBidang(this, 'formBidangCreate'); });
    }

    // ====== Edit: open + populate + toggle bidang ======
    const formEdit = document.getElementById('formEditUser');
    const roleEdit = document.getElementById('editRole');
    const selectBidangEdit = document.getElementById('editBidang');

    document.addEventListener('click', function(e){
        const btn = e.target.closest('.btnEdit');
        if (!btn) return;

        // Populate
        document.getElementById('editNama').value = btn.dataset.nama || '';
        document.getElementById('editEmail').value = btn.dataset.email || '';
        document.getElementById('editPassword').value = '';
        roleEdit.value = btn.dataset.role || '';
        if (formEdit) formEdit.action = btn.dataset.action || '#';

        // Bidang
        toggleBidang(roleEdit, 'formBidangEdit');
        if (selectBidangEdit) {
            selectBidangEdit.value = btn.dataset.bidangId || '';
        }

        showModal('modalEditUser');
    });

    if (roleEdit) {
        roleEdit.addEventListener('change', function(){ toggleBidang(this, 'formBidangEdit'); });
    }

    // ====== Hapus: open + set action + tampil nama ======
    const formHapus = document.getElementById('formHapusUser');
    document.addEventListener('click', function(e){
        const btn = e.target.closest('.btnHapus');
        if (!btn) return;
        document.getElementById('namaUserHapus').textContent = btn.dataset.nama || '';
        if (formHapus) {
            formHapus.action = @json(route('admin.users.destroy', '__ID__')).replace('__ID__', btn.dataset.id);
        }
        showModal('modalKonfirmasiHapus');
    });

    // ====== Auto-open modal saat validasi gagal ======
    @if ($errors->any() && old('_token'))
        @if (old('form_type') === 'user_create')
            showModal('modalTambahUser');
            setTimeout(() => { if (roleCreate) toggleBidang(roleCreate, 'formBidangCreate'); }, 0);
        @elseif (old('form_type') === 'user_edit')
            showModal('modalEditUser');
            setTimeout(() => { if (roleEdit) toggleBidang(roleEdit, 'formBidangEdit'); }, 0);
        @endif
    @endif

    // ====== Search & Filter ======
    const searchInput = document.getElementById('searchUser');
    const filterRole = document.getElementById('filterRole');

    function applyFilter() {
        const q = (searchInput?.value || '').toLowerCase();
        const roleVal = (filterRole?.value || '').toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const nama = (row.cells[1]?.textContent || '').toLowerCase();
            const email = (row.cells[2]?.textContent || '').toLowerCase();
            const roleStored = (row.dataset.role || '').toLowerCase();

            const matchSearch = (!q) || nama.includes(q) || email.includes(q);
            const matchRole = (!roleVal) || roleStored === roleVal;

            row.style.display = (matchSearch && matchRole) ? '' : 'none';
        });
    }

    searchInput?.addEventListener('input', applyFilter);
    filterRole?.addEventListener('change', applyFilter);
});
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const bidangBox  = document.getElementById('formBidangCreate');

    function toggleBidang() {
        const v = roleSelect.value;
        if (v === 'pegawai' || v === 'ketua_bidang') {
            bidangBox.classList.remove('hidden');
        } else {
            bidangBox.classList.add('hidden');
            // optional: kosongkan pilihan ketika disembunyikan
            const sel = bidangBox.querySelector('select[name="bidang_id"]');
            if (sel) sel.value = '';
        }
    }

    roleSelect.addEventListener('change', toggleBidang);
    toggleBidang(); // set initial state on load (respect old('role'))
});
</script>
@endpush
