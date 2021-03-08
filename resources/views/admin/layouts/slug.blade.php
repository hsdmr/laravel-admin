@php
    if(isset($article)){
        $seo_title = $article->getSlug->seo_title;
        $seo_description = $article->getSlug->seo_description;
        $no_index = $article->getSlug->no_index;
        $no_follow = $article->getSlug->no_follow;
    }
    else if(isset($page)){
        $seo_title = $page->getSlug->seo_title;
        $seo_description = $page->getSlug->seo_description;
        $no_index = $page->getSlug->no_index;
        $no_follow = $page->getSlug->no_follow;
    }
    else if(isset($category)){
        $seo_title = $category->getSlug->seo_title;
        $seo_description = $category->getSlug->seo_description;
        $no_index = $category->getSlug->no_index;
        $no_follow = $category->getSlug->no_follow;
    }
    else{
        $seo_title = '';
        $seo_description = '';
        $no_index = 0;
        $no_follow = 0;
    }
@endphp
<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="seo_title">{{ __('main.Seo Title') }}</label>
            <div class="input-group">
                <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{$seo_title}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="seotit">0</span>
                </div>
              </div>
        </div>
        <div class="form-group">
            <label for="seo_description">{{ __('main.Seo Description') }}</label>
            <div class="input-group">
                <textarea class="form-control form-control-sm" rows="3" id="seo_description" name="seo_description">{{$seo_description}}</textarea>
                <div class="input-group-append">
                    <span class="input-group-text" id="seodes">0</span>
                </div>
              </div>
        </div>
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" @if ($no_index==1) checked @endif id="no_index" name="no_index">
            <label for="no_index" class="custom-control-label">{{ __('main.Seo No Index') }}</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" @if ($no_follow==1) checked @endif id="no_follow" name="no_follow">
            <label for="no_follow" class="custom-control-label">{{ __('main.Seo No Follow') }}</label>
        </div>
    </div>
</div>
