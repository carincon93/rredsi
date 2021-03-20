<div class="alert-toast right-0 m-8 border-0 rounded mb-4 w-500 fixed bottom-0">
    <input type="checkbox" class="hidden" id="footeralert">

    <div class="flex items-center justify-between w-full p-2 px-6 py-4 bg-blue-900 shadow text-white">
        <span class="inline-block align-middle mr-8">
            {{--  imprimimos el mensaje que llega del controlador --}}
            <p> {{ __(session('status')) }}</p>
        </span>

        <label class="close cursor-pointer" title="close" for="footeralert">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
        </label>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener(
            "DOMContentLoaded",
            function() {
                // ! el evento se repite indefinidamente para verificar en todo momento si existe una session status que mostrar
                /* ! se demora unos segundos y lo cierra automaticamento este evento solo se muestra una vez al validar el evento
                */
                var cont = 0;
                var input = document.getElementById('footeralert');

                var id = setInterval(function(){
                    cont++;
                    if(cont == 10)
                    {
                        input.setAttribute('checked','checked');
                        clearInterval(id);
                    }
                }, 1000);

                function closeAlert(event){
                    let element = event.target;

                }
            }, false
        )
    </script>
@endpush

