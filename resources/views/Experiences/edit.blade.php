



<div class="mt-5 md:mt-0 md:col-span-2">

<form action="{{url('experiences/'.$experience->id)}}" method="post" enctype="multipart/form-data" name="Actualizar">
@csrf 
{{method_field('PATCH')}}

@include('experiences.form',['modo'=>'Actualizar'])

</form>


</div>

