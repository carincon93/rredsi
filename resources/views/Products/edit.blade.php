



<div class="mt-5 md:mt-0 md:col-span-2">

<form action="{{url('products/'.$product->id)}}" method="post" enctype="multipart/form-data" name="Actualizar">
@csrf 
{{method_field('PATCH')}}

@include('products.form',['modo'=>'Actualizar'])

</form>


</div>

