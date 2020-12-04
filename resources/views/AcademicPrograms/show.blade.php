<x-app-layout>
<x-slot name="header">
    <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
        {{__('Academic Programs')}}
        <span class="sm:block text-purple-300">
            Show academic program info
        </span> 
    </h2>
    <div>
        <a href="{{route('nodes.update', [$academicProgram])}}">
            <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{__('Edit academic program')}}
            </div>
        </a>
    </div>
</x-slot>
<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium text-gray-900">Información de programas academicos <span class="text-capitalize">{{ $node->state }}</span></h3>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                       <p>
                        {{ $academicProgram->name }}
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

  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
        <h3 class="text-lg font-medium text-gray-900">{{ __('code') }}</h3>
        <div class="mt-3 max-w-xl text-sm text-gray-600">
          <p>
            {{ $academicProgram->code }}
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

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">

            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('academic level') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->academic_level}}
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

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:clo-span-1">

            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{__('modality')}}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{$academicProgram->modality}}
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

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">

            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{__('daytime')}}</h3>
                    <div class="mt-3 max-w-xl text-gray-600">
                        <p>
                            {{$academicProgram->daytime}}
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
    
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
              
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('educational institution id') }}</h3>
                <div class="mt-3 max-w-xl text-sm text-gray-600">
                  <p>
                    {{ $academicProgram->educational_institution_id }}
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
    
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
              
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('start date') }}</h3>
                <div class="mt-3 max-w-xl text-sm text-gray-600">
                  <p>
                    {{ $academicProgram->start_date }}
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
    
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
              
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">{{ __('end date') }}</h3>
                <div class="mt-3 max-w-xl text-sm text-gray-600">
                  <p>
                    {{ $academicProgram->end_date }}
                  </p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</x-app-layout>