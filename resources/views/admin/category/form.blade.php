<form action="{{ isset($category) ? route('categories.update', [ 'category' => $category->id]) : route('categories.store') }}" method="post">
    @csrf
    @if (isset($category))
        @method('put')    
    @endif
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @if (count($errors) > 0) 
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>{{ trans('category.errorAlert') }}</strong>
                    <br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">@lang('category.cateName')</label>
                <input type="text" class="form-control" placeholder="{{ trans('category.cateName') }}" value="{{ isset($category) ? $category->name : '' }}" name="name" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">@lang('category.cateType')</label>
                <select class="form-control" name="parent_id">
                        <option value='0' selected>@lang('category.cateParent')</option>
                    @if (isset($categoriesParent))
                        @foreach ($categoriesParent as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        <div>
            <button type="submit" class="btn btn-success"> @lang('category.saveBtn')</button>
        </div>
    </div>
</form>

