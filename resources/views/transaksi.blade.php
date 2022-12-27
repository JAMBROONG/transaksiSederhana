@extends('index')
@section('content')
    <div class="container">
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="{{ route('addTransaksi') }}">Tambah Data</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->pembeli->nama }}</td>
                            <td>{{ $row->barang->nm_barang }}</td>
                            <td>{{ $row->barang->harga }}</td>
                            <td>{{ $row->jumlah }}</td>
                            <td>{{ $row->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection