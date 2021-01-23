@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Name"
           minlength="4"
           required
           value="{{ old('name', $user->name) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <label for="email">Email</label>
    <input type="email" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="email"
           required
           value="{{ old('emial', $user->email) }}">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Save user</button>
