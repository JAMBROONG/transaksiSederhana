@extends('index')
@section('content')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-EBUA5xAQCLIohq_j"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
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
                            <th>Status</th>
                            <th>Aksi</th>
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
                                <td>
                                    @if ($row->status == 0)
                                    belum bayar
                                    @else
                                    sudah bayar
                                    @endif
                                </td>
                                <td>
                                    <button data-id="{{ $row->id }}" data-grossamout="{{ $row->total }}"
                                        data-firstname="{{ $row->pembeli->nama }}" data-snaptoken="{{$row->snap_token}}" id="pay-button"
                                        class="btn btn-sm btn-primary">Bayar Sekarang!</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        // var payButton = document.getElementById('pay-button');
        $('body').on('click', '#pay-button', function() {
            let id = $(this).data('id');
            let gross_amount = $(this).data('grossamout');
            let first_name = $(this).data('firstname');
            let snap_token = $(this).data('snaptoken');
            console.log(id);
            console.log(gross_amount);
            console.log(first_name);
            $.ajax({
                url: '{{ route('transaksi.createpayment') }}',
                dataType: 'json',
                type: 'post',
                data: {
                    id,
                    gross_amount,
                    first_name,
                    snap_token,
                },
                success: function(snapToken) {
                    // Menerima Parameter SnapToken
                    // console.log($snapToken)
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            alert("payment success!");
                            console.log(result);
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("wating your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                }
            });
        });
    </script>

@endsection

