@empty($kategori)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm table-hover table-striped mb-2">
                    <tr>
                        <th>ID Kategori</th>
                        <td>{{ $kategori->kategori_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Kategori</th>
                        <td>{{ $kategori->kategori_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td>{{ $kategori->kategori_nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal dibuat</th>
                        <td>{{ $kategori->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal diupdate</th>
                        <td>{{ $kategori->updated_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
            </div>
        </div>
    </div>
@endempty
