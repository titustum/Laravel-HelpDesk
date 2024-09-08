<x-overall-layout>

            <div class="grid min-h-screen lg:grid-cols-2">

                <div class="flex flex-col justify-center">
                    <h1 class="text-center font-bold text-4xl text-cyan-600 font-['Righteous']">Ecoplan HelpDesk</h1>
                    <img src="{{ asset('images/helpdesk-illustrator.webp') }}" class="mx-auto">
                </div>

                <div class="flex flex-col justify-center p-6">

                    <div class="mx-auto w-[90%] lg:w-1/2 py-6 px-3">
                        <h1 class="py-3 text-xl font-semibold text-center border-b border-cyan-600">Be Part of Our Work!</h1>


                        <a href="{{ route('register') }}" class="block px-6 py-3 mt-6 text-lg text-center text-white bg-black rounded hover:bg-cyan-600">
                            Get Started
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('login') }}" class="block px-6 py-3 mt-6 text-lg text-center text-white bg-black rounded hover:bg-cyan-600 hover:text-white">
                            Sigin (Member)
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

</x-overall-layout>
