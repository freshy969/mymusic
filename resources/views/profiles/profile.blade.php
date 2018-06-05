@extends('layouts.app')
@section('content')
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ URL::asset('css/general.css') }}" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
   <title>Perfiles de musicos</title>
  </head>
  <body background-color: #fff;>
    @if (count($profile) == 0)
      <h1>no existen perfiles que mostrar</h1>
    @else
    <div class="row">
      <div class=col-10>
        <h1>estos son los perfiles de los musicos</h1>
      </div>
      <div class="col-2">
        @auth
            <a class="fas fa-user-ninja fa-4x text-dark" href="/profile/{{ $idPerf }}/self"></a>
        @endauth
      </div>
    </div>
    @if(Session::has('flash_message'))
      <div class="alert alert-success">
        {{Session::get('flash_message')}}
    </div>
    @endif
      
        <form class="navbar-form navbar-left" role="search" action="{{url('profiles/searchredirect')}}">
          <div class="row">
            <div class="col-7">
             <div class="form-group">
               <input type="text" class="form-control" name='search' placeholder="Buscar por genero musical"/>
             </div>
           </div>
        <div class="col-4">
           <button type="submit" class="btn btn-dark">Buscar</button>
        </div>
        </div>
        </form>

    <div class="col-md-11">
    <a class="btn btn-info" href="{{ URL::to('profiles/mayores/18') }}">Filtrar mayores de 18</a>
    <a class="btn btn-secondary" href="{{ URL::to('profiles/banda/s') }}">filtrar solo bandas</a>
    <a class="btn btn-primary" href="{{ URL::to('profiles/solista/s') }}">filtrar solo solistas</a>
      @foreach($profile as $prof)
      <table class="table table-bordered">
       <thead>
            <tr>
              <th>Foto de perfil</th>
              <th>Nombre de artista</th>
              <th>banda o solista</th>
              <th>Genero musical</th>
              <th>edad</th>
              @auth
              @if($prof->id == Auth::user()->id)
              <th>acciones</th>
              @endif
              @endauth
            </tr>
          </thead>    
        <tbody>
          <tr>
            <td><img src="/uploads/avatars/{{ $prof->photo }}" style="width:40px; height:40px; float:left; border-radius:50%; margin-right:25px;"></td>
            <td><a href="/profile/{{ $prof->id }}">{{ $prof->artistname }}</a></td>
            <td>{{ $prof->bandornot }}</td>
            <td>{{ $prof->musictype }}</td>
            <td>{{ $prof->User->age }}</td>
            @auth
            @if($prof->id == Auth::user()->id)
            <td><a class="btn btn-warning btn-sm" href="{{ URL::to('profile/' . $prof->id . '/edit') }}">Editar este perfil</a></td>
            @endif
            @endauth
          </tr>
        </tbody>
        </div>
      </table>
   @endforeach
   {{ $profile->links() }}
   @endif
  </body>
</html>
@endsection