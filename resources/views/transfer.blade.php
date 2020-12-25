<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <div></div>


        @php

        $lastid = null;
        $rowclass = Auth::user()->Account->id;
        @endphp
        
        <form method="POST" action="{{route('transfer.internalTransfer','id=')}}{{$rowclass}}">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <div>
                <x-label for="balance" :value="__('Ammount')" />

                <x-input id="balance" class="block mt-1 w-full" type="text" name="balance" :value="old('balance')" required autofocus />
            </div>
            <div>
                <x-label for="acc_number" :value="__('Bank Number')" />

                <x-input id="acc_number" class="block mt-1 w-full" type="text" name="acc_number" :value="old('acc_number')" required autofocus />
            </div>





            <!-- Password -->

            <div class="flex items-center justify-end mt-4">


                <x-button class="ml-4">
                    {{ __('Transfer') }}
                </x-button>
            </div>
        </form>


    </x-auth-card>
</x-guest-layout>