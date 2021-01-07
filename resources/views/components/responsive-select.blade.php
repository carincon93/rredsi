    @props(['selectName'=> null])

    <input class="hidden" id="id_name" value="{{$selectName}}">

    @once
        @push('scripts')
            <script>
                var id_name = document.getElementById('id_name');
                    setInterval(() => {
                        if(screen.width < 700){
                            const mobil = document.getElementById(id_name.value);
                            mobil.setAttribute('onfocus','this.size=6');
                            mobil.setAttribute('onblur','this.size=1');
                            mobil.setAttribute('onchange','this.size=1; this.blur()');
                            mobil.classList.remove('form-select');

                        }else if(screen.width > 700){
                            const mobil = document.getElementById(id_name.value);
                            mobil.removeAttribute('onfocus','this.size=6');
                            mobil.removeAttribute('onblur','this.size=1');
                            mobil.removeAttribute('onchange','this.size=1; this.blur()');
                            mobil.classList.add('form-select');
                        }
                    }, 1000);


            </script>
        @endpush
    @endonce
