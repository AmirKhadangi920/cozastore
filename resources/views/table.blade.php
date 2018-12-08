<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style>
div.col-6 {
    float: left;
}
</style>

<div class="container">
    <ul class="list-group">
        @php $header = null @endphp
        @foreach ($data as $item)
        @php $item = $item->toArray() @endphp

            @if ($item['spec_row']['spec_header']['title'] != $header)
                
                @php $header = $item['spec_row']['spec_header']['title'] @endphp        
                <li class="list-group-item row">
                    <h2>{{ $item['spec_row']['spec_header']['title'] }}</h2>
                </li>
            @endif
            
            <li class="list-group-item row">
                <div class="col-6"><b>{{ $item['spec_row']['title'] }}</b></div>
                <div class="col-6">{{ $item['data'] }}</div>
            </li>
        @endforeach
    </ul>
</div>