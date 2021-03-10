
<div class="modal fade zoom-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                <form action="" id="zoom-form">
                    <input type="hidden" name="id" id="">
                    <div class="form-group">
                        <label for="title">{{ __('main.Zoom Title') }}</label>
                        <input type="text" class="form-control form-control-sm title" name="title" value="">
                    </div>
                    <div class="form-group">
                        <label for="summary">{{ __('main.Zoom Summary') }}</label>
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
