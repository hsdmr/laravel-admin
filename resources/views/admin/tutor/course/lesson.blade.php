
<div class="modal fade lesson-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="model-title">
                    <h3>{{ __('main.Lesson Information') }}</h3>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="lesson-form">
                    <input type="hidden" name="lesson_id" id="">
                    <input type="hidden" name="topic_id" id="">
                    <input type="hidden" name="media_id" id="1">
                    <div class="form-group">
                        <label for="title">{{ __('main.Lesson Title') }}</label>
                        <input type="text" class="form-control form-control-sm title" name="title" value="">
                    </div>
                    <div class="form-group">
                        <label for="summary">{{ __('main.Lesson Summary') }}</label>
                        <textarea class="form-control form-control-sm summary" rows="3" name="content"></textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="summary">{{ __('main.Featured Image') }}</label>
                        <div class="col-md-9">
                            <img src="" alt="" id="media_img" class="w-100">
                            <div>
                                <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left" id="choose">{{ __('main.Choose Image') }}</a>
                                <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right" id="remove">{{ __('main.Remove Image') }}</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="video">{{ __('main.Video') }}</label>
                        <textarea class="form-control form-control-sm col-md-9" id="video" rows="3" name="video"></textarea>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3" for="total_time">{{ __('main.video playing time') }}</label>
                        <div class="row col-md-9">
                            <div class="col-md-2">
                                <input type="number" class="form-control form-control-sm" value="00" id="total_time" name="time[h]">
                                <small>{{ __('main.Hour') }}</small>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control form-control-sm" value="00" min="00" max="59" id="total_time" name="time[m]">
                                <small>{{ __('main.Minute') }}</small>
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control form-control-sm" value="00" min="00" max="59" id="total_time" name="time[s]">
                                <small>{{ __('main.Second') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mr-3">
                            <input type="checkbox" name="preview">
                            {{ __('main.Enable Course Preview') }}
                        </label>
                        <small>
                            {{ __('main.If checked, any users/guest can view this lesson without enroll course')}}</small>
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
    var val = {'request': $('#topic-form').serialize(),
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
            $('#model-tablo').html('');
            for (let index = 0; index < response.json.length; index++) {
                const element = response.json[index];
                $('#courses').append('');
            }
        },
        error: function(res){
            console.log(res);
        },
        complete: function(response){
        }
    });
}
</script>
