<x-auth-layout :title="$title">
    <section class="flex min-h-screen items-center justify-center ">
        <div class="bg-white shadow-lg border border-gray-200 px-10 py-12 rounded-xl w-full max-w-md">
            
            <h2 class="font-bold text-2xl text-gray-800 text-center">
                Login to Inventory Management
            </h2>

            @if (session('error'))
                <div class="bg-red-500 rounded-lg py-3 w-full mt-6 px-3 text-white text-center">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="mt-8 flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <label for="email" class="font-semibold text-gray-700">Email</label>
                        <input 
                        type="text" 
                        id="email" 
                        name="email"
                        class="border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-lg px-3 py-2 text-gray-700 transition-all"
                        >
                        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                    
                    <div class="flex flex-col gap-1">
                        <label for="password" class="font-semibold text-gray-700">Password</label>
                        <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 rounded-lg px-3 py-2 text-gray-700 transition-all"
                        >
                        @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button 
                    type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 transition-all duration-200 rounded-lg text-white font-semibold py-2 mt-2 shadow-md"
                >
                    Login
                </button>
            </form>
        </div>
    </section>
</x-auth-layout>
