
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
        url: '{{ route('ajax') }}',
        data: val,
        beforeSend: function(){
        },
        success: function(response){
            console.log(response.course_id);
        },
        error: function(response){
            console.log(response);
        },
        complete: function(response){
        }
    });
}
</script>

