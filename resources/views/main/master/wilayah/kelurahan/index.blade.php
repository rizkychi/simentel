@extends('_template.master-main')

@section('page_title', $page_title)

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">Daftar {{ $title }}. Kemantren {{ $kemantren->kecamatan }} </h5>
                <div class="d-flex flex-column flex-sm-row">
                    <a href="{{ route('master.wilayah.kemantren.index', ['kabupaten' => $kemantren->kabupaten_id]) }}" class="btn btn-info btn-sm text-nowrap mr-0 mr-sm-2 mb-1 mb-sm-0">
                        <i class="fas fa-list-ul mr-1"></i>Daftar Kemantren
                    </a>
                    <a href="{{ route('master.wilayah.kelurahan.create', ['kemantren' => request()->kemantren]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-1"></i>Tambah {{ $title }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="dtx" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode {{ $title }}</th>
                            <th>Nama {{ $title }}</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table body -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->

    </div>
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        var table = $('#dtx').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.wilayah.kelurahan.json', ['kemantren'=> request()->kemantren]) }}",
            dom: dt_dom,
            buttons: dt_button,
            initComplete: function(settings, json) {
                $(this).wrap(dt_wrap);
            },
            columns: [
                dt_index,
                {
                    data: 'desa_kode',
                    name: 'desa_kode'
                },
                {
                    data: 'desa',
                    name: 'desa'
                },
                dt_action
            ],
        });
    });
</script>
@endpush