@extends('index')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('storeTransaksi') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="pembeli">Pembeli</label>
                        <select name="pembeli" id="pembeli" class="form-control">
                            <option value="">-- Pilih Pembeli --</option>
                            @foreach ($pembeli as $row)
                                <option value="{{ $row->id }}">{{ $row->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="barang">Barang</label>
                        <select name="barang" id="barang" class="form-control">
                            <option value="">-- Pilih Pembeli --</option>
                            @foreach ($barang as $row)
                                <option value="{{ $row->id }}">{{ $row->nm_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection