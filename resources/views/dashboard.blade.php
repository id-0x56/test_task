<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('get-present') }}">
                        @csrf
                        <div>
                            <x-button>{{ __('get present') }}</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-label value="points: {{ $points->count }}" />
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <x-label value="moneys: {{ $moneys->count }}" />
                    </div>
                    <form method="POST" action="{{ route('moneys.withdraw') }}">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-button>{{ __('withdraw money') }}</x-button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('moneys.convert') }}">
                        @csrf
                        @method('patch')
                        <div>
                            <x-button>{{ __('convert to points') }}</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 bg-white border-b border-gray-200">--}}
{{--                    <div class="mb-4">--}}
{{--                        <x-label value="item" />--}}
{{--                    </div>--}}
{{--                    <form method="POST" action="{{ route('items.send') }}">--}}
{{--                        @csrf--}}
{{--                        @method('patch')--}}
{{--                        <div class="mb-4">--}}
{{--                            <x-button>{{ __('send') }}</x-button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <form method="POST" action="{{ route('items.cancel') }}">--}}
{{--                        @csrf--}}
{{--                        @method('delete')--}}
{{--                        <div>--}}
{{--                            <x-button>{{ __('cancel') }}</x-button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</x-app-layout>
