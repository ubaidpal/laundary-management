
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

   <form class="form-material" action="{{ route('thanks.serviceupdate',2) }}" method="post" enctype="multipart/form-data">

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
      <label for="name">Text:</label>
      <textarea class="form-control" id="description" autocomplete="off" placeholder="Enter Description" name="description" required>@if(isset($data->text)){{$data->text}}@endif</textarea>
    @if($errors->first('description'))
    <span class="text text-danger">* {{ $errors->first('description') }}</span>
    @endif
    </div>


    <div class="mainDiv">

        <?php $time = json_decode($data->time); $j=0; ?>

        @foreach ($time as $item)

            <div id="subDivid_{{ $j }}"  class="subDiv_{{ $j }}" style="display: flex; margin: 5px;">

            <div class="form-group col-md-2">
            <label for="name">Day:</label>
            <input type="text" name="input[{{$j}}][day]" value="{{ $item->name }}" style="width: 100%;"/>
            </div>

            <div class="form-group col-md-2">
            <label for="name">Morning Start time:</label>
            <input type="time" onblur="morningEndTime({{ $j }})" id="morning_start_time_{{ $j }}" class="m_s_t_t" name="input[{{$j}}][m_s_t]" value="{{ $item->m_s_t }}" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Morning End time:</label>
            <input type="time" class="m_e_t_t" id="morning_end_time_{{ $j }}" name="input[{{$j}}][m_e_t]" value="{{ $item->m_e_t }}" style="width: 100%;"  />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Evening Start time:</label>
            <input type="time" onblur="eveningEndTime({{ $j }})" id="evening_start_time_{{ $j }}" name="input[{{$j}}][e_s_t]" value="{{ $item->e_s_t }}" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Evening End time:</label>
            <input type="time" id="evening_end_time_{{ $j }}" name="input[{{$j}}][e_e_t]" value="{{ $item->e_e_t }}" style="width: 100%;"  />
            </div>

            <div class="form-group col-md-1">
            <label for="name">Image:</label>
            <input type="file" name="input[{{$j}}][image]" style="width: 100%;"  />
            <input type="hidden" name="input[{{$j}}][image_text]" value="{{ $item->image }}" style="width: 100%;"  />

            </div>

            <br>
            @if($j == 0)
                <button class="btn btn-info addDiv"  onclick="return false" style="padding: 0px 10px;    margin-left: 40px;"> Add </button>
            @else
                <button class="btn btn-info removeDiv" data-divid="subDiv_{{ $j }}"   onclick="return false" style="padding: 0px 10px"> Remove </button>
            @endif

            <?php $j++; ?>
        </div>

        @endforeach

    </div>

<input type="submit" class="btn btn-primary" value="submit">


</form>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>


<script>
   // $('textarea').ckeditor();

var variable = "{{count($time)}}" ;

    if (variable > 0) {
        var count = variable;
    }else{

        var count = 0;
    }
    $('.addDiv').click(function(){
        var rowid = count++;
        $('.mainDiv').append(`

            <div    class="subDiv_${variable}" style="display: flex;  margin: 5px;">

            <div class="form-group col-md-2">
            <label for="name">Day:</label>
            <input type="text" class="" id="" name="input[${variable}][day]" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Morning Start time:</label>
            <input type="time" class="m_s_t_t" id=morning_start_time_`+rowid+` onblur="morningEndTime(`+rowid+`)" name="input[${variable}][m_s_t]" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Morning End time:</label>
            <input type="time" class="m_e_t_t" id=morning_end_time_`+rowid+` name="input[${variable}][m_e_t]" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Evening Start time:</label>
            <input type="time" id=evening_start_time_`+rowid+` onblur="eveningEndTime(`+rowid+`)" name="input[${variable}][e_s_t]" style="width: 100%;" />
            </div>

            <div class="form-group col-md-2">
            <label for="name">Evening End time:</label>
            <input type="time" id=evening_end_time_`+rowid+` name="input[${variable}][e_e_t]" style="width: 100%;" />
            </div>

            <div class="form-group col-md-1">
            <label for="name">Image:</label>
            <input type="file" name="input[${variable}][image]" style="width: 100%;"  />
            <input type="hidden" name="input[${variable}][image_text]" value="" style="width: 100%;"  />
            </div>

            <button class="btn btn-info removeDiv" data-divid="subDiv_${variable}"   onclick="return false" style="padding: 0px 10px" > Remove </button>

            </div>

        `)

            $('.removeDiv').click(function(){
              var selector = $(this).parent('div');
                $(selector).remove()
            })

    })

    $('.removeDiv').click(function(){
        var selector = '.' + $(this).data('divid');
        $(selector).remove()
    })


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.0/tinymce.min.js"></script>
    <script>

    function morningEndTime(id){ 
       if($("#morning_end_time_"+id).val() == ""){
            // alert("Please enter morning end time");
            $("#morning_end_time_"+id).prop('required',true);
       } 
    }

    function eveningEndTime(id){ 
       if($("#evening_end_time_"+id).val() == ""){
            // alert("Please enter evening end time");
            $("#evening_end_time_"+id).prop('required',true);
       } 
    }
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
    

    $( "#button" ).click(function() {
        $( ".target" ).change();
    });

     
    $(".m_s_t_t").blur(function(){

        //$(this).blur(function(){
             /*jass = getid();
             alert(jass)
            if($('.m_e_t_t').val() == ""){
                alert("Sucecess")
                return false;
            }else{
                //alert("FAiled")
                $('#'+jass).text('Enter value');
                return false;
            }*/
        //});
        
    });
    </script>
@endsection