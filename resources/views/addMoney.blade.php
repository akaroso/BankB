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


      


        @php
        
                                    $lastid = null;
                                    $rowclass = Auth::user()->Account->id;
                                    @endphp
                                    <div></div>
        <form method="POST" action="{{route('transfer.depositMoney','id=')}}{{$rowclass}}">
            @csrf
             
            <!-- Name -->
            <div>
            

                <x-label for="balance" :value="__('Ammount')" />

                <x-input id="balance" class="block mt-1 w-full" type="text" name="balance" :value="old('balance')" />
            </div>
            <div>
                
            </div>

           

            

            <!-- Password -->
           
            <div class="flex items-center justify-end mt-4">
                

                <x-button class="ml-4">
                    {{ __('Add money') }}
                </x-button>
            </div>
        </form>


    </x-auth-card>
</x-guest-layout>
