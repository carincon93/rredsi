@can('create_product')
<div class="mt-5 md:mt-0 md:col-span-2">
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" name="Añadir">
@csrf
@include('products.form',['modo'=>'Añadir'])
</form>
</div>
@endcan