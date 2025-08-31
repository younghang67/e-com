@props(['name','type'=>'text','oldvalue'=>null,'label','title'])
<div class="mt-4 mb-2 form-group">
    <div class="mb-2">{{$title}}</div>

    <input type="{{ $type }}"  name="{{ $name}}" id="{{$name}}" value="{{old($name,$oldvalue)}}" class="form-check-input" />
    <label for="{{$name}}" class="form-check-label">{{$label}}</label>
    @if($errors->has($name))
    <span class="text-danger text-small">{{$errors->first( $name) }}</span>
    <span class="help-block text-danger"><small>{{$errors->first( $name) }}</small></span>

    @endif
</div>
