<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="p-8 bg-white border-b ">

                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <class="underline text-gray-900 dark:text-white>Account Number: {{ Auth::user()->Account->number }} </a>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                                <class="underline text-gray-900 dark:text-white>Balance: {{ Auth::user()->Account->balance }}$</a>
                            </div>
                        </div>

                        <div class="flex items-botton">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                               
                            </svg>
                            <div class="ml-4 text-lg leading-7 font-semibold">
                   
                            </div>
                            
                        </div>
                       <a class="hover:text-black-500" href="{{ route('transfer')}}"> <x-button class="ml-4" >
                   {{ __('Transfer') }} 
                        </a>
                </x-button>

                
                <x-button class="ml-4">
                  <a href="{{route('addMoney')}}">  {{ __('Deposit money') }}  </a>
                </x-button>
                    </div>


                    <div class="md:px-32 py-8 w-full ">
                        <div class="shadow overflow-hidden rounded border-b border-gray-200 ">
                            <table class="min-w-full bg-white ">
                                <thead class="bg-gray-500 text-white ">
                                    <tr>
                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Send Date</th>
                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Type</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ammount</td>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">

                                    @php
                                    $lastid = null;
                                    $rowclass = 'bg-gray-100';
                                    @endphp


                                    @foreach(Auth::user()->Account->Operation as $opt)
                                    @php

                                    if ($lastid !== $opt->id)
                                    {
                                    $lastid = $opt->id;
                                    if ($rowclass == 'bg-gray-100') $rowclass = 'bg-gray-10';
                                    else $rowclass = 'bg-gray-100';
                                    }
                                    @endphp

                                    <tr class={{$rowclass}}>
                                        <td class="w-1/3 text-left py-3 px-4">{{$opt->created_at}}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{$opt->status}}</td>
                                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">{{$opt->type}}</a></td>
                                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">{{$opt->amount}}$</a></td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>