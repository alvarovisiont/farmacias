@if(Session::has('flash_message'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <div class="alert {{ Session::get('flash_class') }}">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong class="text-center">{{Session::get('flash_message')}}&nbsp;&nbsp;<i class="fa fa-exclamation-circle"></i></strong> 
    	</div>
    </div>
  </div>
@endif