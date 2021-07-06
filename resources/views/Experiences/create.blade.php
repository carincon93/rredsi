<div class="mt-5 md:mt-0 md:col-span-2">
<form action="{{url('experiences/')}}" method="post" enctype="multipart/form-data" name="Añadir">
@csrf 

@include('experiences.form',['modo'=>'Añadir'])

</form>
</div>


