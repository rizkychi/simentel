@extends('_template.master-main')

@section('page_title', 'Menu Master')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">Daftar Menu</h5>
                <a href="{{ route('master.menu.show.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Menu
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm dt-menu">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 20; $i++) <tr>
                            <td>1</td>
                            <td>Home</td>
                            <td>Aksi</td>
                            </tr>
                            @endfor
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
        var table = $('.dt-menu').DataTable({
            // processing: true,
            // serverSide: true,
            // ajax: "{{ route('master.menu.json') }}",
            // columns: [{
            //         data: 'DT_RowIndex',
            //         name: 'DT_RowIndex'
            //     },
            //     {
            //         data: 'nama_jabatan',
            //         name: 'nama_jabatan'
            //     },
            //     {
            //         data: 'action',
            //         name: 'action',
            //         orderable: false,
            //         searchable: false
            //     },
            // ],
            dom: dt_dom,
            buttons: dt_button
        });
    });
</script>
@endpush