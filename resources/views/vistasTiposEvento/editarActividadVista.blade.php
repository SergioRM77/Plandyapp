<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">
<div class="crear actividad mx-2 px-2">
    <h4 class="border border-black bg-violet-400 pl-2">Editar Actividad</h4>
    <form action="{{e(route('update.actividad'))}}" class="border border-black rounded-md w-full mx-2 px-2" method="post">
        @csrf
        <input type="hidden" name="id_actividad" value="{{$actividad->id}}">
        <div class="grid">
            <label class="my-1 font-semibold">Nombre de actividad: 
                <input type="text" name="nombre_actividad" class="col-span-2 border border-blue-400 rounded-md my-2" value="{{$actividad->nombre_actividad ?? ''}}">
            </label>
            <label class="font-semibold">Coste individual: 
                <input type="number" name="coste" class="col-span-2 border border-blue-400 rounded-md my-2" value="{{$actividad->coste ?? ''}}" step="any">
            </label>
            <label class=" font-semibold">Fecha inicio:
                <input class="border border-blue-400 rounded-md my-2" type="date" name="fecha" value="{{$actividad->fecha ?? ''}}">
                @error('fecha') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Hora inicio:
                <input class="border border-blue-400 rounded-md my-2" type="time" name="hora" value="{{$actividad->hora ?? ''}}">
                @error('hora') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Descripcion: </label>
        </div>
        <textarea name="descripcion_actividad" id="" cols="30" rows="3" class="col-span-2 border border-blue-400 rounded-md my-2">{{$actividad->descripcion_actividad ?? ''}}</textarea>
        <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit">Actualizar Actividad</button>
    </form>
</div>
</x-layouts.base>