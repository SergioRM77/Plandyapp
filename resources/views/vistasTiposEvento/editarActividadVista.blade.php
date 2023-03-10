<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">
<h2>Editar Actividad</h2>
<div class="crear actividad mx-2 px-2">
    <h4 class="border border-black bg-violet-400 pl-2">CREAR ACTIVIDAD:</h4>
    <form action="{{e(route('add.actividad'))}}" class="border border-black rounded-md w-full mx-2 px-2" method="post">
        @csrf
        <div class="grid">
            <label class="my-1 font-semibold">Nombre de actividad: 
                <input type="text" name="nombre_actividad" class="col-span-2 border border-blue-400 rounded-md my-2">
            </label>
            <label class="font-semibold">Coste individual: 
                <input type="number" name="coste" class="col-span-2 border border-blue-400 rounded-md my-2" value="0" step="any">
            </label>
            <label class=" font-semibold">Fecha inicio:
                <input class="border border-blue-400 rounded-md my-2" type="date" name="fecha">
                @error('fecha') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Hora inicio:
                <input class="border border-blue-400 rounded-md my-2" type="time" name="hora">
                @error('hora') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Descripcion: </label>
        </div>
        <textarea name="descripcion_actividad" id="" cols="30" rows="3" class="col-span-2 border border-blue-400 rounded-md my-2"></textarea>
        <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit">Crear Actividad</button>
    </form>
</div>
</x-layouts.base>