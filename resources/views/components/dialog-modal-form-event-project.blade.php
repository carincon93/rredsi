@props(['eventId' => null, 'projects'=> null])

@push('styles')
<style>
    .modal {
      transition: opacity 0.25s ease;
    }
    body.modal-active {
      overflow: hidden;
    }
</style>
@endpush

<!--Modal-->
<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
            <div>
                <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="inline font-bold text-gray-700 text-lg ml-0 pl-0">Information</span>
            </div>
            <div class="modal-close cursor-pointer z-50">
                <svg class="h-5 w-6 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!--Body-->
        <form method="POST" action="{{ route('notifications.sendProjectToEvent') }}" id="form-event-project">
            @csrf()

            <div class="px-5 py-2 text-gray-600">
                Seleccione de nuevo el proyecto con el cual desea participar y envie su solicitud.
            </div>

            {{-- Guardo en un input el id del evento al caul desea registrarse--}}
            <input hidden id="event_id" name="event_id" value="{{$eventId}}">

            <select id="project_id" name="project_id" class="form-select w-full" required >
                <option value="">Seleccione un proyecto</option>
                {{-- Recorro los projectos de el usuario--}}
                @forelse ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->title }}</option>
                @empty
                    <option value="">{{ __('No data recorded') }}</option>
                @endforelse
            </select>
        </form>

        <!--Footer-->
        <div class="flex justify-end pt-2">
            <button type="submit" class="px-4 bg-transparent p-3 rounded-lg text-white bg-blue-900 hover:bg-blue-800 mr-2" form="form-event-project">Enviar solicitud</button>
            <button class="modal-close px-4 bg-white p-3 rounded-lg text-blue-900 hover:text-gray-500">Close</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener('click', function(event){
    	    event.preventDefault()
    	    toggleModal()
        })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
        closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
    	    isEscape = (evt.key === "Escape" || evt.key === "Esc")
        } else {
    	    isEscape = (evt.keyCode === 27)
        }
        if (isEscape && document.body.classList.contains('modal-active')) {
    	    toggleModal()
        }
    }

    function toggleModal () {
        const body = document.querySelector('body')
        const modal = document.querySelector('.modal')
        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
        body.classList.toggle('modal-active')
    }
</script>
@endpush
