<x-layouts.base titulo="Inicio" metaDescription="Inicio de Plandyapp">
    <h2>Form subida</h2>
    <div class="shrink">
        <img class="h-32 w-full object-cover rounded-md md:h-full md:w-48" src="images/foo.jpg" alt="Foto de evento">
    </div>
    <form action="{{route("guardar.foto")}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" src="" alt="imagen subida" name="foto" accept="image/*">
        <button type="submit">Subir imagen</button>
    </form>
</x-layouts.base>
