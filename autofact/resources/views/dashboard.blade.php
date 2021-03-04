<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (Auth::user()->isAdmin())
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        ¿La información es correcta?
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                    <div class="ct-chart ct-perfect-fourth"></div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        const rightYes = {{ App\Models\Quiz::getRightYes() }};
        const rightNo = {{ App\Models\Quiz::getRightNo() }};
        const rightMoreOrLess = {{ App\Models\Quiz::getRightMoreOrLess() }};
        const data = {
            labels: [`SI ${rightYes}`, `NO ${rightNo}`, `Más o menos ${rightMoreOrLess}`],
            series: [
                parseInt(rightYes),
                parseInt(rightNo),
                parseInt(rightMoreOrLess),
            ],
        };

        new Chartist.Pie('.ct-chart', data, {
            chartPadding: 40,
            labelOffset: 80,
            labelDirection: 'explode'
        });
    </script>
    @else
    @if (Auth::user()->getQuizMonthly())
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Pregunta
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ Auth::user()->getQuizMonthly()->created_at }}
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        ¿Qué te gustaría que agregáramos al informe?
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ Auth::user()->getQuizMonthly()->suggestion }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        ¿La información es correcta?
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ Auth::user()->getQuizMonthly()->right }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        ¿Del 1 al 5, es rápido el sitio?
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ Auth::user()->getQuizMonthly()->speed }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Preguntas</h3>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ Route('quizzes.store') }}" method="POST">
                                    @csrf
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div>
                                                <label for="suggestion" class="block text-sm font-medium text-gray-700">
                                                    ¿Qué te gustaría que agregáramos al informe?
                                                </label>
                                                <div class="mt-1">
                                                    <textarea id="suggestion" name="suggestion" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tu respuesta..."></textarea>
                                                </div>
                                            </div>

                                            <fieldset>
                                                <div>
                                                    <label for="suggestion" class="block text-sm font-medium text-gray-700">
                                                        ¿La información es correcta?
                                                    </label>
                                                </div>
                                                <div class="mt-4 space-y-4">
                                                    <div class="flex items-center">
                                                        <input id="right_yes" name="right" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="yes">
                                                        <label for="right_yes" class="ml-3 block text-sm font-medium text-gray-700">
                                                            Sí
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="right_no" name="right" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="no">
                                                        <label for="right_no" class="ml-3 block text-sm font-medium text-gray-700">
                                                            No
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="right_more_or_less" name="right" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="more_or_less">
                                                        <label for="right_more_or_less" class="ml-3 block text-sm font-medium text-gray-700">
                                                            Más o menos
                                                        </label>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <div>
                                                    <label for="suggestion" class="block text-sm font-medium text-gray-700">
                                                        ¿Del 1 al 5, es rápido el sitio?
                                                    </label>
                                                </div>
                                                <div class="mt-4 col-span-3 sm:col-span-3 lg:col-span-2">
                                                    <input id="speed_1" name="speed" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="1">
                                                    <label for="speed_1" class="inline-flex items-center ml-3 mr-3 text-sm font-medium text-gray-700">1</label>

                                                    <input id="speed_2" name="speed" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="2">
                                                    <label for="speed_2" class="inline-flex items-center ml-3 mr-3 text-sm font-medium text-gray-700">2</label>

                                                    <input id="speed_3" name="speed" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="3">
                                                    <label for="speed_3" class="inline-flex items-center ml-3 mr-3 text-sm font-medium text-gray-700">3</label>

                                                    <input id="speed_4" name="speed" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="4">
                                                    <label for="speed_4" class="inline-flex items-center ml-3 mr-3 text-sm font-medium text-gray-700">4</label>

                                                    <input id="speed_5" name="speed" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="5">
                                                    <label for="speed_5" class="inline-flex items-center ml-3 mr-3 text-sm font-medium text-gray-700">5</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Enviar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif

</x-app-layout>
