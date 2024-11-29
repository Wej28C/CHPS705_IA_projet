<table>
    <tr></tr>
    @php
        $maxUsers = $game->maxUsersInInstance();
        $maxConnections = $game->maxConnectionsInInstance();
    @endphp
    <thead>
        <tr>
            <th></th>
            <x-exports-excel.th>Instance ID</x-exports-excel.th>
            <x-exports-excel.th>Hoste ID</x-exports-excel.th>
            <x-exports-excel.th>Hoste Name</x-exports-excel.th>
            <x-exports-excel.th>Hoste IP</x-exports-excel.th>
            <x-exports-excel.th>Hoste port</x-exports-excel.th>
            @for($i = 0; $i < $maxUsers; $i++)
                <x-exports-excel.th>User.{{ $i }} ID</x-exports-excel.th>
                <x-exports-excel.th>User.{{ $i }} Name</x-exports-excel.th>
                <x-exports-excel.th>User.{{ $i }} Ranking</x-exports-excel.th>
                <x-exports-excel.th>User.{{ $i }} Satisfaction</x-exports-excel.th>
            @endfor
            @for($i = 0; $i < $maxConnections; $i++)
                <x-exports-excel.th>Connections.{{ $i }} ID</x-exports-excel.th>
                <x-exports-excel.th>Connections.{{ $i }} IP</x-exports-excel.th>
                <x-exports-excel.th>Connections.{{ $i }} Port</x-exports-excel.th>
                <x-exports-excel.th>Connections.{{ $i }} Robot ID</x-exports-excel.th>
                <x-exports-excel.th>Connections.{{ $i }} Robot Name</x-exports-excel.th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($game->instances as $instance)
        <tr>
            <td></td>
            <x-exports-excel.left-td>{{ $instance->id }}</x-exports-excel.left-td>
            <x-exports-excel.td>{{ $instance->host->id }}</x-exports-excel.td>
            <x-exports-excel.td>{{ $instance->host->name }}</x-exports-excel.td>
            <x-exports-excel.td>{{ $instance->host->ip }}</x-exports-excel.td>
            <x-exports-excel.td>{{ $instance->host->port }}</x-exports-excel.td>
            @php $i = 0; @endphp
            @foreach($instance->usersWithPivot as $user)
                <x-exports-excel.td>{{ $user->id }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $user->name }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $user->pivot->ranking }}</x-exports-excel.td>
                @if($i + 1 == $maxUsers)
                <x-exports-excel.right-td>{{ $user->pivot->satisfaction }}</x-exports-excel.right-td>
                @else
                <x-exports-excel.td>{{ $user->pivot->satisfaction }}</x-exports-excel.td>
                @endif
                @php $i = $i + 1; @endphp
            @endforeach
            @for($i = $instance->usersWithPivot()->count(); $i < $maxUsers; $i++)
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
            @endfor

            @foreach($instance->connections as $connection)
                <x-exports-excel.td>{{ $connection->id }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $connection->ip }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $connection->port }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $connection->robot->id }}</x-exports-excel.td>
                <x-exports-excel.td>{{ $connection->robot->name }}</x-exports-excel.td>
            @endforeach
            @for($i = $instance->connections()->count(); $i < $maxConnections; $i++)
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
                <x-exports-excel.td></x-exports-excel.td>
            @endfor
        </tr>
        @endforeach
    </tbody>
</table>
