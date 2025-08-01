@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="auth-form">
        <div class="auth-header">
            <h2>Reset Password</h2>
            <p>Masukkan password baru.</p>
        </div>
        
        <form method="POST" action="{{ route('password.wa.reset') }}">
        @csrf
            <div class="mb-4">
                <label for="password">New Password</label>
                <div class="password-container">
                    <input id="password" class="form-control" type="password" name="password" placeholder="********" required autocomplete="new-password">
                    <span class="password-toggle" id="toggle-password-1">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <div class="password-container">
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="********" required autocomplete="new-password">
                    <span class="password-toggle" id="toggle-password-2">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password_confirmation')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn-auth">Reset Password</button>
            </div>
        </form>
            
            <div class="auth-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}" id="register-link">Buat akun baru</a></p>
            </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        function setupPasswordToggle(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleButton = document.getElementById(toggleId);

            if (passwordInput && toggleButton) {
                toggleButton.addEventListener('click', function () {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    toggleButton.innerHTML = isPassword
                        ? '<i class="fas fa-eye-slash"></i>'
                        : '<i class="fas fa-eye"></i>';
                });
            }
        }

        // Aktifkan toggle untuk kedua input
        setupPasswordToggle('password', 'toggle-password-1');
        setupPasswordToggle('password_confirmation', 'toggle-password-2');
    </script>
@endpush