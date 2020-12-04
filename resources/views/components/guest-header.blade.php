<div class="relative flex items-top justify-center sm:items-center sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 h-16 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">{{ __('Dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">{{ __('Login') }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">{{ __('Register') }}</a>
                @endif
            @endif
        </div>
    @endif
</div>

<a href="{{ route('/', [$node]) }}">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="63.961" height="35.197" viewBox="0 0 63.961 35.197" class="mt-20 m-auto mb-20">
        <defs>
        <linearGradient id="linear-gradient" x1="0.5" x2="1.131" y2="1.374" gradientUnits="objectBoundingBox">
            <stop offset="0" stop-color="#163a70"/>
            <stop offset="1" stop-color="#913fd8"/>
        </linearGradient>
        </defs>
        <path d="M-61.783-32.407V0h-3.7V-30.574l-.294-3.109Zm5.9-1.84v12.754a12.708,12.708,0,0,1,2.962-2.546,8.225,8.225,0,0,1,4.578-1.224,7.833,7.833,0,0,1,6.352,2.668,13.489,13.489,0,0,1,2.852,6.9q.147,1.273.171,1.909.049.514.049,1.518a19.131,19.131,0,0,1-1.016,6.34A10.206,10.206,0,0,1-43.218-1.2,9.017,9.017,0,0,1-49.032.612,11.716,11.716,0,0,1-52.447.147a12.586,12.586,0,0,1-2.485-1,4.1,4.1,0,0,1-.955-.612V0h-3.647V-32.407Zm0,29.718a3.515,3.515,0,0,0,.869.575,11.369,11.369,0,0,0,2.3.942,11.02,11.02,0,0,0,3.243.441,5.457,5.457,0,0,0,3.978-1.518,8.8,8.8,0,0,0,2.252-3.77,15.307,15.307,0,0,0,.7-4.553,14.138,14.138,0,0,0-.857-5.141,7.91,7.91,0,0,0-2.289-3.366,4.817,4.817,0,0,0-3.1-1.163,7.419,7.419,0,0,0-2.864.612,9.078,9.078,0,0,0-2.619,1.652,5.944,5.944,0,0,0-1.616,2.24ZM-34.2-32.407a1.936,1.936,0,0,1,.747-1.567,3.051,3.051,0,0,1,2-.612,2.873,2.873,0,0,1,1.922.612,1.962,1.962,0,0,1,.722,1.567,1.987,1.987,0,0,1-.722,1.591,2.873,2.873,0,0,1-1.922.612,3.083,3.083,0,0,1-2.007-.6A1.964,1.964,0,0,1-34.2-32.407Zm4.7,22.64a30.092,30.092,0,0,0,.233,4.284,4.353,4.353,0,0,0,.845,2.215,2.219,2.219,0,0,0,1.763.7,5.577,5.577,0,0,0,2.264-.5,7.471,7.471,0,0,0,1.922-1.187l1.053,2.105a10.051,10.051,0,0,1-2.8,2.068,7.242,7.242,0,0,1-3.17.7A4.814,4.814,0,0,1-31.284-.893a6.963,6.963,0,0,1-1.579-3.525,32.828,32.828,0,0,1-.306-4.835V-21.64h-2.57v-3.011H-33.1l3.6-.539Zm8.935,4.6a13.854,13.854,0,0,0,4.3,1.909,17.171,17.171,0,0,0,4.443.71,8.434,8.434,0,0,0,4.59-1.089,3.47,3.47,0,0,0,1.7-3.1A3.373,3.373,0,0,0-7.454-9.816,17.727,17.727,0,0,0-12.7-11.53q-7.613-1.42-7.613-7.2a5.4,5.4,0,0,1,2.644-4.884,13.075,13.075,0,0,1,7-1.652,14.885,14.885,0,0,1,4.186.539,19.2,19.2,0,0,1,3.4,1.346l-.539,2.962a14.9,14.9,0,0,0-3.3-1.2,20.028,20.028,0,0,0-3.035-.49l-.783-.024q-5.973,0-5.973,3.476a3.221,3.221,0,0,0,1.371,2.864,10.79,10.79,0,0,0,4.21,1.4A16.043,16.043,0,0,1-4.431-11.8,5.822,5.822,0,0,1-1.811-6.854,6.393,6.393,0,0,1-3.195-2.607,7.94,7.94,0,0,1-6.768-.2a14.3,14.3,0,0,1-4.712.759,18.81,18.81,0,0,1-2.4-.171,18.171,18.171,0,0,1-7.148-2.472Z" transform="translate(65.773 34.585)" fill="url(#linear-gradient)"/>
    </svg>
</a>