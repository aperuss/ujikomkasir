<div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="h1 mt-3 mb-4">Riwayat aksi</div>
            <div class="card border-primary">
                <div class="card-header">
                    History
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Objek</th>
                                <th>Aksi</th>
                                <th>Tabel</th>  
                                <th>Data</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayats as $riwayat)
                                <tr>
                                    <td>{{ $riwayat->user }}</td>
                                    <td>{{ $riwayat->action }}</td>
                                    <td>{{ $riwayat->table_name }}</td>
                                    <td>{{ ($riwayat->data) }}</td>
                                    <td>{{ $riwayat->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
