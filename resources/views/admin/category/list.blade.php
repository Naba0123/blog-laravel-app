@extends('admin._share.layout')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Category List</h3>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-2 lb-open-edit-modal" data-category="{}">
                New Category
            </button>
            <table id="lb-table" class="table table-bordered">
                <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Associated Article Count</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->articles->count() }}</td>
                        <td>
                            <button class="btn btn-primary lb-open-edit-modal" data-category='@json($category)'>Edit</button>
                            <form action="{{ route('admin.category.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="category_id" value="{{ $category->id }}"/>
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="lb-modal-save" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.category.save') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="lb-modal-new"></span><span class="lb-modal-edit"></span> Article</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group lb-modal-edit">
                            <label for="lb-form-id">ID</label>
                            <input type="number" class="form-control" id="lb-form-id" name="category_id" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lb-form-name">Name</label>
                            <input type="text" class="form-control" id="lb-form-name" placeholder="Category Name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        const lbScript = {
            openEditModal: function(category) {
                let $target = $('#lb-modal-save');
                let $categoryId = $target.find('input[name=category_id]');
                const id = category ? category.id : 0;
                $categoryId.val(id);
                if (id > 0) {
                    $categoryId.parent().show();
                } else {
                    $categoryId.parent().hide();
                }
                $target.find('input[name=name]').val(category ? category.name : '');
                $target.modal();
            },
        };

        $(function() {
            $('#lb-table').dataTable();
            $('.lb-open-edit-modal').click(function() {
                lbScript.openEditModal($(this).data('category'));
            });
        });
    </script>
@endsection
