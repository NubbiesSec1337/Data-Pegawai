@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pegawai</h1>
    
    <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>

    <form action="{{ route('pegawai.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari Pegawai" value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th><a href="?sortBy=nama&sortDirection={{ request('sortDirection') == 'asc' ? 'desc' : 'asc' }}">Nama</a></th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $p)
            <tr>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->posisi }}</td>
                <td>{{ $p->tanggal_lahir->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('pegawai.edit', $p->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pegawai->links() }}
</div>
@endsection
