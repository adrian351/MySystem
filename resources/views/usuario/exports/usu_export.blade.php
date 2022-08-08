<table>
    <thead>
    <tr>
      <th>ID</th>
      <th>NOMBRE</th>
      <th>APELLIDO</th>
      <th>EMAIL_REGISTRO</th>
      <th>EMAIL</th>
      <th>ACCESO</th>
      <th>ROL</th>
    </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $usu)
      @if($usu->acceso == 1) 
        <tr>
            <td>{{ $usu->id }}</td>
            <td>{{ $usu->nom }}</td>
            <td>{{ $usu->apell }}</td>
            <td>{{ $usu->email_registro}}</td>
            <td>{{ $usu->email }}</td>
            <td>{{ $usu->acceso }}</td>
            <td>
                @foreach ($usu->roles as $rol)
                    {{ $rol->nom.", " }}
                @endforeach
            </td>
        </tr>
      @endif
    @endforeach
    </tbody>
  </table>