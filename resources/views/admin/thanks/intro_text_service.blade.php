
@extends('layouts.app')

@section('content')
<style>
.w-45{
       width:45%;
}
.w-15{
       width:15%;
}
.ml-15{
    margin-left:15px;
}
</style>
  <div class="container-fuild ml-15">
    <div class="card">
    <div class="card-body">
    @php
        $service_id = 3;
    @endphp
    @if(isset($data->service) && $data->service == 'Laundry')
        @php
            $service_id = 1;
        @endphp
    @elseif(isset($data->service) && !empty($data->service))
        @if($data->service == 'Housekeeping')
            @php
                $service_id = 2;
            @endphp
        @endif
    @elseif(isset($data->service) && $data->service == 'Storage'))
       <?PHP 
            $service_id = 3;
       ?>
    @endif

   <form class="form-material" action="{{ route('thanks_service.update',['id'=> $service_id]) }}" method="post" enctype="multipart/form-data">

    {!! csrf_field() !!}

    {{-- <div class="form-group">
      <label for="name">Service:</label><br>
        <select class="form-control" required="" name="service">
            <option value="" disabled selected>Please select service</option>
            <option value="Laundry" @if(isset($data->service) && $data->service == 'Laundry'){{ 'selected' }}@endif >Laundry</option>
            <option value="Housekeeping" @if(isset($data->service) && $data->service == 'Housekeeping'){{ 'selected' }}@endif>Housekeeping</option>
            <option value="Storage" @if(isset($data->service) && $data->service == 'Storage'){{ 'selected' }}@endif>Storage</option>
        </select>
        <br>
        @if($errors->first('service'))
        <span class="text text-danger">* {{ $errors->first('service') }}</span>
        @endif
    </div>--}}



    <div class="form-group">
      <label for="name">Title:</label>
      <input type="text" class="form-control" id="title" autocomplete="off" placeholder="Enter title" name="title" required value="@if(isset($data->title)){{$data->title}}@endif">
    @if($errors->first('title'))
    <span class="text text-danger">* {{ $errors->first('title') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Description:</label>
      <textarea class="form-control" id="descriptions" autocomplete="off" placeholder="Enter Description" name="description" required>@if(isset($data->description)){{$data->description}}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>

    <div class="form-group">
      <label for="name">Image:</label><br>
      @if(isset($data->image))
        <img id="blah" src="{{ $data->image }}" alt="your image" width="150" height="150">
      @else
        <img id="blah" src="{{asset('images/preview-icon.png')}}" alt="your image" width="150" height="150">
      @endif
      <br><br>
      <input type="file" accept="image/*" class="form-control w-45" id="imgInp" name="upload_image">
      @if($errors->first('upload_image'))
      <span class="text text-danger">* {{ $errors->first('upload_image') }}</span>
      @endif
    </div>


    <input type="submit" class="btn btn-primary" value="submit">


</form>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
    <script>
        //$('textarea').ckeditor();

        $(document).ready(function () { 
                //$('textarea').ckeditor();
            tinymce.init({
            selector: 'textarea#description',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
           /* content_css:['../../../../public/fonts/VAG Rounded Regular.ttf'],
            font_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats;VAGRounded-Light=VAGRounded-Light;',*/
            content_css:['../../../../../public/fonts/VAGRound.ttf','../../../../../public/fonts/vag-bold.ttf'],
            font_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats;VAGRound=VAGRound;',
            link_list: [
                { title: 'My page 1', value: 'https://www.codexworld.com' },
                { title: 'My page 2', value: 'https://www.xwebtools.com' }
            ],
            image_list: [
                { title: 'My page 1', value: 'https://www.codexworld.com' },
                { title: 'My page 2', value: 'https://www.xwebtools.com' }
            ],
            image_class_list: [
                { title: 'None', value: '' },
                { title: 'Some class', value: 'class-name' }
            ],
            importcss_append: true,
            file_picker_callback: function (callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }
            
                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }
            
                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            templates: [
                { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
            });
        });

    </script>
    <script>

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

</script>
@endsection
