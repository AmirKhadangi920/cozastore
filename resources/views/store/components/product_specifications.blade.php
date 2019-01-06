
<div class="tab-pane active in panel entry-content wc-tab" id="tab-specification">
    @foreach ($spec->toArray()['spec_headers'] as $spec_header)
        <div id="{{ $spec_header['id'] }}">
            <h3><i class="fa fa-arrow-left" style="color: #e52b2b" aria-hidden="true"></i> {{ $spec_header['title'] }}</h3>
            <span style="display: block;margin-top: -15px;margin-bottom: 20px;color: #878787">{{ $spec_header['description'] }}</span>
            
            <table class="table">
                <tbody>
                    @php $empty = true @endphp
                    @foreach ($spec_header['spec_rows'] as $spec_row)                                                        
                        @continue( is_null($spec_row['spec_data']) )
                        <tr>
                            <td>{{ $spec_row['title'] }}</td>
                            <td>
                                @if ($spec_row['multiple'])
                                    @foreach (explode(',', $spec_row['spec_data']['data']) as $item)
                                        @if($spec_row['values'])
                                            @isset($spec_row['values'][ $item ])
                                                {{ $spec_row['values'][ $item ] }}
                                            @else
                                                {{ $item }} 
                                            @endisset
                                        @else
                                            {{ $item }} 
                                        @endif

                                        @if($spec_row['label'])
                                            {{ $spec_row['label'] }}
                                        @endif
                                        @if(!$loop->last) <br/> @endif

                                    @endforeach
                                @else
                                    @if($spec_row['values'])
                                        @isset($spec_row['values'][ $spec_row['spec_data']['data'] ])
                                            {{ $spec_row['values'][ $spec_row['spec_data']['data'] ] }}
                                        @else
                                            {{ $spec_row['spec_data']['data'] }}
                                        @endisset
                                    @endif
                                    @if($spec_row['label'])
                                        {{ $spec_row['label'] }}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @php $empty = false @endphp
                    @endforeach
                </tbody>
            </table>
            @if(!$loop->last) <hr/> @endif
        </div>
        @if ($empty)
            <script> document.getElementById("{{ $spec_header['id'] }}").style.display = 'none'; </script>
        @endif
    @endforeach
</div><!-- /.panel -->