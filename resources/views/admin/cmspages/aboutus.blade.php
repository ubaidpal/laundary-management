
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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.css" integrity="sha256-G5PTdPgo4SQMURj4T5iUmc8SZE0yEaxMhmAVt/AWxnU=" crossorigin="anonymous" />

<div class="container-fuild ml-15" >
    <div class="card">
    <div class="card-body">

    @if(isset($data->id))
        <h2>Edit CMS Page</h2>
    @else
        <h2>Add CMS Page</h2>
    @endif

    @if(\Session::get('success'))
      <div class="alert alert-success hideClass" style="padding:5px;width:50%">
        {{ Session::get('success')  }}
      </div>
      @endif
      @if(Session::has('error'))
      <div class="alert alert-danger hideClass"  style="padding:5px;width:50%">
        {{ Session::get('error')  }}
      </div>
      @endif
      
    @if(isset($data->id))
        <form class="form-material" action="{{ route('cmspages.aboutusupdate',$data->id) }}" method="post">
    @else
        <form class="form-material" action="{{ route('cmspages.create') }}" method="post">
    @endif
    {!! csrf_field() !!}

    <div class="form-group">
      <label for="name">Url:</label>
      <input type="text" class="form-control " readonly="" id="url" autocomplete="off"  placeholder="Enter Url" name="url" value=@if(isset($data->url)){{ $data->url }}@else{{ old('url') }}@endif>
    @if($errors->first('url'))
    <span class="text text-danger">* {{ $errors->first('url') }}</span>
    @endif
    </div>
    @if((isset($data->id) && $data->id == 9) || (isset($data->id) && $data->id == 10) )
    <div class="form-group">
      <label for="name">Title:</label>
      <input type="text" class="form-control " readonly="" id="title" autocomplete="off"  placeholder="Enter Title" name="title" value="@if(isset($data->title)){{ $data->title }}@else{{ old('title') }}@endif">
    @if($errors->first('title'))
    <span class="text text-danger">* {{ $errors->first('title') }}</span>
    @endif
    </div>
    @else
       <!--  <div class="form-group">
          <label for="name">Title:</label>
          <input type="text" class="form-control " id="title" autocomplete="off"  placeholder="Enter Title" name="title" value="@if(isset($data->title)){{ $data->title }}@else{{ old('title') }}@endif">
        @if($errors->first('title'))
        <span class="text text-danger">* {{ $errors->first('title') }}</span>
        @endif
        </div> -->
    @endif
    <?php
    // $replace = [
    //     '&amp;' => '&', '&quot;' => '"', '&apos;' => "'", '&gt;' => '>', '&lt;' => '<', '&ldquo;' => '“', '&rdquo;' => '”'
    // ];
    ?>

    <div class="form-group">
      <label for="name">Description:</label>
      <textarea class="form-control" id="description" autocomplete="off" placeholder="Enter Description" name="description">@if(isset($data->description)){{$data->description}}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
    <a href="{{ route('cmspages.aboutus') }}" class="btn btn-default">Cancel</a>
  </form>
</div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){

          $("#url").keypress(function (e) {

            if($(this).val().length >= 15){
                return false;
            }

            if (e.which == 32 && e.which != 0 ) {
                alert('No Space Allowed');
                return false;
            }
        });



        })
        </script>


<!-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> -->
   <!--  <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
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
        // CKEDITOR.replace( 'description' );
        $(document).ready(function () {

            setTimeout(function(){  $(".hideClass").hide('slow'); },4000);

        //called when key is pressed in textbox
       /* $("#url").keypress(function (e) {
            alert('asdsa');
            if (e.which == 32 && e.which != 0 ) {
                alert('space');
            }
        }); */
        });

    </script>

@endsection
