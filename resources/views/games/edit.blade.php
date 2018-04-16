<form Method="POST" action="update">

	{{ csrf_field() }}

	<div >

		<label for="title">titel</label>
		<input name="title" value="{{ $game->title }}">

	</div>
	<div >

		<textarea name="description" class="form-control">{{ $game->description }}</textarea>

	</div>
	<button type="submit" class="btn btn-primary">update</button>
	
</form>
