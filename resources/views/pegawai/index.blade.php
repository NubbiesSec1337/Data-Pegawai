@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Pegawai</h1>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
        <form action="{{ route('pegawai.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari Pegawai" value="{{ request('search') }}">
            <input type="text" name="posisi" class="form-control me-2" placeholder="Cari Posisi" value="{{ request('posisi') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="?sortBy=nama&sortDirection={{ request('sortDirection') == 'asc' ? 'desc' : 'asc' }}" class="text-white text-decoration-none">
                        Nama
                        <i class="fas fa-sort{{ request('sortDirection') == 'asc' ? '-down' : '-up' }}"></i>
                    </a>
                </th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($pegawai as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->posisi }}</td>
                <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}</td>
                <td class="d-flex">
                    <a href="{{ route('pegawai.edit', $p->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data pegawai yang ditemukan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $pegawai->links() }}
    </div>
</div>
@endsection
