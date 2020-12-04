<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{__('Projects')}}
            <span class="sm:block text-purple-300">
                Show project info
            </span>
        </h2>
        <div>
            <a href="{{route('nodes.uodate', [$project])}}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{__('Edit project')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium text-gray-900">Informacion de proyectos</h3>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{__('title')}}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{$project->title}}
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
                        {{ $project->start_date }}
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
                        {{ $project->end_date }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('type') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->type }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('abstract') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->abstract }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('keywords') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->keywords }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('file') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->file }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('overall_objetive') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->overall_objetive }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('is privated') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->is_privated?'Si':'No' }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('is published') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                      <p>
                        {{ $project->is_published?'Si':'No' }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              
        </div>
    </div>
</x-app-layout>