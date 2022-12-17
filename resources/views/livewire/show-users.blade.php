<div class="container max-w-7xl mx-auto py-6 mt-10 px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-4 gap-8">

        <div class="col-span-3 mt-6">
            <!-- пользователи -->
            <div class="grid grid-cols-6 gap-4">
                @foreach($users as $user)
                    <div>
                        <img class="object-center object-cover rounded-full h-50 w-50 mr-2" src="{{ $user->getMedia('avatars')->first()->getUrl() }}">
                        <p class="text-center" >{{ $user->name }}</p>
                        <p class="text-center" >{{ count($user->events()->get()) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $users->links() }}
            </div>

        </div>
        <!-- фильтры -->
        <div>

            <!-- Кол-во пользователей на страницу -->
            <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Кол-во пользователей</label>

            <select id="default" wire:model="perPage" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>

            <!-- фильтры -->
            <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Фильтр</label>

            <select id="default" wire:model="orderBy" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="ASC">сначала новые</option>
                <option value="DESC">сначала старые</option>
            </select>

            <!-- возраст -->
            <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Возраст</label>

            <select id="default" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>18 - 21</option>
                <option value="CA">21 - 26</option>
                <option value="FR">26 - 35</option>
                <option value="DE">старше 36</option>
            </select>

            <!-- пол -->
            <label for="large" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Пол</label>

            <select id="default" wire:model="gender" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="all">Все</option>
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>

        </div>
    </div>


</div>
