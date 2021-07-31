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
                    <th>Updated At</th>
                    <th>Filename</th>
                    <th>Preview</th>
                    <th>Size</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($images as $image)
                    @php
                        /** @var \Symfony\Component\Finder\SplFileInfo $image */
                        $dataForJson = ['name' => $image->getFilename(), 'url' => image_url($image)];
                    @endphp
                    <tr>
                        <td>{{ date('Y-m-d H:i:s', $image->getATime()) }}</td>
                        <td>{{ $image->getFilename() }}</td>
                        <td><img src="{{ image_url($image) }}" height="200" alt=""></td>
                        <td>{{ number_format(ceil($image->getSize() / 1024)) }} KB</td>
                        <td>
                            <button type="button" class="btn btn-primary lb-open-update-modal" data-image='@json($dataForJson)'>Update</button>
                            <form action="{{ route('admin.article_image.delete') }}" method="post">
                                @csrf
                                <input type="hidden" name="filename" value="{{ $image->getFilename() }}" />
                                <input type="submit" class="btn btn-danger" value="Delete" />
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
                <form action="{{ route('admin.article_image.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="filename"/>
                    <div class="modal-header">
                        <h4 class="modal-title"><span class="lb-modal-new"></span><span class="lb-modal-edit"></span> Update Image</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="callout callout-warning">
                            <h5>Old Image</h5>
                            <img id="lb-modal-old-img" class="img-fluid" alt="" src="">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" id="lb-form-file">
                                    <label class="custom-file-label" for="lb-form-file">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('content-script')
    <script>
        const lbScript = {
            openEditModal: function(image) {
                let $target = $('#lb-modal-save');
                $("#lb-modal-old-img").attr('src', image.url);
                $target.find("input[name=filename]").val(image.name);
                $target.modal();
            },
        };

        $(function() {
            $('#lb-table').dataTable({
                "order": [[0, "desc"]]
            });
            $('.lb-open-update-modal').click(function() {
                lbScript.openEditModal($(this).data('image'));
            });
        });
    </script>
@endsection
