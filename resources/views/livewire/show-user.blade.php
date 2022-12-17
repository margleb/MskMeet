<div>
    <img class="object-center object-cover rounded-full h-50 w-50 mr-2" src="{{ $user->getMedia('avatars')->first()->getUrl() }}">
    <p class="text-center" >{{ $user->name }}</p>
    <p class="text-center" >Возраст: {{ $this->age }}</p>
    <p class="text-center" >{{ count($user->events()->get()) }}</p>
</div>
