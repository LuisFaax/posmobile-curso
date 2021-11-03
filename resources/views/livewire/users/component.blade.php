<div>
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $componentName }}
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a onclick="openModal()" href="javascript:;" class="btn btn-primary">Agregar F2</a>


            <div class="hidden md:block mx-auto text-gray-600 "></div>

            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input wire:model="search" id="search" type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Buscar F8">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>

        </div>
        <!-- BEGIN: Users Layout -->
        @forelse($users as $u)
        <div class="intro-y col-span-12 md:col-span-4">
            <div class="box">
                <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                        <img alt="avatar" class="rounded-full" src="{{ $u->image }}">
                    </div>
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <a href="" class="font-medium">{{ $u->name }}</a>
                        <div class="text-gray-600 text-xs mt-0.5">{{ $u->email }}</div>
                    </div>
                    <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip" title="estatus de usuario"> <i class="fas {{$u->status =='Active' ? 'fa-unlock' : 'fa-lock' }} w-3 h-3 fill-current"></i> </a>
                    </div>
                </div>
                <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                        <div class="flex text-gray-600 text-xs">
                            <div class="mr-auto">{{ $u->phone ?? '-' }}</div>
                        </div>
                    </div>
                    <button class="btn btn-primary py-1 px-2 mr-2" title='Eliminar usuarios'>
                        <i class='fas fa-trash'></i>
                    </button>
                    <button class="btn btn-outline-secondary py-1 px-2" title='Editar Info'><i class='fas fa-edit'></i></button>
                </div>
            </div>
        </div>
        @empty
        <h5>Sin Resultados</h5>
        @endforelse

        <!-- END: Users Layout -->

    </div>
    <!-- BEGIN: Pagination -->
    <div class="cols-span-12 mt-5">
        {{$users->links()}}
    </div>
    @include('livewire.users.modal')
    <!-- END: Pagination -->
</div>
@include('components.script')