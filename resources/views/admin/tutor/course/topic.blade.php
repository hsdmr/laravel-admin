
<div class="modal fade" id="topic-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="model-title">
                    <h3>{{ __('main.Topic Information') }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="topic-form">
                    <input type="hidden" name="lesson_id" id="topicIdModal">
                    <input type="hidden" name="course_id" id="courseIdModal">
                    <div class="form-group">
                        <label for="title">{{ __('main.Topic Title') }}</label>
                        <input type="text" class="form-control form-control-sm title" name="title" value="">
                    </div>
                    <div class="form-group">
                        <label for="summary">{{ __('main.Topic Summary') }}</label>
                        <textarea class="form-control form-control-sm summary" rows="3" name="content"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javaScript:void(0)" onclick="ajaxpost()" class="btn btn-success text-center btn-sm float-right">{{ __('main.Save') }}</a>
            </div>
        </div>
    </div>
</div>

<script>

function ajaxpost(e){
    var val = {'course_id': $('#courseIdModal').val(),
               'lesson_id': $('#topicIdModal').val(),
               'title': $('#topic-form .title').val(),
               'content': $('#topic-form .summary').val(),
               'select': 'topic' };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        dataType: "json",
        type: "POST",
        url: '{{ route("ajax") }}',
        data: val,
        beforeSend: function(){
        },
        success: function(response){
            //console.log(response);
            //console.log(response.course_id);
            //console.log(response.json[0].id);
            if(response.is_edit){
                $('#heading'+response.json[0].id+' button').html(response.json[0].title);
            }
            else{
                var course_id = response.course_id;
                var topic = response.json[0];
                $('#accordionExample'+course_id+' .topicWillAdd').append('<div class="card"><div class="card-header p-0" id="heading'+topic.id+'"><button class="btn btn-link w-75 text-left" type="button" data-toggle="collapse" data-target="#collapseTopic'+topic.id+'" aria-expanded="true" aria-controls="collapseTopic'+topic.id+'">'+topic.title+'</button><span class="float-right p-2"><a href="javascript:void(0)" data-courseId="'+course_id+'" data-topicId="'+topic.id+'" title="{{ __("main.Edit") }}" class="mr-1 btn btn-primary btn-xs topic-modal"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" data-topicId="'+topic.id+'" onclick="deleteTopic('+topic.id+')" title="{{ __("main.Delete") }}" class="btn btn-danger btn-xs"><i class="far fa-times-circle"></i></a></span></div><div id="collapseTopic'+topic.id+'" class="collapse show" aria-labelledby="heading'+topic.id+'" data-parent="#accordionExample'+course_id+'"><div class="card-body"><div class="lessonWillAdd"></div><a href="/admin/tutor/course/'+course_id+'/topic/'+topic.id+'" class="mr-1 btn-primary btn-sm topic-modal">{{ __("main.Add New Lesson") }}</a><a href="/admin/tutor/course/'+course_id+'/topic/'+topic.id+'/zoom" class="btn-primary btn-sm topic-modal">{{ __("main.Zoom") }}</a></div></div></div>');
            }
            $('#topic-modal').modal('hide');
        },
        error: function(response){
            console.log(response);
        },
        complete: function(response){
        }
    });
}

function editTopic(e){
    var val = {'topic_id': e,
               'select': 'topic-edit' };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        dataType: "json",
        type: "POST",
        url: '{{ route("ajax") }}',
        data: val,
        beforeSend: function(){
        },
        success: function(response){
            console.log(response.topic_id);
            $('#courseIdModal').val(response.json[0].course_id);
            $('#topicIdModal').val(response.topic_id);
            $('#topic-modal .title').val(response.json[0].title);
            $('#topic-modal .summary').val(response.json[0].content);
            $('#topic-modal').modal('show');
        },
        error: function(response){
            console.log(response);
        },
        complete: function(response){
        }
    });
}

function deleteTopic(e){
    var val = {'topic_id': e,
               'select': 'topic-delete' };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        dataType: "json",
        type: "POST",
        url: '{{ route("ajax") }}',
        data: val,
        beforeSend: function(){
        },
        success: function(response){
            console.log(response.topic_id);
            $('#heading'+response.topic_id).parent().remove();
        },
        error: function(response){
            console.log(response);
        },
        complete: function(response){
        }
    });
}
</script>


