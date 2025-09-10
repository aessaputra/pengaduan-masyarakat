@extends('layouts.admin')

@section('title', 'Detail Admin')

@section('content')
    <a href="{{ route('admin.admins.index') }}" class="btn btn-danger mb-3">Kembali</a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Admin</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 200px;">Nama</td>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $admin->email }}</td>
                </tr>
                <tr>
                    <td>Tanggal Dibuat</td>
                    <td>{{ $admin->created_at->format('d F Y H:i') }}</td>
                </tr>
                <tr>
                    <td>Terakhir Diperbarui</td>
                    <td>{{ $admin->updated_at->format('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
