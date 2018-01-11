@extends('layouts.app')

@section('view_descrip')
	Modificar Usuario
@endsection

@section('content')
	@include('auth.register')
@endsection

@section('script')
	<script>
		$(function(){
			$('#estado').change(function(e){
				$('#municipio').empty()
				$('#parroquia').empty()

				$.ajax({
					url: '{{ route('municipios.ajax') }}',
					type: 'GET',
					dataType: 'JSON',
					data: {estado: e.currentTarget.value},
				})
				.done(function(data) {
					var options = "<option></option>";

					$.grep(data, function(e,i){
						options+= "<option value='"+e.id_municipio+"'>"+e.municipio+"</option>"
					})

					$("#municipio").html(options)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			})

			$('#municipio').change(function(e){
				$('#parroquia').empty()

				var estado = $('#estado').val(),
					municipio = e.currentTarget.value

				$.ajax({
					url: '{{ route('parroquias.ajax') }}',
					type: 'GET',
					dataType: 'JSON',
					data: {estado, municipio},
				})
				.done(function(data) {
					var options = "<option></option>";

					$.grep(data, function(e,i){
						options+= "<option value='"+e.id+"'>"+e.parroquia+"</option>"
					})

					$("#parroquia").html(options)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			})

		})
	</script>
@endsection