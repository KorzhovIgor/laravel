@props(['options', 'name', 'id', 'oldValue'])
<select class="form-select" aria-label="Default select example" id="{{$id}}" name="{{$name}}">
    <option value="" selected>Not selected</option>
    @foreach($options as $option)
        <option @selected($oldValue == $option->value) value="{{$option->value}}">
            {{$option->value}}
        </option>
    @endforeach
</select>
