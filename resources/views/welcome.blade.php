<x-overall-layout>

            <div class="min-h-screen grid lg:grid-cols-2">

                <div class="flex flex-col justify-center">
                    <h1 class="text-center font-bold text-4xl text-cyan-600 font-['Righteous']">Ecoplan HelpDesk</h1>
                    <img src="{{ asset('images/helpdesk-illustrator.webp') }}" class="mx-auto">
                </div>

                <div class="flex flex-col justify-center p-6">

                    <div class="mx-auto w-[90%] lg:w-1/2 py-6 px-3">
                        <h1 class="text-xl font-semibold  py-3 border-b border-cyan-600 text-center">Be Part of Our Work!</h1>


                        <a href="{{ route('register') }}" class="block text-center hover:bg-cyan-600 py-3 px-6 bg-black text-white text-lg mt-6 rounded">
                            Get Started
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="{{ route('login') }}" class="block text-center hover:bg-cyan-600 hover:text-white py-3 px-6 bg-black text-white text-lg mt-6 rounded">
                            Sigin (Member)
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

</x-overall-layout>
