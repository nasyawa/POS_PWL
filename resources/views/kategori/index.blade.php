@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kategori</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/kategori/create') }}')" class="btn 
btn-success">Tambah Data
                    (Ajax)</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-sm table-striped table-hover" id="table-kategori">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode level</th>
                        <th>Nama level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var tableKategori;
        $(document).ready(function() {
            tableKategori = $('#table-kategori').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('kategori/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{
                        data: "No_Urut",
                        className: "text-center",
                        width: "5%",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kategori_kode",
                        className: "",
                        width: "10%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kategori_nama",
                        className: "",
                        width: "70%",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        className: "text-center",
                        width: "15%",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#table-kategori_filter input').unbind().bind().on('keyup', function(e) {
                if (e.keyCode == 13) { // enter key 
                    tableKategori.search(this.value).draw();
                }
            });
        });
    </script>
@endpush
