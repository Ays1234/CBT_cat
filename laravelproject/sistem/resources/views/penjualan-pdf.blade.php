<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="table-responsive">
    <table id="datatables" class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">ID Transaksi</th>
                <th class="text-center">Kode Barang</th>
                <th class="text-center">Total Harga</th>
                <th class="text-center">Laba</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $no => $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->id_transaksi}}</td>
                <td>{{$value->kode}}</td>
                <td>{{$value->total_harga}}</td>
                <td>{{$value->laba}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
