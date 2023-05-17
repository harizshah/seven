<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    {{$slot}}
    @if(session()->has('message'))
        <div class="alert alert-success">{{session()->get('message')}}<div>
                @elseif(session()->has('error'))
                    {{$slot}}
                    <div class="alert alert-danger">{{session()->get('error')}}<div>
                            @endif
</div>
