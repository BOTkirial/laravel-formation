<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks</title>
</head>

<body>
    <h1>Tasks</h1>
    <x-tasks-list :tasks="$tasks" />
    <livewire:counter />

    @auth

        <h1>LOGGED IN</h1>

        <p class="mb-4">Bienvenue, {{ auth()->user()->name }} ({{ auth()->user()->role }}) ({{ auth()->user()->id }})</p>

        <form method="POST" action="{{ route('logout') }}" class="space-y-4 max-w-sm mx-auto mt-10">
            @csrf
            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">logout</button>
        </form>

        <h2>Nouvel Article</h2>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Titre" required
                   class="w-full border rounded p-2 mb-4" value="{{ old('title') }}">
            <textarea name="body" rows="8" placeholder="Contenu" required
                      class="w-full border rounded p-2 mb-4">{{ old('body') }}</textarea>
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Publier</button>
        </form>

        @if($post)

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf @method('PUT')
                <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                    class="w-full border rounded p-2 mb-4">
                <textarea name="body" rows="8" required
                        class="w-full border rounded p-2 mb-4">{{ old('body', $post->body) }}</textarea>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Mettre à jour</button>
            </form>

        @endif

        <h2 class="font-semibold text-xl">Articles</h2>
        <div class="max-w-4xl mx-auto py-8 space-y-4">
            @foreach($posts as $post)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500">Par {{ $post->user->name }}</p>
                    <p class="mt-2">{{ Str::limit($post->body, 120) }}</p>
                    <div class="mt-3 flex gap-2">
                        @can('update', $post)
                            <a href="{{ route('tasks', ['edit' => $post->id]) }}"
                            class="text-sm bg-yellow-500 text-white px-3 py-1 rounded">Modifier</a>
                        @endcan
                        @can('delete', $post)
                            <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                @csrf @method('DELETE')
                                <button class="text-sm bg-red-600 text-white px-3 py-1 rounded">Supprimer</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>

    @endauth

    @guest

        <h1>GUEST</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4 max-w-sm mx-auto mt-10">
            @csrf
            <input type="text" name="name" required class="w-full border rounded p-2" placeholder="Nom">
            <input type="email" name="email" required class="w-full border rounded p-2" placeholder="Email">
            <input type="password" name="password" required class="w-full border rounded p-2" placeholder="Mot de passe">
            <input type="password" name="password_confirmation" required class="w-full border rounded p-2" placeholder="Confirmation">
            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">S'inscrire</button>
        </form>


        <form method="POST" action="{{ route('login') }}" class="space-y-4 max-w-sm mx-auto mt-10">
            @csrf
            <input type="email" name="email" required class="w-full border rounded p-2" placeholder="Email">
            <input type="password" name="password" required class="w-full border rounded p-2" placeholder="Mot de passe">
            @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Se connecter</button>
        </form>

    @endguest

    @if(auth()->user())
        <a href="{{ route('newsletters.index') }}">Newsletters</a>
    @endif

    <x-dialog />

</body>

</html>