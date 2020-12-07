<div class="overlay-back" style="display: none"></div>
<div class="choose-panel" style="display: none">
    <div class="row m-0">
        <div class="col-sm-9 p-0">
            <div class="card-header">
                <a href="javascript:void(0)" class="btn btn-danger btn-xs float-right" style="opacity: 0"><i class="far fa-times-circle"></i></a>
            </div>
            <div class="infinite-scroll" style="overflow:auto; height:80vh">
                <div class="scroll-content">
                @foreach ($medias as $media)
                @php
                    $id = $media->id;
                    $media = $media->getMedia()->first();
                @endphp
                @if ($id!=1)
                    <div class="thumbnail">
                        <a href="javascript:void(0);">
                            <img id="{{ $id }}" src="{{ $media->getUrl('thumb') }}" data-url="{{ $media->getUrl() }}" alt="{{$media->alt}}" data-title="{{$media->name}}">
                        </a>
                    </div>
                @endif
                @endforeach
                {{ $medias->links() }}
                </div>
            </div>
        </div>
        <div class="col-sm-3 p-0" style="background-color: whitesmoke;">
            <div class="card-header">
                <a id="close" href="javascript:void(0)" class="btn btn-danger btn-xs float-right"><i class="far fa-times-circle"></i></a>
            </div>
            <div class="card-body">
                <div style="overflow: auto">
                <img src="" alt="" id="onizleme">
                <form action="" method="post" id="form_img">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="value">
                    <input type="hidden" value="" id="media" name="media">
                    <input type="hidden" value="form_img" name="form_img">
                    <div class="form-group">
                        <label for="media_title">{{ __('Name') }}</label>
                        <input type="text" class="form-control form-control-sm" value="" id="media_title" name="media_title">
                    </div>
                    <div class="form-group">
                        <label for="media_alt">{{ __('Alt Tag') }}</label>
                        <input type="text" class="form-control form-control-sm" value="" id="media_alt" name="media_alt">
                    </div>
                    <div class="form-group">
                        <label for="media_url">{{ __('Url') }}</label>
                        <input type="text" class="form-control form-control-sm" value="" id="media_url" name="media_url" disabled>
                    </div>
                </form>
                <a href="javascript:void(0);" class="btn btn-primary btn-xs" style="bottom: 0;" id="submit_img">{{ __('Update') }}</a>
                <a href="javascript:void(0);" class="btn btn-success btn-xs float-right" style="bottom: 0;" id="add">{{ __('Choose Image') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
