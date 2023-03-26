@extends('_template.master-main')

@section('page_title', 'Template Master')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">Daftar Template</h5>
                <a href="" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah Template
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dtx" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Template</th>
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
        </div>
        <!-- /.card -->

    </div>
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        // var table = $('#dtx').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: "",
        //     dom: dt_dom,
        //     buttons: dt_button,
        //     columns: [
        //         dt_index,
        //         {
        //             data: 'data',
        //             name: 'data'
        //         },
        //         dt_action
        //     ],
        // });
    });
</script>
@endpush