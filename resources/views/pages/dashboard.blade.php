<x-app-layout page="">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    @if(Auth::user()->role == 'admin')
    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection
    <div class="options p-10">
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/cursos.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>
            <div class="px-6 py-4">
                <a href="/admin/dashboard/terms" class="btn primary-btn">Cursos</a>
            </div>
        </div>
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/icono-alumno.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>
            <div class="px-6 py-4">
                <a href="/admin/dashboard/students" class="btn primary-btn">Alumnes</a>
            </div>
        </div>
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/admin.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>
            <div class="px-6 py-4">
                <a href="/admin/dashboard/createAdmin" class="btn primary-btn">Crea admin</a>
            </div>
        </div>
    </div>
    @else
    @section('breadcrumbs')
        {{ Breadcrumbs::render('home') }}
    @endsection
    <div class="flex flex-col">

        <div class="flex flex-col items-center justify-center w-full  ">
            <h2 class="">Estat de la matricula: <button class="statusnothing ml-2 flex-initial"></button></h2>
            <div class="flex flex-wrap items-center justify-center w-1/2 text-center container-formlights mt-5 statesdiv ">
                <div class="w-1/2 mt-2">DNI: <button class="statusnothing ml-2 flex-initial"></button></div>
                <div class="w-1/2 mt-2">T. SANITARIA: <button class="statusnothing ml-2 flex-start"></button></div>
                <div class="w-1/2 mt-2">TITULO ACADEMICO: <button class="statusnothing ml-2 flex-initial"></button></div>
                <div class="w-1/2 mt-2">RESGUARDO PAGO: <button class="statusnothing ml-2 flex-initial"></button></div>
            </div>
        </div>
        <div class="options p-10">
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/usuari.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>

        
            <div class="px-6 py-4">
                <a href="/dashboard/profile" class="btn primary-btn">Dades personals</a>
            </div>
        </div>
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/matricula.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>
            <div class="px-6 py-4">
                <a href="#" class="btn primary-btn">Recalcula matricula</a>
            </div>
        </div>
        <div class="option flex items-center justify-center border max-w-xs rounded overflow-hidden shadow-md my-2 bg-white">
            <div class="px-4 py-2">
                <img src="{{ asset('images/docs.png') }}" alt="logo" class="logo w-24 m-4"/>
            </div>
            <div class="px-6 py-4">
                <a href="/dashboard/documents" class="btn primary-btn">Documents</a>
            </div>
        </div>
    </div>
    @endif

</x-app-layout>
