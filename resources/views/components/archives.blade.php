
<div class="p-4">
    <h4 class="fst-italic">Archives</h4>
    <ol class="list-unstyled mb-0">
        @for($i=0; $i<6; $i++)
            <li><a href="#">{{ date('F Y', strtotime( -$i. 'month')) }}</a></li>
        @endfor
    </ol>
</div>
