<div @click.away="open = false" class="flex relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 border-0 text-sm font-semibold text-left bg-transparent rounded-lg outline-none">
        <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="compass" class="svg-inline--fa fa-compass fa-w-16 mr-1/12 ml-1 text-black" style="width: 18px;" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M347.94 129.86L203.6 195.83a31.938 31.938 0 0 0-15.77 15.77l-65.97 144.34c-7.61 16.65 9.54 33.81 26.2 26.2l144.34-65.97a31.938 31.938 0 0 0 15.77-15.77l65.97-144.34c7.61-16.66-9.54-33.81-26.2-26.2zm-77.36 148.72c-12.47 12.47-32.69 12.47-45.16 0-12.47-12.47-12.47-32.69 0-45.16 12.47-12.47 32.69-12.47 45.16 0 12.47 12.47 12.47 32.69 0 45.16zM248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm0 448c-110.28 0-200-89.72-200-200S137.72 56 248 56s200 89.72 200 200-89.72 200-200 200z"></path></svg>
        <span>{{ __('Explorer') }}</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-auto top-10/12 left-0 origin-top-right rounded-md shadow-lg z-10">
        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800" id="nodeSelect"></div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            // ? traemos de la api todos los nodos y agregamos cada ruta explorer al dropdown de explorer
            getAllNodesExplorer = async () =>{
                const nodesSelect = document.getElementById('nodeSelect');

                try {
                    const uri       = `/api/nodes`;
                    const response  = await fetch(uri);
                    const result    = await response.json();

                    result.nodes.map(function(node) {
                        let option = `<a href="/nodes/${node.id}/explorer" class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">${node.state}</a> <div class="border-t border-gray-100"></div>`;
                        nodesSelect.innerHTML += option;
                    })
                } catch (error) {
                    console.log(error);
                }
            }
            getAllNodesExplorer();
        </script>
    @endpush
@endonce
