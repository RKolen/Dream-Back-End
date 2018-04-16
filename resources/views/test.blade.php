<form Method="POST" action="login">

	{{ csrf_field() }}

	<div >

		<label for="email">email</label>
		<input name="email" value="email">

	</div>
	<div >
		<label for="password">password</label>
		<input name="password" >

	</div>
	<button type="submit" class="btn btn-primary">login</button>
	
</form>