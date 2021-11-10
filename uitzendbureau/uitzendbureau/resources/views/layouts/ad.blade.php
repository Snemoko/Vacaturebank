@if ($ad->first())
<div class="container ad" style="background-image: url(/image/ad/{{  $ad->Random()->text }})"></div>
@endif
