@extends('admin._share.layout')

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Upload Image</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.article_image.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="lb-form-file">
                            <label class="custom-file-label" for="lb-form-file">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Upload</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Article Image List</h3>
        </div>
        <div class="card-body">
            <table id="lb-table" class="table table-bordered">
                <thead>
                <tr>
                    <th>Filename</th>
                    <th>Preview</th>
                    <th>Size</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($images as $image)
                    @php /** @var \Symfony\Component\Finder\SplFileInfo $image */ @endphp
                    <tr>
                        <td>{{ $image->getFilename() }}</td>
                        <td><img src="{{ image_url($image) }}" height="200"></td>
                        <td>{{ number_format(ceil($image->getSize() / 1024)) }} KB</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('content-script')
    <script>
        const lbScript = {
            openEditModal: function(category) {
                let $target = $('#lb-modal-save');
                let $categoryId = $target.find('input[name=category_id]');
                const id = category.id || 0;
                $categoryId.val(id);
                $target.find('input[name=name]').val(category.name || '');
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
