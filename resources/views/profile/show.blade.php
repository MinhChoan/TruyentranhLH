<x-navbar />

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ $user->username }}'s Profile</div>

                <div class="card-body">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.webp') }}" alt="{{ $user->username }} Avatar" class="mb-3" style="max-width: 200px;">
                    <p>Name: {{ $user->username }}</p>
                    <p>Email: {{ $user->email }}</p>

                    <!-- Add code to display image path -->
                    <p>Avatar Path: {{ $user->avatar ? asset('storage/' . $user->avatar) : 'N/A' }}</p>

                    <!-- Form upload ảnh -->
                    <form action="{{ route('profile.avatar.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Chọn ảnh đại diện</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
                        </div>
                        @error('avatar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Tải lên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

