@foreach($files as $file)
    <tr>
        <td><input type="checkbox" name="item[]" class="item" value="{{$file->id}}"></td>
        <td>{{explode('\\' , $file->filename)[1]}}</td>
        <td>{{$file->type}}</td>
        <td>{{$file->size}}</td>
        <td>{{$file->size / 1024}}</td>
        <td><a href="#"><i class="fa fa-trash delete"></i></a></td>
    </tr>
@endforeach
