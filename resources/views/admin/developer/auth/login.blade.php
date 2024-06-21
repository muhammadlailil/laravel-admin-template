<x-layout.blank title="Login">
    <div class="absolute z-[0] bottom-0 flex justify-center items-center px-24 left-0 top-0 w-[50%] bg-[#DF2C51]">
        <img src="{{asset('assets/img/vector-auth.png')}}" alt="">
    </div>
    <section class="bg-white w-[370px] mx-auto rounded-xl px-7 py-4 z-5 relative shadow-md">
        <div class="flex flex-col justify-center items-center">
            <img src="{{ asset('assets/img/app-logo.png') }}" alt="Application Logo" class="w-[100px] mt-6">
            <h1 class="font-krub-bold text-[26px] mt-4">
                Welcome Back 👋
            </h1>
            <p class="text-label text-[11px] mb-7">Please enter your login account</p>
            <form action="{{ route('admin.auth.post-login') }}" method="post"
                class="font-krub-semibold w-full flex flex-col gap-3 mb-3">
                @csrf
                <x-input type="text" id="email" name="email" label="Email" required placeholder="Email Anda"
                    is-col="true" :value="old('email')" />
                <x-input.password id="password" name="password" label="Password" placeholder="Password Anda"
                    required is-col="true" />
                <x-button.orange type="submit" label="Masuk" />

                <p class="mt-5 text-[10px] text-label text-center font-krub-regular">
                    {{ config('app.name') }} {{config('admin.version')}} © 2024 By PT. ara Shoes Indonesia
                </p>
            </form>
        </div>
    </section>
</x-layout.blank>
