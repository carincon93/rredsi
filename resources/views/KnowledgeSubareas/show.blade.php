<x-app-layout>
    <x-slot name="header">
      <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
        {{ __('knowledge subarea') }}
        <span class="sm:block text-purple-300">
          Show knowledge subarea info
        </span>
      </h2>
      <div>
        <a href="{{ route('knowledge-subareas.edit', $knowledgeSubarea->id) }}">
          <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
            {{ __('Edit knowledge subarea') }}
          </div>
        </a>
      </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex flex-wrap" id="tabs-id">
                    <div class="w-full">
                      <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-indigo-600" onclick="changeAtiveTab(event,'tab-profile')">
                            <i class="fas fa-space-shuttle text-base mr-1"></i>  knowledge subarea
                          </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-settings')">
                            <i class="fas fa-cog text-base mr-1"></i>  knowledge area
                          </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                          <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white" onclick="changeAtiveTab(event,'tab-options')">
                            <i class="fas fa-briefcase text-base mr-1"></i>  knowledge subarea diciplines
                          </a>
                        </li>
                      </ul>
                      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                        <div class="px-4 py-5 flex-auto">
                          <div class="tab-content tab-space">

                            <div class="block" id="tab-profile">

                                {{-- tab info knowledge subarea --}}
                                    <div>
                                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:grid md:grid-cols-3 md:gap-6">
                                            <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información del knowledge subarea </h3>
                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                <p>
                                                    {{ $knowledgeSubarea->name }}
                                                </p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>


                                        </div>
                                    </div>

                            </div>
                            <div class="hidden" id="tab-settings">

                                {{-- tab info knowledge area --}}
                                    <div>
                                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:grid md:grid-cols-3 md:gap-6">
                                            <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información del knowledge area</h3>
                                            </div>

                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                <p>
                                                    {{ $knowledgeSubarea->KnowledgeArea->name }}
                                                </p>
                                                </div>
                                            </div>
                                            </div>

                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>


                                        </div>
                                    </div>

                            </div>
                            <div class="hidden" id="tab-options">

                                {{-- tab info knowledge areas diciplines --}}
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                            <div class="md:col-span-1">
                                                <h3 class="text-lg font-medium text-gray-900">Información de <br> knowledge subarea diciplines</h3>
                                            </div>

                                                @foreach ($knowledgeSubarea->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)

                                                    <div class="md:grid md:grid-cols-3 md:gap-6">
                                                        <div class="md:col-span-1">

                                                        </div>
                                                        <div class="mt-5 md:mt-0 md:col-span-2">
                                                        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                            <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                            <p>
                                                                {{ $knowledgeSubareaDiscipline->name }}
                                                            </p>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="hidden sm:block">
                                                        <div class="py-8">
                                                            <div class="border-t border-gray-200"></div>
                                                        </div>
                                                    </div>

                                                @endforeach
                                    </div>
                                </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <script type="text/javascript">
                    function changeAtiveTab(event,tabID){
                      let element = event.target;
                      while(element.nodeName !== "A"){
                        element = element.parentNode;
                      }
                      ulElement = element.parentNode.parentNode;
                      aElements = ulElement.querySelectorAll("li > a");
                      tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
                      for(let i = 0 ; i < aElements.length; i++){
                        aElements[i].classList.remove("text-white");
                        aElements[i].classList.remove("bg-indigo-600");
                        aElements[i].classList.add("text-indigo-600");
                        aElements[i].classList.add("bg-white");
                        tabContents[i].classList.add("hidden");
                        tabContents[i].classList.remove("block");
                      }
                      element.classList.remove("text-indigo-600");
                      element.classList.remove("bg-white");
                      element.classList.add("text-white");
                      element.classList.add("bg-indigo-600");
                      document.getElementById(tabID).classList.remove("hidden");
                      document.getElementById(tabID).classList.add("block");
                    }
                  </script>

        </div>
    </div>
 </x-app-layout>



