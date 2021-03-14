 @push('styles')
    <!-- component -->
    <style>
        .view-filter {
            padding-bottom: 15px !important;
            background-color: rgba(244, 245, 247, 0.842);
            float:none !important;
        }

        input[type=search] {
            border: 0px solid;
            border-radius: 6px;
        }

        td {
            overflow-wrap: break-word;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        td.pp0 {
            overflow-wrap: break-word;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* Segundas columnas mas pequeñas */
        p.row-2 {
            /* font-size: 0.75rem !important; */
            margin-left: 1rem !important;
        }

        p.row-3 {
            /* font-size: 0.75rem !important; */
            margin-left: 1rem !important;
            width: 15rem !important;
            height: 3.2rem !important;
        }

        /* Fila de ancho ajustable valores definidos */
        p.row-auto {
            /* font-size: 0.75rem !important; */
            margin-left: 1.25rem !important;
            width: auto !important;
            height: 2.7rem !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* .line-clamp{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            margin-bottom: 10px;
        } */

        /* div esclusiva para estilo informacion legal */
        p.legal{
            margin-left: 1rem;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 11;
            overflow: hidden;
            margin-bottom: 10px;
            width: auto;
            height: 15rem;
        }

        @media (min-width: 640px) {
            /* sm */
                /* p {
                    width: 18rem;
                } */
                p.row-3 {
                    width: 18rem;
                }
            }

        @media (min-width: 768px) {
            /* md */
            /* p {
                width: 20rem;
            } */
            p.row-3 {
                width: 20rem;
            }
            td {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
            }
        }
        @media (min-width: 1024px) {
            /* lg */
            /* p {
                width: 16rem !important;
                margin-left: 0 !important;
            } */
            p.row-2 {
                width: 14rem !important;
                margin-left: 0 !important;
            }
            p.row-3 {
                width: 10rem !important;
                margin-left: 0.2rem !important;
                height: 3.3rem !important;
            }
            p.row-auto {
                margin-left: 0 !important;
                margin-right: 1rem !important;
            }
            p.legal {
                margin-left: 0 !important;
            }
            td {
                padding-top: 1.25rem !important;
                padding-bottom: 1.25rem !important;
            }
        }
        @media (min-width: 1280px) {
            p {
                /* width: 20rem !important; */
            }
            p.row-2 {
                width: 16rem !important;
                margin-left: 0 !important;
            }
            p.row-3 {
                width: 14rem !important;
                margin-left: 0 !important;
            }
            p.row-auto {
                margin-left: 0 !important;
            }
            p.legal {
                margin-left: 0 !important;
            }
        }
    </style>
@endpush
<div>
    <table class="min-w-full table-auto">
        <thead class="justify-between">
            <tr>
                <th class="py-2 text-left focus:outline-none hidden lg:table-cell">
                    <span class="text-gray-400 pl-2.5 text-sm">{{ $firstTheadTitle }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_asc">
                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_desc">
                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                    </svg>
                </th>

                @if (isset($secondTheadTitle))
                    <th class="py-2 text-left focus:outline-none hidden lg:table-cell">
                        <span class="text-gray-400 text-sm">{{ $secondTheadTitle }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_asc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_desc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                        </svg>
                    </th>
                @endif

                @if (isset($thirdTheadTitle))
                    <th class="py-2 text-left focus:outline-none hidden lg:table-cell">
                        <span class="text-gray-400 text-sm">{{ $thirdTheadTitle }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_asc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_desc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                        </svg>
                    </th>
                @endif

                @if (isset($fourthTheadTitle))
                    <th class="py-2 text-left focus:outline-none hidden lg:table-cell">
                        <span class="text-gray-400 text-sm">{{ $fourthTheadTitle }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_asc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_desc">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                        </svg>
                    </th>
                @endif

                <th class="pr-2 py-2 text-left focus:outline-none text-center hidden lg:table-cell">
                    <span class="text-gray-400 text-sm">{{ __('Actions') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_asc">
                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline text-gray-500 icon_sorting_desc">
                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z" />
                    </svg>
                </th>
            </tr>
        </thead>
        <tbody class="bg-gray-100">
            {{ $tbodyData }}
        </tbody>
    </table>
</div>
