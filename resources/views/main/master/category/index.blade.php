@extends('_template.master-main')

@section('page_title', 'Kategori Menara Master')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">Daftar Kategori Menara</h5>
                <a href="{{ route('master.category.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i>Tambah Kategori Menara
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dtx" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori Menara</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
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
        var table = $('#dtx').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.category.json') }}",
            dom: dt_dom,
            buttons: dt_button,
            columns: [
                dt_index,
                {
                    data: 'category',
                    name: 'category'
                },
                dt_action
            ],
        });
    });
</script>
@endpush