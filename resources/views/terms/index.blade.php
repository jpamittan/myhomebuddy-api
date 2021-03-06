@extends('layouts.master')

@push('css')
    <style>
        #consumers > form > div > div > div.tox-statusbar > div.tox-statusbar__text-container > span > a {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5 mb-5">
        <h4>Terms and Conditions</h4>
        <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="consumers-tab" data-bs-toggle="tab" data-bs-target="#consumers" type="button" role="tab" aria-controls="consumers" aria-selected="true">
                    <i class="far fa-user"></i> Consumers
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sellers-tab" data-bs-toggle="tab" data-bs-target="#sellers" type="button" role="tab" aria-controls="sellers" aria-selected="false">
                    <i class="fas fa-user-tie"></i> Sellers
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="consumers" role="tabpanel" aria-labelledby="consumers-tab">
                <form class="mt-3" action="{{ route('terms.update', ['term' => $consumerTerm->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="editor" name="content">
                            {!! $consumerTerm->content !!}
                        </textarea>
                    </div>
                    <input class="btn btn-primary mt-3" type="submit" value="Save" />
                </form>
            </div>
            <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">
                <form class="mt-3" action="{{ route('terms.update', ['term' => $sellerTerm->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="editor" name="content">
                            {!! $sellerTerm->content !!}
                        </textarea>
                    </div>
                    <input class="btn btn-primary mt-3" type="submit" value="Save" />
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/cqg3dvm27bgf3janjvprnihb37w1f0f2hnj6rowyajr5ytlv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.editor',
            menubar: false,
            statusbar: false,
            plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
            skin: 'bootstrap',
            toolbar_drawer: 'floating',
            min_height: 800,
            autoresize_bottom_margin: 16,
            setup: (editor) => {
                editor.on('init', () => {
                    editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                });
                editor.on('focus', () => {
                    editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                    editor.getContainer().style.borderColor="#80bdff"
                });
                editor.on('blur', () => {
                    editor.getContainer().style.boxShadow="",
                    editor.getContainer().style.borderColor=""
                });
            }
        });
    </script>
@endpush
